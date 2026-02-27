<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriaFoto extends Model
{
    protected $fillable = ['vitrine_id', 'path', 'legenda', 'ordem'];

    public function vitrine() { return $this->belongsTo(Vitrine::class); }
}
