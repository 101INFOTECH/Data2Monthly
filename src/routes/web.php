<?php

use App\Models\User;
use Infotech\Data2Monthly\Monthly;
use Illuminate\Support\Facades\Route;

Route::get('monthly',function(){
   $data =  User::all();
   dd(Monthly::expenseMonthly($data,'created_at','price'));
});