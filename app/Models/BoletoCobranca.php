<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Requerimento;

class BoletoCobranca extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_vencimento',
        'caminho_arquivo_remessa',
        'caminho_arquivo_resposta',
        'codigo_de_barras',
        'linha_digitavel',
        'nosso_numero', 
        'URL',
    ];

    public function requerimento()
    {
        return $this->belongsTo(Requerimento::class, 'requerimento_id');
    }

    public function salvar_arquivo($string, Requerimento $requerimento) 
    {
        if ($this->caminho_arquivo_remessa != null) {
            if (Storage::disk()->exists('public/'. $this->caminho_arquivo_remessa)) {
                Storage::delete('public/'. $this->caminho_arquivo_remessa);
            }
        }

        $caminho_arquivo = "remessas/";
        $documento_nome = "incluir_boleto_remessa_".$requerimento->id.".xml";
        $this->gerar_arquivo($string, $caminho_arquivo . $documento_nome);
        $this->caminho_arquivo_remessa = $caminho_arquivo . $documento_nome;
    }

    private function gerar_arquivo($string, $caminho) 
    {
        $file = fopen(storage_path('').'/app/'.$caminho, 'w+');
        
        fwrite($file, $string);
        
        fclose($file);
    }
}
