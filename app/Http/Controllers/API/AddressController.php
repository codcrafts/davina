<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Address\SelectAddressRequest;
use App\Http\Requests\API\Address\StoreAddressRequest;
use App\Http\Requests\API\Address\UpdateAddressRequest;
use App\Http\Resources\API\Address\AddressResource;
use App\Http\Traits\ApiResponses;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use ApiResponses;

    //all addresses
    public function index()
    {
        $addresses=Address::where('user_id',auth('api')->id())->get();
        return $this->apiResponse(AddressResource::collection($addresses),'',200);
    }

    public function store(StoreAddressRequest $request)
    {

        Address::create($request->validated()+['user_id'=>auth('api')->id()]);
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {

        $address=Address::find($id);
        if(!$address){
            return $this->apiResponse(null,trans('app.exceptions.no_record_found'),422);
        }
        return $this->apiResponse(new AddressResource($address),'',200);
    }





    public function update(UpdateAddressRequest $request, $id)
    {
        $address=Address::find($id);
        if(!$address){
            return $this->apiResponse(null,trans('app.exceptions.no_record_found'),422);
        }
        $address->update($request->validated());

        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $address=Address::find($id);
        if(!$address){
            return $this->apiResponse(null,trans('app.exceptions.no_record_found'),422);
        }
        $address->delete();
        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }

    public function selectAddress(SelectAddressRequest $request)
    {
        $old_address = Address::where('user_id', auth('api')->id())->where('is_default', 1)->first();
        if ($old_address) {
            $old_address->is_default = 0;
            $old_address->save();
        }
        $new_address =Address::find($request->address_id);
        $new_address->is_default = 1;
        $new_address->save();
        return $this->apiResponse(new AddressResource($new_address),trans('app.messages.updated_successfully'),200);
    }

}
