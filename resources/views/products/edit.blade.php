@extends('layout.app')
@section('title') Home @endsection
@section('contents')


@if(session()->has('msg'))
<div class="alert bg-danger text-white p-2 m-2 text-center">{{ session('msg') }}</div>
@endif

<div class="container mt-3 p-3 border rounded justify-center">
    <div class="row">
        <form class="form-horizontal" action="{{ route('products.update', $product->id) }}" method="post"
        enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset>

            <!-- Form Name -->
            <legend>PRODUCTS</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="product_id">name</label>
              <div class="col-md-4">
              <input id="product_id" value="{{ $product->name }}" name="name" placeholder="PRODUCT ID" class="form-control input-md" required type="text">

              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="product_name">price</label>
              <div class="col-md-4">
              <input id="product_name" value="{{ $product->price }}"  name="price" placeholder="PRODUCT NAME" class="form-control input-md" required type="number">

              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="product_name_fr">quantity</label>
              <div class="col-md-4">
              <input id="product_name_fr" value="{{ $product->quantity }}"  name="quantity" placeholder="PRODUCT DESCRIPTION FR" class="form-control input-md" required type="number">

              </div>
            </div>


            <!-- File Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="filebutton">auxiliary_images</label>
              <div class="col-md-6">
                <input id="filebutton" name="image" class="form-control" type="file">
              </div>
              <div class="col-md-6">
                <img src="{{ Storage::url('products/'.$product->image) }}" class="img-fluid w-25 h-25">
              </div>
            </div>

            <!-- Button -->
            <div class="form-group m-3">
              <div class="col-md-4">
                <input type="submit" id="singlebutton" name="singlebutton" class="btn btn-dark" value="Edit">
              </div>
              </div>

            </fieldset>
            </form>
    </div>
</div>

@endsection
