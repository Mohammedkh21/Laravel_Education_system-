<?php

namespace App\Services\Camp;


use App\Models\Camp;

class CampService
{
    function getAllCampInfo(){
        return Camp::all();
    }

}
