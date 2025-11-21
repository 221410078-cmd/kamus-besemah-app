<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kalimat extends Model
{
    protected $table = 'kalimat';

    protected $fillable = [
        'id_kalimat',
        'sub_id',
        'kalimat',
        'arti_kalimat',
        'status'
    ];

    public function kata()
    {
        return $this->belongsTo(Kata::class, 'sub_id', 'id_kata');
    }
}
