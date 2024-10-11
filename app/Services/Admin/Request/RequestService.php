<?php

namespace App\Services\Admin\Request;

use App\Models\Request;
use App\Models\Student;
use App\Notifications\joinCampResponse;
use Illuminate\Support\Facades\Notification;

class RequestService
{

    function getAll()
    {
        $camps_id = auth()->user()->camps()->get()->pluck('id');
        $results = Request::where('type', 'join_camp')
            ->where(function($query) use ($camps_id) {
                foreach ($camps_id as $camp_id) {
                    $query->orWhereJsonContains('data->camp_id', $camp_id);
                }
            })
            ->get();
        return $results;
    }

    function reply($request , $status)
    {

        $camp = auth()->user()->camps()->where('camps.id',$request->data->camp_id)->first();
        if (!$camp){
            throw new \Exception('you are not admin in this camp',403);
        }

        $model = $request->data->model ;

        if ( filter_var($status, FILTER_VALIDATE_BOOLEAN) ){
            if ($model == Student::class){
                $model::where('id',$request->data->user_id)->update(['camp_id'=>$request->data->camp_id]);
            }else{
                $model::find($request->data->user_id)->camps()->attach($request->data->camp_id);
            }
        }
        $user = $model::find($request->data->user_id);

        Notification::send($user,new joinCampResponse($camp,$status));
        return $request->delete();
    }

}
