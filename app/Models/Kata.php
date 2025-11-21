<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kata extends Model
{
    protected $table = 'kata';

    protected $fillable = [
        'id_kata',
        'id_sub',
        'jenis_kata',
        'kategori_kata',
        'kata',
        'cara_baca',
        'definisi',
        'status',
    ];

    public function sub()
    {
        return $this->belongsTo(Kata::class, 'id_sub', 'id_kata');
    }
    public function turunan()
{
    return $this->hasMany(Kata::class, 'id_sub', 'id_kata');
}

public function kalimat()
{
    return $this->hasMany(Kalimat::class, 'sub_id', 'id_kata');
}

}
