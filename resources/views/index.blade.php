@extends('layouts.app')
@section('content')



<div class="container">
 <!-- panel with foto -->
    <div class= "row my-5 align-items-center ">
        <div class="col-md-6 d-none d-md-block"><img class="img-fluid rounded mb-lg-0" src="https://images.pexels.com/photos/919073/pexels-photo-919073.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="..." />
        </div>
        <div class="col-12 col-md-6">
                    <h1 class="font-weight-normal text-light text-center">Policz koszty samochodu</h1>
                    <p class="text-light">Dzięki naszej witrynie sprawnie znajdziesz wszystkie niezbęde infomracje na temat swojego auta. Obliczysz średnie spalanie. Sprawdzisz ile wydałeś na naprawy swojego auta oraz tankowania</p>
        </div>
    </div>
</div>


    <!--Nowy pasek  kart panel with navigation-->

   
    <div class="wrapper">
              <div class="container mb-5 ">
                 <div class="row gx-4">
                    <div class="col-md-4 mb-4">
                          <div class="card shadow-sm border border-warning">
                             <img src="{{ URL::to('/img/car-traffic.jpg') }}" />
                               <div class="card-body">
                                  <h3>Auto Dane</h3>
                                <p class="text-justify">Znajdziesz tutaj wszystkie niezbędne dane techniczne o modelu auta</p>
                               </div>
                               <div class="card-footer">
                                  <a href="{{ url('/car_base') }}" class="btn btn-warning d-flex justify-content-center font-weight-bold ">Auto Dane</a>
                               </div>
                           </div>
                    </div>

                    <div class="col-md-4 mb-4">
                         <div class="card shadow-sm border border-warning">
                            <img src="{{ URL::to('/img/tankowanie.jpg') }}" />
                                <div class="card-body">
                                  <h3>Kalkulator Spalania</h3>
                                <p class="text-justify">Oblicz swoje średnie spalanie. Wystarczy ,że podasz przejechany dystans i liczbe zatankowanych litrów</p>
                                </div>
                                <div class="card-footer">
                                   <a href="{{ url('/oblicz') }}" class="btn btn-warning d-flex justify-content-center font-weight-bold"> Oblicz</a>
                                </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border border-warning">
                            <img src="{{ URL::to('/img/car-tax.jpg') }}" />
                                <div class="card-body">
                                  <h3>Moje raporty</h3>
                                <p class="text-justify">Raportuj swoje tankowania oraz naprawy. Przejżyj raporty, dowiedz się ile kosztuje Cię twój samochód.</p>
                                </div>
                                <div class="card-footer">
                                   @if (Route::has('login'))
                                         @auth
                                        <a href="{{ url('/user_car') }}" class="btn btn-warning d-flex justify-content-center font-weight-bold"> Raporty</a>
                                         @else
                                        <a href="{{ url('/user_car') }}" class="btn btn-warning d-flex justify-content-center font-weight-bold"> Raporty</a>
                                 @endif
                                </div>
                        </div>
                    </div>                                          
                    @endcan
                  </div>
              </div>
    </div>




  
                      <!-- Call to Action-->

 
        <!-- Footer-->
      
@endsection
