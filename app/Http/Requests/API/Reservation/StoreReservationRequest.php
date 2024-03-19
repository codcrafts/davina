<?php

namespace App\Http\Requests\API\Reservation;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends RequestBaseAPI
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
        return [
            'name'=>'required|string',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'occasion_id'=>'required|exists:occasions,id',
            'occasion_date'=>'required|date|date_format:Y-m-d|after:'. now()->format('Y-m-d'),
        ];
    }

    public function getValidatorInstance(){
        $data = $this->all();
        if(isset($data['occasion_date'])){
            $data['occasion_date'] = \Carbon\Carbon::parse($data['occasion_date'])->format('Y-m-d');

        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
