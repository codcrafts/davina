<?php

namespace App\Http\Resources\API\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
             'id'=>$this->id,
             'title'=>$this['title_'.app()->getLocale()],
             'image'=>$this->image_org,
            //'image'=>resize_image(storage_path('app/public/uploads/' .$this->image),$request->width,$request->height,null,$request->quality),
        ];
    }
}
