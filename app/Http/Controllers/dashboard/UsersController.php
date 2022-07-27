<?php

namespace App\Http\Controllers\dashboard;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{


    function __construct()
    {
       $this->middleware(['can:display'])->only(['index']);
       $this->middleware(['can:edit'])->only(['edit', 'update']);
       $this->middleware(['can:add'])->only(['create', 'store']);
       $this->middleware(['can:delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('users.create', compact('permissions'));
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
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

       try {
           $user = User::create([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
           ]);
            $user->syncPermissions($request->permissions, []);
            return redirect()->route('users.index')->with('msg', "User has created successfully");

      }catch(\Exception $e) {
            return redirect()->back()->with('msg', 'User not registered');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $permissions = Permission::all();
        return view('users.edit', compact(['user', 'permissions']));
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

        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['email', 'required'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

       try {
           $user->update([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
           ]);
            $user->syncPermissions($request->permissions, []);
            return redirect()->route('users.index')->with('msg', "User has updated successfully");

      }catch(\Exception $e) {
            return redirect()->back()->with('msg', 'User not updated');
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
        try {
       $user = User::find($id);
       $user->delete();
       $user->revokePermissionTo($user->permissions);

        }catch(\Exception $e){
            return redirect()->back()->with('msg', "User not deleted");
        }
        return redirect()->route('users.index')->with('msg', "User has deleted successfully");
    }


    // ==========import and export==============//

    function importExcel(Request $request) {
          Excel::import(new UserImport, $request->file('excel'));
          return redirect()->route('users.index')->with('msg', "User has Imported successfully");
    }

    function exportExcel() {
        return Excel::download(new UserExport, 'users_information.xlsx');
    }
}
