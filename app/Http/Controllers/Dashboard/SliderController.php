<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Slider\StoreSliderRequest;
use App\Http\Requests\Dashboard\Slider\UpdateSliderRequest;
use App\Http\Resources\Dashboard\Slider\SliderResource;
use App\Http\Traits\ApiResponses;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $sliders=Slider::whereType('slider')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(SliderResource::collection($sliders),'',200);
    }




    public function store(StoreSliderRequest $request)
    {
        Slider::create($request->validated()+['type'=>'slider']);
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);

    }


    public function show($id)
    {
        $slider=Slider::whereType('slider')->find($id);
        if(!$slider){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new SliderResource($slider),'',200);

    }




    public function update(UpdateSliderRequest $request, $id)
    {
        $slider=Slider::whereType('slider')->find($id);
        if(!$slider){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $slider->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);

    }


    public function destroy($id)
    {
        $slider=Slider::whereType('slider')->find($id);
        if(!$slider){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        \File::delete(storage_path('app/public/uploads/'.$slider->image));
        $slider->delete();

        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);

    }
}
