<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Client\ClientStoreRequest;
use App\Http\Requests\Dashboard\Client\ClientUpdateRequest;
use App\Http\Requests\Dashboard\Delete\DeleteRequest;
use App\Http\Resources\Dashboard\Client\AllClientDataResource;
use App\Http\Resources\Dashboard\Client\ClientIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $users=User::whereType('client')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(ClientIndexResource::collection($users),'',200);
    }


    public function store(ClientStoreRequest $request)
    {
        User::create($request->validated()+['type'=>'client','is_verified'=>1]);
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $user=User::whereType('client')->find($id);
        if(!$user){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new AllClientDataResource($user),'',200);
    }



    public function update(ClientUpdateRequest $request, $id)
    {
        $user=User::whereType('client')->find($id);
        if(!$user){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $user->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $user=User::whereType('client')->find($id);
        if(!$user){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $user->delete();
        \File::delete(storage_path('app/public/uploads/'.$user->avatar));
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    public function deleteAll(DeleteRequest $request){
        $ids = $request->ids;
        $users=User::whereIn('id',$ids)->get();
        foreach ($users as $user){
            if($user->type=='user')
                \File::delete(storage_path('app/public/uploads/'.$user->avatar));
            $user->delete();
        }

        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);

    }
}
