<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Contact\ContactDetailsResource;
use App\Http\Resources\Dashboard\Contact\ContactIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   use ApiResponses;
    public function index()
    {
       $general_contacts=Contact::where('product_id','=',null)->latest()->get();
       $product_contacts=Contact::where('product_id','<>',null)->latest()->get();
       $data=[
         'general_contacts'  =>ContactIndexResource::collection($general_contacts),
         'product_contacts'  =>ContactIndexResource::collection($product_contacts)
       ];

        return $this->apiResponse($data);
    }

    public function show($id)
    {
        $contact=Contact::findOrFail($id);
        return $this->apiResponse(new ContactDetailsResource($contact));
    }


    public function destroy($id)
    {
        $contact=Contact::findOrFail($id)->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }
}
