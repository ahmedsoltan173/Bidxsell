<?php

namespace App\Http\Requests\Tickiting;

use App\Trait\ResponseFormater;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CreateEventRequest extends FormRequest
{
    use ResponseFormater;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            "event_name"=>'required|string|min:3',
            'event_date_time'=>'required|date',
            'ticket_price'=>'required|numeric',
            'venue'=>'required|string'
            ];
    }
    protected function failedValidation(Validator $validator)
    {

        $response=$this->error("errors",Response::HTTP_UNPROCESSABLE_ENTITY,$validator->errors());
        throw new ValidationException($validator, $response);
    }


}
