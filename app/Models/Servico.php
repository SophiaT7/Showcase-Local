<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['vitrine_id', 'nome', 'descricao', 'preco', 'preco_label', 'ativo', 'ordem'];

    public function vitrine() { return $this->belongsTo(Vitrine::class); }
}
