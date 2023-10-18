<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskListRequest extends FormRequest
{
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
            'title' => 'required',
        ];
    }

    /*
    * Configure the validator instance
    *
    * @param \Illuminate\Validation\Validator  $validator
    * @return void
    */
    public function withValidator($validator) {
        if ($validator->fails()){
            throw new HttpResponseException(response()->json(
                [
                    'msg' => 'Ops! Algum campo obrigatório não foi preenchido.',
                    'status' => false,
                    'errors' => $validator->errors(),
                    'url' => route('tasklist.store')
                ],
                403
            ));
        }
    }
}
