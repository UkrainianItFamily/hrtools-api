<?php

declare(strict_types=1);

namespace App\Http\Request\Api\Auth;

use App\Http\Request\ApiFormRequest;
use Illuminate\Validation\Rules\Password;

final class ApplyNewPasswordHttpRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'sometimes|required|email',
            'password' => ['required',Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => ['required',Password::min(8)->mixedCase()->numbers()],
        ];
    }
}
