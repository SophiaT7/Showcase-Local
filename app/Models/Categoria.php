<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'slug', 'icone', 'ativo'];

    public function vitrines()
    {
        return $this->hasMany(Vitrine::class);
    }
}
