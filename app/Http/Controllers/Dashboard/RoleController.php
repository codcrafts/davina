<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\StoreRoleRequest;
use App\Http\Requests\Dashboard\Role\UpdateRoleRequest;
use App\Http\Resources\Dashboard\Admin\AdminIndexResource;
use App\Http\Resources\Dashboard\Role\RoleDetailsResource;
use App\Http\Resources\Dashboard\Role\RoleResource;
use App\Http\Traits\ApiResponses;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
     //traitt
    use ApiResponses;

    public function index()
    {
        $roles=Role::latest()->get();
        return $this->apiResponse(RoleResource::collection($roles));
    }


    public function store(StoreRoleRequest $request)
    {
//        $permission_inputs=$request->validated()['permissions'];
//        $role_inputs = array_only($request->validated(),config('translatable.locales'));
        try {

            $role = Role::create(array_except($request->validated(), ['permissions']));
            foreach ($request->permissions as $key => $value) {
                $role->permissions()->updateOrCreate(['route_name' => $value['route_name'],'role_id' => $role->id],
                    [
                        'route_name' => $value['route_name'],
                        'is_show' => $value['is_show'],
                        'is_create' => $value['is_create'],
                        'is_edit' => $value['is_edit'],
                        'is_destroy' => $value['is_destroy'],
                    ]);

            }
        }
        catch (\Exception $e) {
            \DB::rollback();
            return $this->apiResponse(null, 'حدث خطأ ما', 422);

        }

            return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);
        }

        //here is show roles
    public function show($id)
    {
        $role=Role::find($id);
        if(!$role){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new RoleDetailsResource($role),'',200);

    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role=Role::find($id);
        if(!$role){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        try {
           $role->update(array_except($request->validated(), ['permissions']));
           if($request->permissions) {
               foreach ($request->permissions as $key => $value) {
                   $role->permissions()->update(
                       [
                           'route_name' => $value['route_name'],
                           'is_show' => $value['is_show'],
                           'is_create' => $value['is_create'],
                           'is_edit' => $value['is_edit'],
                           'is_destroy' => $value['is_destroy'],
                       ]);

               }
           }

        }
        catch (\Exception $e) {
            \DB::rollback();
            return $this->apiResponse(null, 'حدث خطأ ما', 422);
        }


        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);

    }

    public function destroy($id)
    {
        $role=Role::find($id);
        if(!$role){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $role->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);

    }
}
