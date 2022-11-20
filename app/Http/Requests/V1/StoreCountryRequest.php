<?php

namespace App\Http\Requests\V1;

use App\Rules\IsCountryCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
        return [
            'countryCode' => ['required', 'unique:countries,country_code', new IsCountryCode],
            'phoneCode' => ['required', 'numeric', 'min:1', 'max:9999'],
        ];
    }

    /**
    * Prepare the data for validation.
    *
    * @return void
    */
    protected function prepareForValidation(){
        $this->merge([
            'country_code' => $this->countryCode,
            'phone_code' => $this->phoneCode,
        ]);
    }
}
