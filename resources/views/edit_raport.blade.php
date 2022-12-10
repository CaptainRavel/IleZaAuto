@extends('layouts.app')

@section('content')

@if ($raport_type == 'refuel')
@foreach ($refuels as $refuel)
<div class="row justify-content-center text-light">
    <div class="card col-md-8 col-xl-4 border border-warning text-center">
        <div class="card-header">
            <h3 class="card-title">Edytuj raport</h3>
        </div>
        <form action="{{ route('user_raports.update_refuels') }}" method="POST" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <input type="hidden", name="refueling_id" value="{{ $refuel->refueling_id }}">
            <input type="hidden", name="car_id" value="{{ $current_car }}">
                <div class="pt-3 autosized">
                    <div class="form-group">
                        <label for="fuel">Ilość paliwa (litry)</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto; "  type="number" id="fuel" name="fuel" required="required" min="0.1" max="999999" step="0.1" value="{{ $refuel->fuel }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Cena</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto; " type="number" id="price" name="price" required="required" min="0.01" max="999999" step="0.01" value="{{ $refuel->price }}">
                    </div>
                    <div class="form-group">
                        <label for="distance">Pokonany dystans (kilometry)</label>
                        <input  class="form-control" style="width: 80%; margin-left: auto; margin-right: auto; " type="number" id="distance" name="distance" required="required" min="1" max="9999999" step="1" value="{{ $refuel->distance }}">
                    </div>
                    <div class="form-group">
                        <label for="date">Data tankowania</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="date"  required="required" id="refueling_date" name="refueling_date" value="{{ $refuel->refueling_date }}" />
                    </div>
                    <div class="form-group">
                        <label for="date">Załącznik</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="file" id="file" name="file" value="{{ $refuel->file }}" />
                    </div>
                </div>
            <input style="width: 80%; margin-left: auto; margin-right: auto;" type="submit" value="Zapisz zmiany" class="btn btn-warning d-flex justify-content-center font-weight-bold"/><br>
        </form>
    </div>
</div>
@endforeach
@endif

@if ($raport_type == 'reprair')
@foreach ($reprairs as $reprair)   
<div class="row justify-content-center text-light">
    <div class="card col-md-8 col-xl-4 border border-warning text-center">
        <div class="card-header">
            <h3 class="card-title">Edytuj raport</h3>
        </div>
        <form action="{{ route('user_raports.update_reprairs') }}" method="POST" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <input type="hidden", name="reprair_id" value="{{ $reprair->reprair_id }}">
            <input type="hidden", name="car_id" value="{{ $current_car }}">
                <div class="pt-3 autosized">
                    <div class="form-group">
                        <label for="reprair_subject">Przedmiot naprawy</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="text"  id="reprair_subject" name="reprair_subject" required="required" value="{{ $reprair->reprair_subject }}" />
                    </div>
                    <div class="form-group">
                        <label for="reprair_location">Miejsce naprawy</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;"type="text" id="reprair_location" name="reprair_location" required="required" value="{{ $reprair->reprair_location }}" />
                    </div>
                    <div class="form-group">
                        <label for="mileage">Aktualny przebieg</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="number" id="car_mileage" name="car_mileage" required="required" min="1" max="9999999" step="1" value="{{ $reprair->car_mileage }}" />
                    </div>
                    <div class="form-group">
                        <label for="price">Cena</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="number" id="price" name="price" required="required" min="0.01" max="999999" step="0.01" value="{{ $reprair->price }}" />
                    </div>
                    <div class="form-group">
                        <label for="date">Data naprawy</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="date" id="reprair_date" name="reprair_date" required="required" value="{{ $reprair->reprair_date }}" />
                    </div>
                    <div class="form-group">
                        <label for="date">Załącznik</label>
                        <input class="form-control" style="width: 80%; margin-left: auto; margin-right: auto;" type="file" id="file" name="file" value="{{ $reprair->file }}" />
                    </div>
                </div>
            <input class="btn btn-warning d-flex justify-content-center font-weight-bold" style="width: 80%; margin-left: auto; margin-right: auto;" type="submit" value="Zapisz zmiany" /><br>
        </form>
    </div>
</div>
@endforeach
@endif

@endsection
