@extends('layouts.app')

@section('content')
<div class="container text-light">
    <div class="container px-2 px-lg-2">
        <div class="row gx-2 gx-lg-5 my-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card text-center">
                        <div class="card-header ">
                            <h3 class="card-title" class='text-center'>Lista użytkowników</h3>
                            <a href="{{ url('searchuser') }}" class="btn btn-xs btn-warning btn-flat font-weight-bold show_confirm"><i class="fa-solid fa-magnifying-glass"></i>   Wyszukaj użytkowników</a>
                            <div class="table-responsive">
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
                        @foreach ($user_list as $user)
                                <tr>
                                    <th scope="row">{{ $user->name}}</th>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                    @if ($user->role == 'user')
                                        Użytkownik darmowy
                                    @endif
                                    @if ($user->role == 'premium_user')
                                        Użytkownik premium
                                    @endif
                                    @if ($user->role == 'admin')
                                        Administrator
                                    @endif
                                    </td>
                                    <td> 
                                        <a href="{{ url('user_management/'.$user->id) }}" class="btn btn-xs btn-success btn-flat show_confirm"><i class="fa-solid fa-gear"></i>  Edytuj</a>
                                        <a href="{{ url('user_management_delete_user/'.$user->id) }}" class="btn btn-xs btn-danger btn-flat show_confirm" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć użytkownika?') }}')"><i class="fa-regular fa-trash-can"></i>  Usuń</a>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $user_list->appends(['users' => $user_list->currentPage()])->links() }}
                    
                    <h3 class="card-title" class='text-center'>Dodaj użytkownika:</h3>
                    <form action="{{ route('user_management.add_user') }}" method="POST">
                        @csrf
                        <div class="form-group row justify-content-center mb-4">
                            <div class="col-md-8 ">
                                <label class="mb-1" for="name" >Nick:</label>
                                <input type="text" id="name" class="form-control" name="name" required autofocus  placeholder="Nick / Login">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row justify-content-center mb-4">
                            <div class="col-md-8">
                                <label  class="mb-1" for="email_address" >E-Mail:</label>
                                <input type="text" id="email_address" class="form-control" name="email" required autofocus placeholder="Adres e-mail">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row justify-content-center mb-4">
                            <div class="col-md-8">
                                <label  class="mb-1" for="password">Hasło:</label>
                                <input type="password" id="password" class="form-control" name="password" required placeholder="Hasło">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-4">
                            <div class="col-md-8">
                              <label  class="mb-1" for="password-confirm">Powtórz hasło:</label>
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Powtórz hasło">
                          </div>
                      </div>

                        <div class="d-grid gap-2 col-6 mx-auto mb-4">
                            <button type="submit" class="btn btn-warning">
                                Zapisz!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>


@endsection


