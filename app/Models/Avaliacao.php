<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = ['vitrine_id', 'nome_visitante', 'nota', 'comentario', 'aprovado'];

    public function vitrine() { return $this->belongsTo(Vitrine::class); }
}
