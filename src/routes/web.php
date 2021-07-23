<?php

use App\Models\User;
use Infotech\Data2Monthly\Monthly;
use Illuminate\Support\Facades\Route;

Route::get('monthly',function(){
    $user = User::all();
    dd(Monthly::daily($user,'created_at',5));
});