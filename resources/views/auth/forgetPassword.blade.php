@extends('layouts.app')

@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-3">
              <div class="card p-2  border border-warning">
                  <div class="card-header text-center"><h3>Reset Hasła</h3></div>
                  <div class="card-body">
  
                    @if (\Session::has('passchange'))
                    <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('passchange') !!}</li>
                    </ul>
                    </div>
                    @endif
  
                      <form action="{{ route('forget.password.post') }}" method="POST">
                          @csrf
                          <div class="form-group row justify-content-center">
                              <div class="col-md-8 mb-4" >
                              <label for="email_address" class="col-md-6 col-form-label text-md-right">Adres e-mail:</label>
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif 
                          </div>

                         <div class="d-grid gap-2 col-6 mx-auto mb-4">
                              <button type="submit" class="btn btn-warning">
                                  Wyślij link do zresetowania hasła
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
