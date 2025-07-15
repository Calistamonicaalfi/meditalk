<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'calista_schedules';

    protected $fillable = ['doctor_id', 'hari', 'jam_mulai', 'jam_selesai', 'kapasitas'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'schedule_id');
    }
}
