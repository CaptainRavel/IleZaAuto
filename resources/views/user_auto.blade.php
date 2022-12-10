@extends('layouts.app')

@section('content')


<h3 class='text-center mb-4'>Twoje auta</h3>

    @if (!$exist)
    <div class="container">
       <div class="row">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card border border-warning text-center">
                    <div class="card-body text-center mt-2">
                      <h5 class="card-title mb-5">BRAK AUT</h5> 
                      <p class="card-text">Nie dodałeś jeszcze żadnego auta, kliknij poniżej by zapisać swoje pierwsze auto!</p>
                      <div class="col text-center">
                       <a href="{{ route('user_auto.add_car') }}" <button type="button" href="{{ route('user_auto.add_car') }}" class=" mt-5 btn btn-warning d-flex justify-content-center ">Dodaj auto</button></a>  
                    </div>
              </div>
          </div>
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
                                NUMER REJESTRACYJNY: {{ $user_car->registration_number }}</br>
                                UBEZPIECZENIE: {{ $user_car->oc_date }}</br>
                                BADANIE TECHNICZNE: {{ $user_car->tech_rev_date }}</br>

                                <div class="card-body">                            
                                    <a class="btn btn-success text-light d-flex justify-content-center" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_auto.edit_car', $user_car->car_id) }}" role="button">Edytuj</a>   
                                    <a class="btn btn-danger text-light d-flex justify-content-center" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_auto.destroy_car', $user_car->car_id) }}" role="button" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć auto? Zostaną usunięte także wszystkie raporty przypisane do tego samochodu!') }}')">Usuń</a> 
                                </div>
                         </div>               
                </div>
                 @endforeach
    </div>
</div>
<div class="row justify-content-center mt-5">
       
  @canany(['isUser', 'isTestUser'])
         <div class="card text-center" style="width: 20rem;">
              <div class="card-body">
              @if ($cars_count >= 2) 
                <p class="card-text">Aby zarządzać większą ilością aut, musisz być użytkownikiem PREMIUM</p>
                <a href="{{ route('get_premium') }}" class="btn btn-warning" role="button" aria-pressed="true">WYKUP KONTO PREMIUM</a>
              @else
                <a href="{{ route('user_auto.add_car') }}" class="btn btn-warning" role="button" aria-pressed="true">DODAJ AUTO</a>
                 @endif
              </div>
          </div>
  @endcanany
          @can('isPremiumUser')
          <div class="card text-center" style="width: 20rem;">
            <div class="card-body">
          @if ($cars_count >= 6) 
          <p class="card-text">Osiągnąłeś maksymalną ilość aut, jeśli potrzebujesz większej ilości, skontaktuj się z administratorem portalu:</p>
          <a href="mailto: administrator@ilezaauto.pl">administrator@ilezaauto.pl</a>
          @else
          <a href="{{ route('user_auto.add_car') }}" class="btn btn-warning" role="button" aria-pressed="true">DODAJ AUTO</a>
          @endif
            </div>
          </div>
          @endcan
  
</div>



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
