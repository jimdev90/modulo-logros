<?php

namespace App\Http\Requests\Auth;

use App\Models\UnidadUser;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate()
    {
        $user = User::where('idusuarios', $this->login)
            ->orWhere('usuario_nombre', $this->login)
            ->where('estado', 1)
            ->first();


        if (!$user || !$this->compararPassword($user->usuario_clave, $this->password)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'login' => trans('auth.failed')
            ]);
        }

        $active = UnidadUser::where('idusuarios', $user->idusuarios)
            ->where('state', 'active')
            ->first();
        if (!$active) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'login' => trans('auth.noActive')
            ]);
        }

        Auth::login($user, $this->boolean('remember'));
        RateLimiter::clear($this->throttleKey());
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('login')) . '|' . $this->ip());
    }

    private function compararPassword($userPassword, $password): bool
    {
        if ($userPassword === md5($password)) {
            return true;
        } else {
            return false;
        }
    }
}
