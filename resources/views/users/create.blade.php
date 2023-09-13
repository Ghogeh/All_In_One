{{-- @extends('layout.app') --}}
@extends('layout.admin_master')

@section('title') Home @endsection
@section('contents')


@if(session()->has('msg'))
<div class="alert bg-danger text-white p-2 m-2 text-center">{{ session('msg') }}</div>
@endif

<div class="container mt-3 p-3 border rounded justify-center">
    <div class="row">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-outline">
                <input type="text" name="name" id="form3Example1m" class="form-control form-control-lg" />
               @error('name')
                   <span class="badge bg-danger text-white p-2 mt-3">{{ $message }}</span>
               @enderror
                <label class="form-label" for="form3Example1m"> name</label>
              </div>
            </div>


                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="email" id="form3Example1n" class="form-control form-control-lg" />
                      @error('email')
                      <span class="badge bg-danger text-white p-2 mt-3">{{ $message }}</span>
                  @enderror
                      <label class="form-label" for="form3Example1n">Email</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="password" name="password" id="form3Example1m1" class="form-control form-control-lg" />
                      @error('password')
                   <span class="badge bg-danger text-white p-2 mt-3">{{ $message }}</span>
               @enderror
                      <label class="form-label" for="form3Example1m1">Password</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="password" name="password_confirmation" id="form3Example1n1" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n1">Confirm Password</label>
                    </div>
                  </div>

                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <select class="form-control" name="permissions[]" multiple>
                       @foreach ($permissions as $permission)
                           <option value={{ $permission->id }}>{{ $permission->name }}</option>
                       @endforeach
                      </select>
                      <label class="form-label" for="form3Example1n1">Confirm Password</label>
                    </div>
                  </div>

                </div>
                <div class="d-flex justify-content-end pt-3">
                  <input type="submit" class="btn btn-warning btn-lg ms-2" value="create">
                </div>

              </div>
            </div>
            </form>
    </div>
</div>

@endsection
