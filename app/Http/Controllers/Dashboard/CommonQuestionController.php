<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CommonQuestion\CommonQuestionRequest;
use App\Http\Requests\Dashboard\CommonQuestion\UpdateCommonQuestionRequest;
use App\Http\Resources\Dashboard\CommonQuestion\CommonQuestionResource;
use App\Http\Traits\ApiResponses;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class CommonQuestionController extends Controller
{
    use ApiResponses;


    public function index(){

        $questions=CommonQuestion::orderBy('id', 'DESC')->get();
        return $this->apiResponse(CommonQuestionResource::collection($questions),'',200);
    }

    public function store(CommonQuestionRequest $request){

        CommonQuestion::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);

    }
    public function show($id)
    {
        $question=CommonQuestion::find($id);
        if(!$question){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        return  $this->apiResponse(new CommonQuestionResource($question),'',200);
    }

    public function update(UpdateCommonQuestionRequest $request, $id)
    {
        $question=CommonQuestion::find($id);
        if(!$question){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        $question->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }
    public function destroy($id)
    {
        $question=CommonQuestion::find($id);
        if(!$question){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        $question->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }









}
