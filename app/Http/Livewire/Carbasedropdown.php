<?php

namespace App\Http\Livewire;

use App\Models\CarEquip;
use App\Models\CarOption;
use Livewire\Component;
use App\Models\CarMakes;
use App\Models\CarModels;
use App\Models\CarGenerations;
use App\Models\CarSeries;
use App\Models\CarSpec;
use App\Models\CarTrims;

class Carbasedropdown extends Component
{
    public $makes;
    public $models;
    public $generations;
    public $series;
    public $trims;
    public $equipments;
    public $specs;

  
    public $selectedMake = NULL;
    public $selectedModel = NULL;
    public $selectedGeneration = NULL;
    public $selectedSerie = NULL;
    public $selectedTrim = NULL;
    public $selectedEquipment = NULL;

    public function mount()
    {
        $this->makes = CarMakes::select('id_car_make', 'name')->OrderBy('name')->get();
        $this->models = collect();
        $this->generations = collect();
        $this->series = collect();
        $this->trims = collect();
        $this->equipments = collect();
        $this->specs = collect();
    }

    public function render()
    {
        return view('livewire.carbasedropdown');
    }

    public function updatedSelectedMake($make)
    {
        if (!is_null($make)) {          
            $this->models = CarModels::select('id_car_model', 'name')->where('id_car_make', '=', $make)->OrderBy('name')->get(); 
            $this->generations = collect();
            $this->series = collect();
            $this->trims = collect();
            $this->equipments = collect();
            $this->specs = collect();  
        }
    } 

    public function updatedSelectedModel($model)
    {
        if (!is_null($model)) {            
            $this->generations = CarGenerations::select('id_car_generation', 'name', 'year_begin', 'year_end')->where('id_car_model', '=', $model)->OrderBy('name')->get();   
            $this->series = CarSeries::select('id_car_serie', 'name')->where('id_car_model', '=', $model)->OrderBy('name')->get();
            $this->trims = CarTrims::select('id_car_trim', 'name')->where('id_car_model', '=', $model)->OrderBy('name')->get();    
            $this->equipments = collect(); 
            $this->specs = collect();          
        }
    } 

    public function updatedSelectedGeneration($generation)
    {
        if (!is_null($generation)) {            
            $this->series = CarSeries::select('id_car_serie', 'name')->where('id_car_generation', '=', $generation)->OrderBy('name')->get();      
            $this->trims = collect();
            $this->equipments = collect();
            $this->specs = collect();
        }
    } 

    public function updatedSelectedSerie($serie)
    {
        if (!is_null($serie)) {          
            $this->trims = CarTrims::select('id_car_trim', 'name')->where('id_car_serie', '=', $serie)->OrderBy('name')->get();     
            $this->equipments = collect();
            $this->specs = collect();            
        }
    } 

    public function updatedSelectedTrim($trim)
    {
        if (!is_null($trim)) {  
        $this->specs = CarSpec::select('spec_name', 'value', 'unit')->where('id_car_trim', '=', $trim)->get();
        }
    }
}
