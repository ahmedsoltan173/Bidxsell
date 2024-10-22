<?php

namespace App\Http\Requests\Tickiting;

use App\Models\Ticketing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Trait\ResponseFormater;

class TickitingRequest extends FormRequest
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
            "event_id"=>'required|exists:events,id',
            "customer_name"=>'required_without:group_name',
            'customer_email'=>'required_without:group_name|email',
            'no_of_tickets'=>'required_without:number_of_tickets|integer',
            'seat_preference'=>'required_without_all:backstage_access,complimentary_drinks',

            'backstage_access'=>'required_with_all:complimentary_drinks',
            'complimentary_drinks'=>'required_with_all:backstage_access',


            "group_name"=>'required_with_all:special_requests,number_of_tickets',
            'special_requests'=>'required_with_all,group_name,number_of_tickets',
            'number_of_tickets'=>'required_with_all,group_name,special_requests|integer'
            ];
    }

public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if ($this->has('backstage_access') && $this->has('complimentary_drinks')) {
            $this->merge(['category' => Ticketing::VIP]);
        } elseif ($this->has('group_name') && $this->has('number_of_tickets')&& $this->has('special_requests')) {
            $this->merge(['category' => Ticketing::GROUP]);
        } else {
            $this->merge(['category' => Ticketing::GENERAL]);
        }
    });
}

    protected function failedValidation(Validator $validator)
    {

        $response=$this->error("errors",Response::HTTP_UNPROCESSABLE_ENTITY,$validator->errors());
        throw new ValidationException($validator, $response);
    }
}
