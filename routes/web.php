<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test',function (){
   $camp =  \App\Models\Camp::find(1);

    $t =  \App\Models\Admin::find(1);


   return $t->createToken('MyApp');
});

