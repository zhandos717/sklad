<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'contextKey'  => 'sometimes|required|string',
            'accountId'   => 'sometimes|required|string',
            'infoMessage' => 'sometimes|required|string',
            'store'       => 'sometimes|required|string',
            'status'      => 'sometimes|required|string',
            'access'      => 'sometimes|required|array',
        ];
    }

    public function getAccessToken()
    {
        return $this->input('access');
    }


}
