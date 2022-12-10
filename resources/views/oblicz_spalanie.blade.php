  <script src="{{ asset('js//spalanie.js') }}"> </script>
@extends('layouts.app')
@section('content')

<div class="container">
        <!-- Page Content-->
        
            <!-- Heading Row-->

            <div class="row gx-2 gx-lg-5 align-items-center my-5">
                <div class="col-lg-6"><img class="img-fluid rounded mb-4 mb-lg-0" <img src="{{ URL::to('/img/spalanie.jpg') }}">
                </div>
                <div class="card text-light col-lg-6 border border-warning">


                 
                          <h1 class="text-center mt-2 mb-4">Oblicz spalanie</h1>
                                <div class="form-group row mr_top">
                                    <label  class="col-md-4 col-form-label text-center mb-3">Litry</label>
                                      <div class="col-md-6">
                                        <input id="p" type="text" class="form-control @error('email') is-invalid @enderror"required="required" autofocus>
                                      </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-center mb-2">KM</label>
                                      <div class="col-md-6">
                                        <input id="d" type="text" class="form-control @error('email') is-invalid @enderror"required="required" autofocus>
                                      </div>
                                </div>
                                <input type="submit" value="Oblicz" onclick="spalanie()" class="btn btn-warning d-grid gap-2 col-8 mx-auto mb-2" >


                                <label class="text-center m-2">Średnie spalanie: <p id="w"></label>

                </div>
                     
            </div>
        </div>


        

        

@endsection
