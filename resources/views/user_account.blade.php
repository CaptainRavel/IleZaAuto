@extends('layouts.app')

@section('content')

<div class="container mt-4">
	<div class="row">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card border border-warning text-center">
                  <div class="card-header">
                        <h3 class="card-title">Moje konto</h3>
                  </div>

                  <div class="card-body">
                               <h5> Login:
                                @foreach ($user_name as $nick)
                                {{ $nick->name}}
                                @endforeach
                                <br><br>
                                Email:
                                @foreach ($user_email as $mail)
                                {{ $mail->email}}
                                @endforeach
                                <br><br>
                                Typ konta:
                                @foreach ($user_role as $typ)                                
                                @if ($typ->role == 'user')
                                    darmowe
                                @endif
                                @if ($typ->role == 'premium_user')
                                    PREMIUM
                                @endif
                                @if ($typ->role == 'admin')
                                    Administrator
                                @endif
                                @if ($typ->role == 'test_user')
                                    testowe
                                @endif
                                <br><br>
                                @if ($typ->role == 'premium_user')
                                Konto PREMIUM ważne do: {{ $premium_end }} {{ $days }}                                
                                @endif
                                @endforeach
                                </h5>
                        	<div class="row mt-5">
		                        <div class="col col-sm-12"></div>
		                        <div class="col-md-6">
                                        <form action="{{ route('user_account.update_nick') }}" method="POST" role="form">
                                            {{ csrf_field() }}
                                            <div class="autosized">
                                                <div class="form-group">

                                                    <input type="text" class="form-control" name="name" required="required" placeholder="Zmień swój nick"/>
                                                </div>
                                            </div>
                                            <input class="btn btn-warning d-flex justify-content-center mb-4" style="width: 80%; margin-left: auto; margin-right: auto;" type="submit" value="Zmień login" />
                                        </form>
                                </div>

                                <div class="col-md-6">
                                    <form action="{{ route('user_account.update_email') }}" method="POST" role="form">
                                    {{ csrf_field() }}
                                        <div class="autosized">
                                            <div class="form-group">
                                                <input style="" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required="required" placeholder="Zmień swój e-mail"/>
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                            </div>
                                        </div>
                                        <input type="submit" value="Zmień email" class="btn btn-warning d-flex justify-content-center mb-4" style="width: 80%; margin-left: auto; margin-right: auto;"/>
                                    </form>
                                </div>
	                        </div>
                            <div class="row">
		                        <div class="col">
                                    <a class="btn btn-warning d-flex justify-content-center mb-4" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('forget.password.get') }}" role="button">Zresetuj hasło</a>
                                </div>
	                        </div>
                             <div class="row">
		                        <div class="col">
                                   <a class="btn btn-danger text-light d-flex justify-content-center mb-4" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_account.destroy_user') }}" role="button" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć konto?') }}')">Usuń konto</a>
                                </div>
	                        </div>


                  </div>
             </div>
            </div>
        </div>
	</div>
</div>
@endsection
