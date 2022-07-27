@extends('layout.app')
@section('title') Home @endsection
@section('contents')

<div class="container">
    <div class="row mt-5 g-3">

       @foreach ($products as $product)
       <div class="col-md-4 ">
        <div class="card">
        <img src="{{ Storage::url('products/'.$product->image) }}" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">{{ $product->name }}</p>
          <p class="card-text text-center">{{ $product->price }}$</p>
        </div>
      </div>

    </div>

       @endforeach

{{ $products->links() }}
    </div>
</div>


@endsection
