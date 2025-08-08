<?php

namespace App\Http\Requests\Users;

use App\DTOs\Users\UpdateUserDTO;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UpdateUserRequest extends FormRequest
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
            'id' => ['required'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->input('id'))],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * @return UpdateUserDTO
     *
     * @throws UnknownProperties
     */
    public function toDTO(): UpdateUserDTO {
        return new UpdateUserDTO([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
        ]);
    }
}
