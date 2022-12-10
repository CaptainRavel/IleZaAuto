@extends('layouts.app')

@section('content')
<div class="container text-light">
    <div class="container px-4 px-lg-6">
        <div class="row gx-2 gx-lg-5 my-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card text-center">
                        <div class="card-header ">
                            <h3 class="card-title" class='text-center'>Znajdź użytkownika</h3>
                            <div class="table-responsive">
    <form action="{{ route('search') }}" method="GET">
        <input type="search" class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" name="search" required placeholder="Wpisz część nicku lub email-a szukanego użytkownika..."/>
        <div  class=" row d-flex justify-content-center align-content-center "  >
        <button type="submit" class="btn btn-warning d-flex justify-content-center font-weight-bold" style="width: 60%; margin-left: auto; margin-right: auto;">Szukaj</button>
        
        </div>
    </form>
    @if($found_user_list->isNotEmpty())
    <table class="table text-light">
        <thead>
            <tr>
                <th>
                    Nick
                </th>
                <th>
                    E-mail
                </th>
                <th>
                    Typ konta
                </th>
                <th>Akcja
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($found_user_list as $found_user)
                <tr>
                    <th scope="row">{{ $found_user->name}}</th>
                    <td>{{ $found_user->email}}</td>
                    <td>
                    @if ($found_user->role == 'user')
                        Użytkownik darmowy
                    @endif
                    @if ($found_user->role == 'premium_user')
                        Użytkownik premium
                    @endif
                    @if ($found_user->role == 'admin')
                        Administrator
                    @endif
                    </td>
                    <td> 
                        <a href="{{ url('user_management/'.$found_user->id) }}" class="btn btn-xs btn-success btn-flat show_confirm">Edytuj</a>
                        <a href="{{ url('user_management_delete_user/'.$found_user->id) }}" class="btn btn-xs btn-danger btn-flat show_confirm" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć użytkownika?') }}')">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
 </div>
@else 
    <div>
        <h2>Nie znaleziono użytkowników</h2>
    </div>
@endif
</div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endsection
