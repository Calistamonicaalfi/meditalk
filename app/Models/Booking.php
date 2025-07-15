<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'calista_bookings';
    protected $fillable = ['user_id', 'schedule_id', 'status', 'keluhan'];

    // Konstanta untuk status booking (sesuai enum di database)
    const STATUS_PENDING = 'pending';
    const STATUS_DITERIMA = 'diterima';
    const STATUS_DITOLAK = 'ditolak';

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    // Relasi ke dokter melalui schedule
    public function doctor()
    {
        return $this->hasOneThrough(Doctor::class, Schedule::class, 'id', 'id', 'schedule_id', 'doctor_id');
    }

    // Scope untuk booking berdasarkan status
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeDiterima($query)
    {
        return $query->where('status', self::STATUS_DITERIMA);
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', self::STATUS_DITOLAK);
    }

    // Scope untuk booking publik (tanpa user)
    public function scopePublic($query)
    {
        return $query->whereNull('user_id');
    }

    // Scope untuk booking user yang login
    public function scopeUser($query)
    {
        return $query->whereNotNull('user_id');
    }

    // Helper method untuk cek status
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isDiterima()
    {
        return $this->status === self::STATUS_DITERIMA;
    }

    public function isDitolak()
    {
        return $this->status === self::STATUS_DITOLAK;
    }

    // Helper method untuk cek apakah booking publik
    public function isPublic()
    {
        return is_null($this->user_id);
    }

    // Accessor untuk status dalam bahasa Indonesia
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Menunggu';
            case self::STATUS_DITERIMA:
                return 'Diterima';
            case self::STATUS_DITOLAK:
                return 'Ditolak';
            default:
                return ucfirst($this->status);
        }
    }

    // Accessor untuk nama pasien
    public function getNamaPasienAttribute()
    {
        if ($this->user) {
            return $this->user->name;
        }
        return 'Pasien Publik';
    }
}
