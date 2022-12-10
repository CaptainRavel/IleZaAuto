@extends('layouts.app')

@section('content')

<h3 class='text-center'>Wybierz auto</h3>
<div class="d-flex justify-content-center">
    @if (!$exist)
  <div class="card shadow-sm border border-warning" >
    <div class="card-body">
      <h5 class="card-title">BRAK AUT</h5>
      <p class="card-text">Nie dodałeś jeszcze żadnego auta, by móc dodawać raporty musisz mieć zapisany conajmniej jeden pojazd!</p>
    </div>
  <div class="card-body">
    <a href="{{ route('user_auto.add_car') }}" class="btn btn-warning" role="button" aria-pressed="true">DODAJ AUTO</a>
  </div>
  </div>
@endif





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

                                <div class="card-body">
                                    <a class="btn btn-warning d-flex justify-content-center font-weight-bold" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_raports.car_reports', $user_car->car_id) }}" role="button">WYBIERZ</a>   
                                </div>
                         </div>

               
                </div>
                 @endforeach
    </div>
</div>


        @endif
</div>
@endsection



