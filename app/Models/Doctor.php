<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'calista_doctors';

    protected $fillable = [
        'nama',
        'spesialis',
        'kontak',
        'deskripsi',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'doctor_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'doctor_id');
    }
}
