<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\NewsLetter\NewsLetterResource;
use App\Http\Traits\ApiResponses;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    use ApiResponses;
    public function index()
    {
         $subscribers=NewsLetter::latest()->get();
         return $this->apiResponse(NewsLetterResource::collection($subscribers));
    }


    public function destroy($id)
    {
        $subscriber=NewsLetter::findOrFail($id)->delete();
        return  $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }
}
