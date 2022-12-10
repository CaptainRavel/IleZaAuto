<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarMakes;
use App\Models\CarModels;
use App\Models\UserCars;

class Edituserauto extends Component
{
    public $makes;
    public $models;
    public $user_cars;
  
    public $selectedMake = NULL;
    public $selectedModel = NULL;

    public function mount($user_cars, $models)
    {
        $this->user_cars = $user_cars;
        $this->makes = CarMakes::select('id_car_make', 'name')->OrderBy('name')->get();
        $this->models = $models;      

    }

    public function render()
    {
        return view('livewire.edituserauto');
    }

    public function updatedSelectedMake($make)
    {
        if (!is_null($make)) { 
            $this->models = CarModels::select('id_car_model', 'name')->where('id_car_make', '=', $make)->OrderBy('name')->get(); 
            
        }
    } 
}
