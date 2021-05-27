<?php

use App\Models\User;
use Infotech\Data2Monthly\Monthly;
use Illuminate\Support\Facades\Route;

Route::get('monthly',function(){
   $data =  User::all();
   dd(Monthly::current($data,'created_at','price'));
});