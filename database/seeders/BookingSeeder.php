<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil beberapa user dan schedule untuk membuat booking
        $users = User::where('role', 'pasien')->take(3)->get();
        $schedules = Schedule::take(5)->get();

        if ($users->isEmpty() || $schedules->isEmpty()) {
            return;
        }

        // Booking 1 - Pending
        Booking::create([
            'user_id' => $users->first()->id,
            'schedule_id' => $schedules->first()->id,
            'keluhan' => 'Saya mengalami sakit kepala yang berkelanjutan selama 3 hari terakhir. Rasa sakitnya terasa di bagian belakang kepala dan kadang disertai mual. Mohon konsultasi untuk penanganan yang tepat.',
            'status' => Booking::STATUS_PENDING,
        ]);

        // Booking 2 - Diterima
        if ($users->count() > 1 && $schedules->count() > 1) {
            Booking::create([
                'user_id' => $users->get(1)->id,
                'schedule_id' => $schedules->get(1)->id,
                'keluhan' => 'Saya mengalami demam tinggi selama 2 hari dengan suhu 39°C. Disertai dengan batuk kering dan badan terasa lemas. Apakah perlu pemeriksaan lebih lanjut?',
                'status' => Booking::STATUS_DITERIMA,
            ]);
        }

        // Booking 3 - Ditolak
        if ($users->count() > 2 && $schedules->count() > 2) {
            Booking::create([
                'user_id' => $users->get(2)->id,
                'schedule_id' => $schedules->get(2)->id,
                'keluhan' => 'Saya mengalami nyeri pada perut bagian kanan bawah. Rasa nyeri semakin bertambah saat bergerak dan disertai demam ringan.',
                'status' => Booking::STATUS_DITOLAK,
            ]);
        }

        // Booking 4 - Pending
        if ($schedules->count() > 3) {
            Booking::create([
                'user_id' => $users->first()->id,
                'schedule_id' => $schedules->get(3)->id,
                'keluhan' => 'Saya mengalami gangguan tidur selama seminggu terakhir. Sulit untuk tidur dan sering terbangun di tengah malam. Mohon saran untuk mengatasi insomnia ini.',
                'status' => Booking::STATUS_PENDING,
            ]);
        }

        // Booking 5 - Diterima
        if ($schedules->count() > 4) {
            Booking::create([
                'user_id' => $users->get(1)->id ?? $users->first()->id,
                'schedule_id' => $schedules->get(4)->id,
                'keluhan' => 'Saya mengalami tekanan darah tinggi yang tidak stabil. Kadang normal, kadang tinggi. Mohon konsultasi untuk pengaturan pola makan dan gaya hidup yang tepat.',
                'status' => Booking::STATUS_DITERIMA,
            ]);
        }
    }
}
