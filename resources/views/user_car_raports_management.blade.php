@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container text-light text-center">
        <div class="row justify-content-center"> 
        <h3 class="card-title mb-5 mt-5" class='text-center'>Raporty dla pojazdu: {{ $current_car_name }}</h3>



            <div class="col-md-8  tab text-center justify-content-center">
                
              <button class="tablinks" onclick="openCity(event, 'Spalanie')">Spalanie</button>
              <button class="tablinks" onclick="openCity(event, 'Naprawy')">Naprawy</button>
              
            </div>
<!-- Tab spalanie -->
            <div id="Spalanie" class="col-md-8 tabcontent mb-5 ">         
                    <div class="card text-center">
                                                    <div class="table-responsive">
                                <table class="table text-light">
                                    <thead>
                                        <tr>
                                            <th>@sortablelink('refueling_date', 'Data')</th>
                                            <th>@sortablelink('fuel', 'Paliwo')</th>
                                            <th>@sortablelink('distance', 'Dystans')</th>
                                            <th>@sortablelink('price', 'Cena')</th>
                                            <th>Spalanie</th>
                                            <th>Załącznik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($refuel_list as $refuel)
                                            <tr>
                                                <th scope="row">{{ $refuel->refueling_date}}</th>
                                                <td>{{ $refuel->fuel}} l</td>
                                                <td>{{ $refuel->distance}} km</td>
                                                <td>{{ $refuel->price}} zł</td>
                                                <td>{{ round($refuel->fuel / $refuel->distance * 100, 2)}} l/100km</td>
                                                @if ($refuel->file != NULL)
                                                <td>
                                                <a href="{{ route('download_raport_file', $refuel->file) }}"  class="btn btn-xs btn-primary">Pobierz</a>
                                               
                                                @else
                                                <td>Brak</td>
                                                @endif                                                
                                            </tr>                                        
                                    @endforeach
                                    <tr>
                                        <th>SUMA:</th>
                                        <th>{{ $refuel_sum}} l</th> 
                                        <th>{{ $distance_sum}} km</th>
                                        <th>{{ $price_sum}} zł</th>
                                        @if ($refuel_sum != 0)
                                        <th>{{ round($refuel_sum / $distance_sum * 100, 2)}} l/100km</th>  
                                        @else
                                        <th>0 l/100km</th> 
                                        @endif
                                        
                                    </tr>
                                    </tbody>
                                </table>
                                {{ $refuel_list->appends(['reprairs' => $reprair_list->currentPage()])->links() }}

                            </div>
                </div>
            </div>
<!-- Raporty naprawy -->
            <div id="Naprawy" class="tabcontent col-lg-8">
           
                    <div class="card text-center">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@sortablelink('reprair_date', 'Data')</th>
                                            <th>Przebieg</th>
                                            <th>Miejsce</th>
                                            <th>Przedmiot naprawy</th>
                                            <th>@sortablelink('price', 'Cena')</th>
                                            <th>Załącznik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($reprair_list as $reprair)
                                            <tr>
                                                <th scope="row">{{ $reprair->reprair_date}}</th>
                                                <td>{{ $reprair->car_mileage}} km</td>
                                                <td  white-space:nowrap;
                                                    overflow:hidden;
                                                    text-overflow:ellipsis;>{{ $reprair->reprair_location}}</td>
                                                <td  white-space:nowrap;
                                                    overflow:hidden;
                                                    text-overflow:ellipsis;>{{ $reprair->reprair_subject}}</td>
                                                <td>{{ $reprair->price}} zł</td>
                                                @if ($reprair->file != NULL)
                                                <td><a href="{{ route('download_raport_file', $reprair->file) }}">Pobierz</a></td>
                                                @else
                                                <td>Brak</td>
                                                @endif  
                                            </tr>
                                    @endforeach
                                    <tr>
                                        <th>SUMA:</th>
                                        <th></th> 
                                        <th></th>
                                        <th></th>
                                        <th>{{ $reprair_sum }} zł</th>
                                    </tr>
                                    </tbody>
                                </table>
                                {{ $reprair_list->appends(['refuels' => $refuel_list->currentPage()])->links() }}
                       <div class="card text-center mt-5">
                        <div class="card-header">

            </div>
        </div>
    
</div>
                    </div>
            </div>
        </div>
    </div>
    <a class="btn btn-warning text-light d-flex justify-content-center" style="width: 50%; margin-left: auto; margin-right: auto;" style="width: 30%" href="{{ route('user_auto_management',$user_number) }}" role="button">Wróc</a>                         

</div>


<script src="https://kit.fontawesome.com/87cc08ad60.js" crossorigin="anonymous"></script>
<script>

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection

