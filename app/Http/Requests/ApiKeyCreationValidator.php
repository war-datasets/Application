<?php

namespace ActivismeBE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiKeyCreationValidator extends FormRequest
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
        return ['service' => 'required'];
    }

    /**
     * Overwrite the default response method to set a flash session.
     *
     * @param  array $errors The validation errors
     * @return $this
     */
    public function response(array $errors)
    {
        session()->flash('tab-status', 'api-key');

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
