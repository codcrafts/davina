<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Testimonials\StoreTestimonialRequest;
use App\Http\Requests\Dashboard\Testimonials\UpdateTestimonialRequest;
use App\Http\Resources\Dashboard\TestimonialsIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    use ApiResponses;

    public function index()
    {

        $testimonials=Testimonial::orderBy('id', 'DESC')->get();
        return $this->apiResponse(TestimonialsIndexResource::collection($testimonials),'',200);
    }





    public function store(StoreTestimonialRequest $request)
    {
        Testimonial::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $testimonial=Testimonial::find($id);
        if(!$testimonial){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new TestimonialsIndexResource($testimonial) ,'',200);
    }




    public function update(UpdateTestimonialRequest $request, $id)
    {
        $testimonial=Testimonial::find($id);
        if(!$testimonial){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $testimonial->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $testimonial=Testimonial::find($id);
        if(!$testimonial){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        \File::delete(storage_path('app/public/uploads/'.$testimonial->image));
        $testimonial->delete();

        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }
}
