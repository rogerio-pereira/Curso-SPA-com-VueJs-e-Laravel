<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'conteudo_id',
        'texto',
        'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class);
    }

    public function getDataAttribute($value)
    {
        $data = date('H:i d/m/Y', strtotime($value));
        return str_replace(':', 'h', $data);
    }
}
