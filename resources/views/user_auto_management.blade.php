@extends('layouts.app')

@section('content')

<h3 class='text-center mb-4'>Auta użytkownika: {{ $user_name }}</h3>
<div class="d-flex justify-content-center">
    @if (!$exist)
      <div class="card border border-warning">
        <div class="card-body text-center mt-2">
          <h5 class="card-title">BRAK AUT</h5> 
        </div>
      <div class="card-body">
          <p class="card-text">Użytkownik nie posiada, żadnych dodanych aut</p>
      </div>  
    @endif
</div>
<div class="container">
    @if ($exist)
    <div class="row justify-content-center">
              @foreach ($user_cars as $user_car)
           
                    <div class="card m-3 p-0 shadow-sm border border-warning" style="max-width: 23em;">
                            @if ($user_car->image == '')
                                  <img class="card-img-top " src="{{ asset('img/user_car_default.jpg') }}" />
                                 @else
                                  <img class="card-img-top " src="{{ asset('img/users_car_images/' . $user_car->image) }}" />
                            @endif
                         
                         <div class="card-body">
                            <h4 class="card-title text-center">{{ $user_car->name }}</h4>
                           
                                MARKA: {{ $user_car->car_make }}</br>
                                MODEL: {{ $user_car->car_model }}</br>
                                ROK PRODUKCJI: {{ $user_car->production_year }}</br>
                                NUMER REJESTRACYJNY: {{ $user_car->registration_number }}</br>
                                UBEZPIECZENIE: {{ $user_car->oc_date }}</br>
                                BADANIE TECHNICZNE: {{ $user_car->tech_rev_date }}</br>

                                <div class="card-body">    
                                    <a class="btn btn-warning text-light d-flex justify-content-center" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_auto_raports_management', ['user_id'=>$user_number, 'car_id'=>$user_car->car_id]) }}" role="button">Zobacz raporty</a>                         
                                    <a class="btn btn-danger text-light d-flex justify-content-center" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_auto_management.delete', ['user_id'=>$user_number, 'car_id'=>$user_car->car_id]) }}" role="button" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć auto? Zostaną usunięte także wszystkie raporty przypisane do tego samochodu!') }}')">Usuń</a> 
                                </div>
                         </div>               
                </div>
          @endforeach
    </div>
    <a class="btn btn-warning text-light d-flex justify-content-center" style="width: 50%; margin-left: auto; margin-right: auto;" style="width: 30%" href="{{ route('user_management',$user_number) }}" role="button">Wróc</a>                         

    @endif
</div>





  




























<!--

@if ($exist)  
  @foreach ($user_cars as $user_car)
        <div class="card" style="width: 20rem;">
          @if ($user_car->image == '')
            <img class="card-img-top" src="{{ asset('img/user_car_default.jpg') }}" alt="Card image cap">
          @else
            <img class="card-img-top" src="{{ asset('img/users_car_images/' . $user_car->image) }}" alt="Card image cap">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $user_car->name }}</h5>
            {{--  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
          </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">MARKA: {{ $user_car->car_make }}</li>
            <li class="list-group-item">MODEL: {{ $user_car->car_model }}</li>
            <li class="list-group-item">ROK PRODUKCJI: {{ $user_car->production_year }}</li>
            <li class="list-group-item">UBEZPIECZENIE: {{ $user_car->oc_date }}</li>
            <li class="list-group-item">BADANIE TECHNICZNE: {{ $user_car->tech_rev_date }}</li>
            </ul>
            <div class="card-body">
              <a class="btn btn-success text-light d-flex justify-content-center" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_auto.edit_car', $user_car->car_id) }}" role="button">Edytuj</a>   
              <a class="btn btn-danger text-light d-flex justify-content-center" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_auto.destroy_car', $user_car->car_id) }}" role="button" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć auto? Zostaną usunięte także wszystkie raporty przypisane do tego samochodu!') }}')">Usuń</a>   
            </div>
        </div>

     
  @endforeach
  @if ($cars_count >= 2)   
    <div class="row">
         <div class="card" style="width: 20rem;">
          <div class="card-body">
            <p class="card-text">Aby dodać więcej niż dwa auta, musisz być użytkownikiem PREMIUM</p>
            <a href="#" class="btn btn-warning" role="button" aria-pressed="true">WYKUP KONTO PREMIUM</a>
          </div>
        </div>

   @else
        <div class="card" style="width: 20rem;">
          <div class="card-body">
            <a href="{{ route('user_auto.add_car') }}" class="btn btn-warning" role="button" aria-pressed="true">DODAJ AUTO</a>
          </div>
        </div>
  @endif
@endif
</div>



@endsection
