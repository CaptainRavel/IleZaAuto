<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarMakes;
use App\Models\CarModels;

class Adduserauto extends Component
{
    public $makes;
    public $models;
  
    public $selectedMake = NULL;
    public $selectedModel = NULL;

    public function mount()
    {
        $this->makes = CarMakes::select('id_car_make', 'name')->OrderBy('name')->get();
        $this->models = collect();

    }

    public function render()
    {
        return view('livewire.adduserauto');
    }

    public function updatedSelectedMake($make)
    {
        if (!is_null($make)) {          
            $this->models = CarModels::select('id_car_model', 'name')->where('id_car_make', '=', $make)->OrderBy('name')->get(); 
        }
    } 
}
