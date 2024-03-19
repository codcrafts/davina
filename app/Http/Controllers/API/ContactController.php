<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreContactRequest;
use App\Http\Traits\ApiResponses;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponses;

    //send contact details
    public function store(StoreContactRequest $request){
       Contact::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


}
