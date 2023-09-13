@extends('layout.admin_master')
@section('title') Home @endsection
@section('contents')

@if(session()->has('msg'))
    <div class="alert alert-success text-dark text-center m-3 p-3">{{ session('msg') }}</div>
@endif

        <div class="border border-2 shadow-md rounded m-2 p-3 bg-light text-dark justify-center mt-5 text-center">

            <div class="container">
                <div class="row g-3">

          @can('display')
          {{-- <div class="col-md-4">
            <div class="card p-3 bg-primary text-light" style="max-width: 18rem" my-3>
                 <div class="card-title"><a class="link-light stretched-link" href="{{ route('users.index') }}">User Management</a></div>
                 <div class="card-body"><i class="bx bxs-user bx-lg"></i></div>
            </div>
         </div> --}}
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                  <div class="inner">
                      User Management
                  </div>
                  <a href="{{ route('users.index') }}" class="small-box-footer">more info <i class="fas fa-arrow-circle-right"></i></a>


              </div>

          </div>

          @endcan
          {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    User Management
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">more info <i class="fas fa-arrow-circle-right"></i></a>


            </div>

          </div> --}}

            {{-- <div class="col-md-4">
                <div class="card p-3 bg-danger text-light" style="max-width: 18rem" my-3>
                     <div class="card-title"><a class="link-light stretched-link" href="{{ route('products.index') }}">Products Management</a></div>
                     <div class="card-body"><i class="bx bxs-cart-download bx-lg"></i></div>
                </div>
            </div> --}}

             <div class="col-lg-3 col-6">
                 <div class="small-box bg-success">
                     <div class="inner">
                         Products Management
                     </div>
                     <a href="{{ route('products.index') }}" class="small-box-footer">more info <i class="fas fa-arrow-circle-right"></i></a>



                 </div>

             </div>



            {{-- <div class="col-md-4">
                <div class="card p-3 bg-dark text-light" style="max-width: 18rem" my-3>
                     <div class="card-title"><a class="link-light stretched-link" href="">header</a></div>
                     <div class="card-body"><i class="bx bxs-server bx-lg"></i></div>
                </div>
            </div> --}}

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        Header
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">more info <i class="fas fa-arrow-circle-right"></i></a>



                </div>

            </div>



            {{-- <div class="col-md-4">
                <div class="card p-3 bg-secondary text-light" style="max-width: 18rem" my-3>
                     <div class="card-title"><a class="link-light stretched-link" href="">header</a></div>
                     <div class="card-body"><i class="bx bxs-data bx-lg"></i></div>
                </div>
            </div> --}}






        </div>
    </div>
</div>
@endsection
