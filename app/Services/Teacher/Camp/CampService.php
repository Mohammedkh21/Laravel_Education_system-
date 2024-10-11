<?php

namespace App\Services\Teacher\Camp;

use App\Models\Teacher;
use App\Notifications\joinCampRequest;
use App\Services\Teacher\Request\RequestService;
use Illuminate\Support\Facades\Notification;

class CampService
{
    public function __construct(public Teacher $teacher)
    {
        $this->teacher = auth()->user();
    }

    function showAll()
    {
        return $this->teacher->camps ;
    }

    function show($camp_id)
    {
        return $this->teacher->camps()->where('camps.id', $camp_id)->first();
    }

    function joinCamp($camp)
    {
        $isRelated = $this->show($camp->id);
        if ($isRelated){
            throw new \Exception('you are already in the camp', 403);
        }
        $user = auth()->user();
        $request =  $user->requests()->where('type', 'join_camp')
            ->whereJsonContains('data->camp_id', $camp->id)
            ->first();
        if($request){
            throw new \Exception('you are already sent request to join this camp', 403);
        }
        $request =  $user->requests()->create(
            [
                'type' => 'join_camp',
                'data' => [
                    'model' => Teacher::class,
                    'user_id'=>$user->id,
                    'camp_id' => $camp->id
                ]
            ]
        );

        Notification::send($camp->admins, new joinCampRequest($camp,'Teacher',auth()->user() ,$request->id));
        return true;
    }

    function forget($camp_id)
    {
        $camp = $this->teacher->camps()->where('camps.id', $camp_id)->first();
        if(!$camp){
            return false;
        }
        return $this->teacher->camps()->detach($camp_id);
    }
}
