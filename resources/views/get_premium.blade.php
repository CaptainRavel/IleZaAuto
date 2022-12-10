@extends('layouts.app')

@section('content')
@canany(['isUser', 'isPremiumUser', 'isAdmin'])
<div class="container mt-4">
	<div class="row">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border border-warning text-center">
                    <div class="card-header">
                        <h3 class="card-title">Zakup konto premium</h3>
                        <p class="card-text">Na chwilę obecną zakup konta PREMIUM przez portal jest niemożliwy.</p>
                        <br>
                        <p class="card-text">W celu zwiększenia ilości aut do dodania lub innych pytań, prosimy o kontkat z administratorem strony poprzez email:</p>
                        <a href="mailto: administrator@ilezaauto.pl">administrator@ilezaauto.pl</a>
                        <br>
                        <br>
                        <p class="card-text">PRZEPRASZAMY ZA UTRUDNIENIA.</p>
                        <br>
                        <a href="{{ route('user_auto') }}" class="btn btn-warning">Powrót</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcanany

@can('isTestUser')
   
<div class="container mt-4">
	<div class="row">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border border-warning text-center">
                    <div class="card-header">
                        <h3 class="card-title">Zakup konto premium</h3>
                        <p class="card-text">Jesteś zalogowany na konto testowe.</p>
                        <br>
                        <p class="card-text">Konto premium umożliwia dodanie do konta większej ilości aut. Bazowo użytkownik może dodać do 2 aut. Z kontem premium może dodać ich 6!</p>
                        <br>
                        <p class="card-text">Wybierz rodzaj konta PREMIUM do aktywacji:</p>
                        <a href="{{ route('add_premium.month') }}" class="btn btn-warning">PREMIUM na miesiąc!</a>
                        <a href="{{ route('add_premium.year') }}" class="btn btn-warning">PREMIUM na rok!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endcan

@endsection