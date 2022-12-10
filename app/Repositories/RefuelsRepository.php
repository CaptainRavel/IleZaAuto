<?php

namespace App\Repositories;

use App\Models\UserRefuels;
use Illuminate\Support\Facades\Auth;

class RefuelsRepository extends BaseRepository{

    public function __construct(UserRefuels $model)
    {
        $this->model = $model;
    }

    public function getAllRefuels(){
        $user_id = Auth::id();
        return $this->model->where('user_id', '=', $user_id)->orderBy('refueling_date', 'desc')->paginate(5)->get();
    }

}