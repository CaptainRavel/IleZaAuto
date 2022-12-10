@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
@foreach ($cars_list as $car)
    <div class="card m-3 p-0 shadow-sm border border-warning" style="width: 15rem;" class="">
      @if ($car->image == '')
        <img class="card-img-top" src="{{ asset('img/user_car_default.jpg') }}" alt="Card image cap">
      @else
        <img class="card-img-top" src="{{ asset('img/users_car_images/' . $car->image) }}" alt="Card image cap">
      @endif
      <div class="card-body">
        <h5 class="card-title">{{ $car->name }}</h5>
          <a class="btn btn-warning d-flex justify-content-center font-weight-bold" style="width: 80%; margin-left: auto; margin-right: auto;" style="width: 50%" href="{{ route('user_raports.car_reports', $car->car_id) }}" role="button">WYBIERZ</a>   
        </div>
    </div>
    @endforeach
</div>
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
                                            <th>Akcja</th>
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
                                                <td>
                                                   
                                                           <a href="{{ route('edit_raport.refuel', ['refuel_id'=>$refuel->refueling_id, 'car_id'=>$current_car]) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>
                                                           <a href="{{ route('destroy_raport.refuel', ['id'=>$refuel->refueling_id, 'car_id'=>$refuel->car_id]) }}" class="btn btn-danger" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć raport?') }}')"><i class="fa-sharp fa-solid fa-ban fa-xl"></i></a>
                                                    
                                                </td> 
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
                                <a href="{{ route('export_refuels.excel',$current_car) }}" class="btn btn-warning">Export do Excela</a>
                                <a href="{{ route('export_refuels.csv',$current_car) }}" class="btn btn-warning">Export do CSV</a>

                            </div>

                        

                    <div class="card text-center mt-5">
                        <div class="card-header">
                            <h3 class="card-title">Dodaj raport spalania</h3>
                                    </div>
                                    <form action="{{ route('user_raports.store_refuels') }}" method="POST" enctype="multipart/form-data" role="form">
                                        {{ csrf_field() }}
                                        <input type="hidden", name="car_id" value="{{ $current_car }}">
                                            <div class="pt-3 autosized">
                                                <div class="form-group">
                                                    <label for="fuel">Ilość paliwa (litry)</label>
                                                    <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto; "  type="number" id="fuel" name="fuel" required="required" min="0.1" max="999999" step="0.1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Cena</label>
                                                    <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto; " type="number" id="price" name="price" required="required" min="0.01" max="999999" step="0.01">
                                                </div>
                                                <div class="form-group">
                                                    <label for="distance">Pokonany dystans (kilometry)</label>
                                                    <input  class="form-control" style="width: 80%; margin-left: auto; margin-right: auto; " type="number" id="distance" name="distance" required="required" min="1" max="9999999" step="1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Data tankowania</label>
                                                    <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="date"  required="required" id="refueling_date" name="refueling_date" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Załącznik</label>
                                                    <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="file" id="file" name="file" />
                                                </div>
                                            </div>
                                        <input style="width: 80%; margin-left: auto; margin-right: auto;" type="submit" value="Dodaj raport" class="btn btn-warning d-flex justify-content-center font-weight-bold"/><br>
                                    </form>
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
                                            <th>Akcja</th>
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


                                                <td>
                                                
                                                           
                                                <a href="{{ route('edit_raport.reprair', ['reprair_id'=>$reprair->reprair_id, 'car_id'=>$current_car]) }}" class="btn  btn-success"><i class="fa-solid fa-pen-to-square fa-xl"></i> </a>
                                                <a href="{{ route('destroy_raport.reprair', ['id'=>$reprair->reprair_id, 'car_id'=>$reprair->car_id]) }}" class="btn  btn-danger" onclick="return confirm('{{ __('Jesteś pewny, że chcesz usunąć raport?') }}')"><i class="fa-sharp fa-solid fa-ban fa-xl"></i> </a>

                                                </td>
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
                                <a href="{{ route('export_reprairs.excel',$current_car) }}" class="btn btn-warning">Export do Excela</a>
                                <a href="{{ route('export_reprairs.csv',$current_car) }}" class="btn btn-warning">Export do CSV</a>
                       <div class="card text-center mt-5">
                        <div class="card-header">
                             <h3 class="card-title">Dodaj raport naprawy</h3>
                                </div>
                                <form action="{{ route('user_raports.store_reprairs') }}" method="POST" enctype="multipart/form-data" role="form">
                                    {{ csrf_field() }}
                                    <input type="hidden", name="car_id" value="{{ $current_car }}">
                                        <div class="pt-3 autosized">
                                            <div class="form-group">
                                                <label for="reprair_subject">Przedmiot naprawy</label>
                                                <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="text"  id="reprair_subject" name="reprair_subject" required="required"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="reprair_location">Miejsce naprawy</label>
                                                <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;"type="text" id="reprair_location" name="reprair_location" required="required" />
                                            </div>
                                            <div class="form-group">
                                                <label for="mileage">Aktualny przebieg</label>
                                                <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="number" id="car_mileage" name="car_mileage" required="required" min="1" max="9999999" step="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Cena</label>
                                                <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="number" id="price" name="price" required="required" min="0.01" max="999999" step="0.01">
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Data naprawy</label>
                                                <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="date" id="reprair_date" name="reprair_date" required="required" />
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Załącznik</label>
                                                <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="file" id="file" name="file" />
                                         </div>
                                        </div>
                                    <input class="btn btn-warning d-flex justify-content-center font-weight-bold" style="width: 80%; margin-left: auto; margin-right: auto;" type="submit" value="Dodaj raport" /><br>
                        </form>
                    </div>
                            </div>
                    
         

            







       
           
            </div>
        </div>
    
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
