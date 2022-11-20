<?php

namespace App\Http\Requests\V1;

use App\Rules\IsCountryCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        if($method == 'PUT'){
            return [
                'countryCode' => ['required', 'unique:countries,country_code', new IsCountryCode],
                'phoneCode' => ['required', 'numeric', 'min:1', 'max:9999'],
            ];
        }else{
            return [
                'countryCode' => ['sometimes', 'required', 'unique:countries,country_code', new IsCountryCode],
                'phoneCode' => ['sometimes', 'required', 'numeric', 'min:1', 'max:9999'],
            ];
        }
    }

    /**
    * Prepare the data for validation.
    *
    * @return void
    */
    protected function prepareForValidation(){
        if($this->countryCode){
            $this->merge([
                'country_code' => $this->countryCode,
            ]);
        }
        if($this->phoneCode){
            $this->merge([
                'phone_code' => $this->phoneCode,
            ]);
        }
        
    }
}
