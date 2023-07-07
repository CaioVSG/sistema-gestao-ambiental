<?php

namespace App\Http\Requests;

use App\Models\Beneficiario;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Jetstream\Jetstream;
use App\Models\User;

class BeneficiarioRequest extends FormRequest{
    public function authorize()
    {
        return auth()->user()->role == User::ROLE_ENUM['secretario'];
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:255|unique:beneficiario',
            'rg' => 'required|string|max:255|unique:beneficiario',
            'nis' => 'required|string|max:255|unique:beneficiario',
            'quantidade_pessoas' => 'required|integer|max:255',
            'observacao' => 'nullable|string|max:255',     
        ];
    }
}