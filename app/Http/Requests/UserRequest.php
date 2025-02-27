<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Vous pouvez modifier ceci selon vos besoins d'autorisation
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user?->id,
            'password' => 'required|string|min:8|confirmed', 
            'role' => 'required|string|in:admin,employee,manager', 
            'employee_id' => 'required|string|unique:users,employee_id,' . $this->user?->id,
            'position' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'hire_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:active,inactive,terminated',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'contract_type' => 'required|in:permanent,temporary,contract',
            'profile_picture' => 'nullable|image|max:2048' // 2MB max, nullable car optionnel
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'employee_id.unique' => 'Cet ID employé est déjà utilisé.',
            'hire_date.before_or_equal' => 'La date d\'embauche ne peut pas être dans le futur.',
            'date_of_birth.before' => 'La date de naissance doit être dans le passé.',
            'profile_picture.image' => 'Le fichier doit être une image.',
            'profile_picture.max' => 'L\'image ne doit pas dépasser 2MB.'
        ];
    }
}