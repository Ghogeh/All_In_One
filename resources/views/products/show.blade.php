@extends('layout.app')
@section('title') Home @endsection
@section('contents')
<div class="container">
    <div class="row">

        <div class="table-responsive">
            <a href="{{ route('products.index') }}" class="btn btn-dark m-3 text-center">Back</a>

            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">product name</th>
                    <th scope="col">price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">owner</th>
                    <th scope="col">image</th>
                    <th scope="col">view</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->user->name }}</td>
                    <td><img src="{{ Storage::url('products/'.$product->image) }}" class="img-fluid w-25 h-25"></td>
                    <td><button class="btn btn-success">View</button></td>
                    <td><button class="btn btn-primary">Edit</button></td>
                    <td><button class="btn btn-danger">Delete</button></td>
                  </tr>

                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection
