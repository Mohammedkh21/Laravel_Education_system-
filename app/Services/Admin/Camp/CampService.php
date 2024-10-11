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

    function show($camp_id)
    {
        return $this->admin->camps()->where('camps.id', $camp_id)->first();
    }

    function update($camp_id,$data){
        return $this->admin->camps()->where('camps.id', $camp_id)->update($data);
    }

    function destroy($camp_id){
        return $this->admin->camps()->where('camps.id', $camp_id)->delete();
    }
}
