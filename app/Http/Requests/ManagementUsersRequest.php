<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementUsersRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string', 'max:255'],
            'company_id' => 'nullable|exists:companies,id',
        ];
    }
    protected function prepareForValidation()
    {
        // Jika user memilih "Lainnya" (value 0), jadikan null
        if ($this->company_id == 0) {
            $this->merge([
                'company_id' => null
            ]);
        }
    }
}
