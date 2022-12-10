@extends('layouts.app')

@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-lg-3 col-md-6">
              <div class="card border border-warning">
                  <div class="card-header text-center"><h2>Logowanie</h2></div>
                  <div class="card-body">
                    @if (\Session::has('not verified'))
                        <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('not verified') !!}</li>
                        </ul>
                        </div>
                    @endif
                    @if (\Session::has('verify'))
                    <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('verify') !!}</li>
                    </ul>
                    </div>
                    @endif
                    @if (\Session::has('passchange'))
                    <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('passchange') !!}</li>
                    </ul>
                    </div>
                    @endif
                    @if (\Session::has('not_login'))
                    <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('not_login') !!}</li>
                    </ul>
                    </div>
                    @endif
                      <form action="{{ route('login.post') }}" method="POST">
                          @csrf
                          {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route(login.google) }}" class="btn btn-danger btn-block">Zaloguj się przez Google</a>
                                <a href="{{ route(login.facebook) }}" class="btn btn-primary btn-block">Zaloguj się przez Facebook</a>
                                <a href="{{ route(login.github) }}" class="btn btn-dark btn-block">Zaloguj się przez Github</a>
                            </div>
                          </div>
                          <p style="text-align: center"> LUB</p>   
                                                     --}}   
                          <div class="form-group row mt-4 justify-content-center">
                              <div class="col-md-8 mb-4" > 
                              <label for="exampleInputEmail1">Adre e-mail</label>
                              <input type="text" id="email_adress" class="form-control" name="email" required autofocus placeholder="E-mail"> 
                                        @if ($errors->has('email'))
                                            <span class ="text-danger">{{ $errors->first('email') }}</span>
                                        @endif 
                                    </div> 
                                </div> 
     
                           <div class="form-group row mb-4 justify-content-center"> 
                                        <div class= "col-md-8">
                                        <label for="exampleInputEmail1">Hasło</label>
                                            <input type="password" id="password" class="form-control" name="password" required placeholder="Hasło"> 
                                                @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                            </div>
                          </div>
  
                          <div class="form-group row justify-content-center">
                              <div class="col-md-8 mb-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember"> Pamiętaj mnie
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="text-center">
                                <div class="checkbox">
                                    <label>
                                        <a href="{{ route('forget.password.get') }}" class="link-warning">Zapomniałeś hasła?</a>
                                    </label>
                                </div>
                            </div>
                        </div>  
                          <div class="d-grid gap-2 col-6 mx-auto">
                              <button type="submit" class="btn btn-warning">
                                  Zaloguj
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection
