<?php

namespace App\Http\Requests\Dashboard\Offer;

use App\Http\Requests\RequestBaseAPI;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends RequestBaseAPI
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
// dd($this->all());
        return [

            'product_id'=>'required|exists:products,id',
            'discount'=>'required|numeric|between:0,99.99',
            'end_date'=>'required|date|date_format:Y-m-d|after:'. now()->format('Y-m-d'),

        ];
    }

    public function getValidatorInstance(){
        $data = $this->all();
        if(isset($data['end_date'])){
//            $data['end_date'] = date('d/m/Y', strtotime($data['end_date']));
            //   $date = \Carbon\Carbon::parse($data['end_date']);
            $data['end_date'] = \Carbon\Carbon::parse($data['end_date'])->format('Y-m-d');

        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
