<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AdminLoginRequest;
use App\Http\Requests\Dashboard\Admin\StoreAdminRequest;
use App\Http\Requests\Dashboard\Admin\UpdateAdminRequest;
use App\Http\Resources\Dashboard\Admin\AdminDetailsResource;
use App\Http\Resources\Dashboard\Admin\AdminIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    use ApiResponses;
    //admin login
    public function login(AdminLoginRequest $request){
        if (!$token = auth('api')->attempt($request->only(['email', 'password']))) {
            return $this->apiResponse(null, trans('app.messages.failed_login'), 422);
        }
        $admin = auth('api')->user();
        array_set($admin, 'token', $token);
        if($admin->type=='admin' || $admin->type=='superadmin')
            return $this->apiResponse(new AdminDetailsResource($admin), trans('app.messages.success_login'), 200);

        else
            return  $this->apiResponse(null,trans('app.messages.not_allowed_to_login'),403);

    }

    public function index()
    {
        $admins=User::whereType('admin')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(AdminIndexResource::collection($admins),'',200);
    }



    public function store(StoreAdminRequest $request)
    {

        $admin=User::create($request->validated()+['type'=>'admin']);
        return $this->apiResponse(new AdminIndexResource($admin),trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $admin=User::whereType('admin')->find($id);
        if(!$admin){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new AdminIndexResource($admin),'',200);
    }



    public function update(UpdateAdminRequest $request, $id)
    {
        $admin=User::whereType('admin')->find($id);
        if(!$admin){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $admin->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $admin=User::whereType('admin')->find($id);
        if(!$admin){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $admin->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->apiResponse(null, trans('app.messages.success_logout'),200);
    }


}
