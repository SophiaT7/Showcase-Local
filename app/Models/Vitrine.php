<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vitrine extends Model
{

    protected $fillable = [
        'user_id', 'categoria_id', 'nome', 'slug', 'descricao',
        'foto_perfil', 'banner', 'whatsapp', 'cidade', 'bairro',
        'estado', 'cor_primaria', 'status',
    ];

    protected $appends = ['foto_perfil_url', 'banner_url'];

    public function getFotoPerfilUrlAttribute()
    {
        return $this->foto_perfil 
            ? asset('storage/' . $this->foto_perfil)
            : null;
    }

    public function getBannerUrlAttribute()
    {
        return $this->banner 
            ? asset('storage/' . $this->banner)
            : null;
    }

    public function user() { return $this->belongsTo(User::class); }
    public function categoria() { return $this->belongsTo(Categoria::class); }
    public function servicos() { return $this->hasMany(Servico::class); }
    public function galeria() { return $this->hasMany(GaleriaFoto::class)->orderBy('ordem'); }
    public function horarios() { return $this->hasMany(Horario::class)->orderBy('dia_semana'); }
    public function avaliacoes() { return $this->hasMany(Avaliacao::class); }
}
