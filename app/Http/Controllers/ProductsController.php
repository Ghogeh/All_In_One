<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use App\Imports\ProductImport;

class ProductsController extends Controller
{

    function __construct()
    {
        $this->middleware(['auth', 'verified']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = Auth::user();
     if($user->hasAnyPermission(['display'])) {
        $products = Product::paginate(20);
        return view('products.index', compact('products'));
     } else {
        $products = $user->products()->paginate(20);
        return view('products.index', compact('products'));
     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'price' =>  ['required'],
            'quantity' =>  ['required'],

        ]);

       if($request->hasFile('image')) {
             $image = $request->file('image');
             $imageName = time().'_'.$image->getClientOriginalName();
            //  Storage::disk('public')->putFileAs('products', $image, $imageName);
            $imagePath = public_path('storage/products');
             $image->move($imagePath, $imageName);

             try {

                    Product::create([
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'image' => $imageName,
                        'user_id' => Auth::id()
                    ]);
                    Cache::forget('cached-products'.'_page_1');
                    return redirect()->route('products.index')->with('msg', 'product inserted successfully');

             }catch(\Exception $e) {
               return  redirect()->back()->with('msg', 'problem with store products');
             }
       } else {
           return redirect()->back()->with('msg', 'you should select an image');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $this->authorize('edit', Product::find($id));
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Product::find($id));

        $product = Product::find($id);

        $request->validate([
            'name' => ['required', 'min:3'],
            'price' =>  ['required'],
            'quantity' =>  ['required'],

        ]);

       if($request->hasFile('image')) {
        unlink(public_path().'/storage/products/'.$product->image);
             $image = $request->file('image');
             $imageName = time().'.'.$image->getClientOriginalName();
             Storage::disk('public')->putFileAs('products', $image, $imageName);

             try {

                    $product->update([
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'image' => $imageName,
                        'user_id' => Auth::id()
                    ]);

                    Cache::flush();
                    return redirect()->route('products.index')->with('msg', 'product updated successfully');

             }catch(\Exception $e) {
               return  redirect()->back()->with('msg', 'problem with update products');
             }
       } else {

        try {

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'user_id' => Auth::id()
            ]);
            return redirect()->route('products.index')->with('msg', 'product updated successfully');

     }catch(\Exception $e) {
       return  redirect()->back()->with('msg', 'problem with update products');
     }
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Product::find($id));
        $product = Product::find($id);

               if(is_file(public_path().'/storage/products/'.$product->image)) {
                   unlink(public_path().'/storage/products/'.$product->image);
                  $product->delete();
                  return  redirect()->back()->with('msg', 'Deleted successfully');
               } else {
                $product->delete();
                return  redirect()->back()->with('msg', 'Deleted successfully');
               }

    }

     // ==========import and export==============//

    function P_importExcel(Request $request) {
          Excel::import(new ProductImport, $request->file('excel'));
          return redirect()->route('products.index')->with('msg', "products has Imported successfully");
    }

    function P_exportExcel() {
        return Excel::download(new ProductExport, 'products_information.xlsx');
    }
}
