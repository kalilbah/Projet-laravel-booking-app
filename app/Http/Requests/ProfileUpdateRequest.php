<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // Valide l'image envoyée pour la photo de profil avec une taille raisonnable.
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            // Permet de demander explicitement la suppression de la photo actuelle.
            'remove_profile_photo' => ['nullable', 'boolean'],
        ];
    }
}
