<?php

namespace App\Services\Admin\Camp;

use App\Models\Admin;
use App\Models\Camp;

class CampService
{
    public function __construct(public Admin $admin)
    {
        $this->admin = auth()->user();
    }

    function index()
    {
        return $this->admin->camps;
    }

    function store($data)
    {
        return $this->admin->camps()->create($data);
    }


    function update($camp,$data){
        return $camp->update($data);
    }

    function destroy($camp){
        return $camp->delete();
    }
}
