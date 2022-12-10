@foreach ($user_cars as $user_car )
<div class="row justify-content-center text-light">
                    <div class="card col-md-8 col-xl-4 border border-warning text-center">
                        <div class="card-header">
                            <h3 class="card-title">Dodaj auto</h3>
                        </div>
                        <form action="{{ route('user_auto.update_car') }}" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}
                            <input type="hidden", name="car_id" value="{{$user_car->car_id}}">
                                <div class="pt-3 autosized">
                                    <div class="form-group">
                                        <label for="image">Zdjęcie</label>
                                        <input class=" karta_edycji"   type="file" id="image" name="image" value="{{ $user_car->image }}">
                                    </div> 
                                    <div class="form-group">
                                        <label for="name">Nazwa</label>
                                        <input class="karta_edycji"   type="text" id="name" name="name" required="required" minlength="3" value="{{ $user_car->name }}">
                                    </div>
                                    <div class="form-group" >
                                        <div class="col-md-6">
                                            <label for="car_make" class="col-md-4 col-form-label text-md-">Marka</label>
                                        <select wire:model="selectedMake" class="form-control" name="car_make">
                                            <option value=NULL >Wybierz</option>
                                            @foreach($makes as $make)
                                                <option value={{ $make->id_car_make }}>{{ $make->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                            @if($makes != NULL)
                            <div class="form-group row" >
                                <div class="col-md-6">
                                    <label for="car_model" class="col-md-4 col-form-label text-md-right">Model</label>
                                    <select wire:model="selectedModel" class="form-control" name="car_model">
                                        <option value=NULL >Wybierz</option>
                                        @foreach($models as $model)
                                            <option value="{{ $model->id_car_model }}">{{ $model->name }}</option>
                                        @endforeach
                                    </select>
                                </div>   
                            </div>        
                            @endif
                                    <div class="form-group">
                                        <label for="production_year">Rok produkcji</label>
                                        <input  class="karta_edycji"   type="number" min="1900" max="2099" step="1" value="{{ $user_car->production_year }}" class="form-control" name="production_year" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="registration_number">Numer rejestracyjny</label>
                                    <input class="karta_edycji"  type="text" id="registration_number" value="{{ $user_car->registration_number }}" name="registration_number" required="required" minlength="7" />
                                </div>
                                <div class="form-group">
                                  <label for="oc_date">Data ubezpieczenia</label>
                                  <input class="karta_edycji"   type="date" class="form-control" name="oc_date" value="{{ $user_car->oc_date }}" />
                              </div>
                              <div class="form-group">
                                <label for="tech_rev_date">Data badań technicznych</label>
                                <input class="karta_edycji"  type="date" class="form-control" name="tech_rev_date" value="{{ $user_car->tech_rev_date }}" />
                            </div>
                            <input style="width: 80%; margin-left: auto; margin-right: auto;" type="submit" value="Zapisz zmiany" class="btn btn-warning d-flex justify-content-center font-weight-bold"/><br>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

