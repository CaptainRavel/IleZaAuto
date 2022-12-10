<?php

namespace App\Repositories;

use App\Models\UserReprairs;
use Illuminate\Support\Facades\Auth;

class ReprairsRepository extends BaseRepository{

    public function __construct(UserReprairs $model)
    {
        $this->model = $model;
    }
    public function getAllReprairs(){
        $user_id = Auth::id();
        return $this->model->where('user_id', '=', $user_id)->orderBy('reprair_date', 'desc')->get();
    }

}