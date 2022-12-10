
<div class="container">
    <div class="container col-md-8">
<div class="card border border-warning">
    <div wire:loading>
        <div style="display: flex; justify-content: center; align-items: center; background-color: black;
        position: fixed; top: 0px; left: 0px; z-index: 9999; width: 100%; height: 100%; opacity: .75;">
            <div class="la-cog la-3x">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="card-header p-3">
           <h1 class="text-center ">Baza Aut</h1>
    </div>
    
    <div class="card-body mt-3">
         
            <div class="form-group row m-4 mt-1" >
                        <select wire:model="selectedMake" class="select-css text-center">
                            <option value=NULL >Marka</option>
                            @foreach($makes as $make)
                                <option value="{{ $make->id_car_make }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>
            <br>
            @if($makes != NULL)
            <div class="form-group row m-4 mt-0" >
                    <select wire:model="selectedModel" class="select-css text-center" >
                        <option value=NULL >Model</option>
                        @foreach($models as $model)
                            <option value="{{ $model->id_car_model }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>   
            @endif
            <br>
            @if ($models != NULL)
            <div class="form-group row m-4 mt-0" >
                    <select wire:model="selectedGeneration" class="select-css text-center">
                        <option value=NULL >Generacja</option>
                        @foreach($generations as $generation)
                            <option value="{{ $generation->id_car_generation }}">{{ $generation->name }} [{{ $generation->year_begin }}-{{ $generation->year_end }}]</option>
                        @endforeach
                    </select>
                </div>   
            @endif
            <br>
            @if ($generations != NULL)
            <div class="form-group row m-4 mt-0">
                    <select wire:model="selectedSerie" class="select-css text-center">
                        <option value=NULL class="selected">Seria</option>
                        @foreach($series as $serie)
                            <option value="{{ $serie->id_car_serie }}">{{ $serie->name }}</option>
                        @endforeach
                    </select>
                </div>   
            @endif
            <br>
            @if ($series != NULL)
            <div class="form-group row m-4 mt-0 mb-0">
                    <select wire:model="selectedTrim" class="select-css text-center">
                        <option value=NULL class="selected">Silnik</option>
                        @foreach($trims as $trim)
                            <option value="{{ $trim->id_car_trim }}">{{ $trim->name }}</option>
                        @endforeach
                    </select>
                </div>   
            @endif
         
            <table class="table">
                <thead>
                    <tr>  
                        
                        <h3 class="text-center mt-5 mb-4">Specyfikacja:</h3>
                    </tr>
                </thead>
                <tbody>
                @foreach ($specs as $spec)
                        <tr>
                            <td>{{ $spec->spec_name }}</td>
                            <td>{{ $spec->value }}</td>
                            @if ($spec->unit == 'NULL')
                                <td></td> 
                                @else
                                <td>{{ $spec->unit }}</td>
                            @endif
                        </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</div>

