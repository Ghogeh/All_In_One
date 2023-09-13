@extends('layout.admin_master')

@section('title') Home @endsection
@section('contents')


@if(session()->has('msg'))
<div class="alert bg-danger text-white p-2 m-2 text-center">{{ session('msg') }}</div>
@endif

{{-- <div class="container mt-3 p-3 border rounded justify-center">
    <div class="row"> --}}
        {{-- <form class="form-horizontal" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <fieldset>

                <!-- Form Name -->
                <legend>PRODUCTS</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_id">name</label>
                    <div class="col-md-4">
                        <input id="product_id" name="name" placeholder="PRODUCT ID" class="form-control input-md" required type="text">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name">price</label>
                    <div class="col-md-4">
                        <input id="product_name" name="price" placeholder="PRODUCT NAME" class="form-control input-md" required type="number">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name_fr">quantity</label>
                    <div class="col-md-4">
                        <input id="product_name_fr" name="quantity" placeholder="PRODUCT DESCRIPTION FR" class="form-control input-md" required type="number">

                    </div>
                </div>


                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="filebutton">auxiliary_images</label>
                    <div class="col-md-4">
                        <input id="filebutton" name="image" class="form-control" type="file">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group m-3">
                    <div class="col-md-4">
                        <input type="submit" id="singlebutton" name="singlebutton" class="btn btn-dark" value="Add">
                    </div>
                </div>

            </fieldset>
        </form> --}}
    {{-- </div> --}}

    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">PRODUCTS</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input  name="name" class="form-control" id="product_id" placeholder="Enter product">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input name="price" class="form-control" id="product_name" placeholder="Enter Price" required type="number">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Quantity</label>
                <input name="quantity" class="form-control" id="product_name_fr" placeholder="Enter Quantity" required type="number">


            </div>

            <div class="form-group">
                <label for="exampleInputFile">Auxilary Image</label>
                <div class="input-group">
                    {{-- <div class="custom-file">
                        <input type="file" class="custom-file-input" id="filebutton">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div> --}}
                     
                     
                          <input id="filebutton" name="image" class="form-control" type="file">
                     

                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            {{-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
         </div> 
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<!-- /.card -->
</div>




@endsection
