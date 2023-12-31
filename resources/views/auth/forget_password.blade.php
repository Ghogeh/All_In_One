@extends('layout.app')
@section('title') Forget Password @endsection
@section('contents')
@if(session()->has('msg'))
    <div class="alert alert-danger text-light text-center m-3 p-3">{{ session('msg') }}</div>
@endif
<section class="h-100 bg-dark my-5">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                  alt="Sample photo" class="img-fluid"
                  style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black">
                  <h3 class="mb-5 text-uppercase"> Forget Password</h3>

                 <form action="{{ route('password.request') }}" method="post">
                     @csrf
                     <div class="row">

                        <div class="col-md-12 mb-4">
                          <div class="form-outline">
                            <input type="text" name="email" id="form3Example1n" class="form-control form-control-lg" />
                            @error('email')
                           <span class="badge bg-danger text-white p-2 mt-3">{{ $message }}</span>
                       @enderror
                            <label class="form-label" for="form3Example1n">Email</label>
                          </div>
                        </div>

                      </div>
                      <div class="d-flex justify-content-end pt-3">
                        <input type="submit" class="btn btn-warning btn-lg ms-2" value="Send">
                      </div>
                 </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
