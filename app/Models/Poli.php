<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_poli',
        'deskripi'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_poli');
    }
}
