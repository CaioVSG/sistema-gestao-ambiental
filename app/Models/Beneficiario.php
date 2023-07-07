<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model {
    use HasFactory;

    protected $table = 'beneficiario';
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'nis',
        'quantidade_pessoas',
        'observacao',
        'telefone_id',
        'endereco_id'
    ];

    public function telefone() {
        return $this->belongsTo(Telefone::class);
    }

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }


    public function setAtributes($input){
        $this->nome = $input['name'];
        $this->cpf = $input['cpf'];
        $this->rg = $input['rg'];
        $this->nis = $input['nis'];
        $this->quantidade_pessoas = $input['quantidade_pessoas'];
        $this->observacao = $input['complemento'];
    }

}