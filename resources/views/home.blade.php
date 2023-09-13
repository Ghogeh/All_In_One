@extends('layout.app')
@section('title') Home @endsection
@section('contents')

    <div class="row">

        @foreach ($products as $product)
        
        <div class="col-md-6 ">
            <div class="card  border-rounded" style="border-color:green;">
                <img src="{{ Storage::url('products/'.$product->image) }}" class="card-img-top" alt="picture" width="300" height="300">





                <div class="card-body">
                    <p class="card-text">{{ $product->name }}</p>
                    <p class="card-text text-center">{{ $product->price }}XAF</p>
                </div>
 </div>
 <br>

            </div>


        </div>


        @endforeach

        {{ $products->links() }}
    </div>

@endsection
