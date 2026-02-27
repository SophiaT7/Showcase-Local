<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['vitrine_id', 'dia_semana', 'abertura', 'fechamento', 'fechado'];

    public function vitrine() { return $this->belongsTo(Vitrine::class); }

    public function getNomeDiaAttribute(): string
    {
        return ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'][$this->dia_semana];
    }
}
