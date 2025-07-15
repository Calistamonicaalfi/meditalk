<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Article;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =====================
        // USERS (Admin & Pasien)
        // =====================

        // Admin
        User::create([
            'name' => 'Admin MediTalk',
            'email' => 'admin@meditalk.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Pasien 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@meditalk.com',
            'password' => Hash::make('budi123'),
            'role' => 'pasien',
        ]);

        // Pasien 2
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@meditalk.com',
            'password' => Hash::make('siti123'),
            'role' => 'pasien',
        ]);

        // =====================
        // DOKTER
        // =====================

        $dokter1 = Doctor::create([
            'nama' => 'Dr. Sarah Johnson',
            'spesialis' => 'Dokter Umum',
            'kontak' => '081234567890',
            'deskripsi' => 'Dokter umum dengan pengalaman 10 tahun dalam menangani berbagai keluhan kesehatan.',
        ]);

        $dokter2 = Doctor::create([
            'nama' => 'Dr. Michael Chen',
            'spesialis' => 'Dokter Gigi',
            'kontak' => '081234567891',
            'deskripsi' => 'Spesialis gigi dengan fokus pada perawatan gigi anak dan dewasa.',
        ]);

        $dokter3 = Doctor::create([
            'nama' => 'Dr. Lisa Wong',
            'spesialis' => 'Dokter Anak',
            'kontak' => '081234567892',
            'deskripsi' => 'Dokter spesialis anak dengan pengalaman menangani berbagai penyakit anak.',
        ]);

        $dokter4 = Doctor::create([
            'nama' => 'Dr. Robert Smith',
            'spesialis' => 'Dokter Jantung',
            'kontak' => '081234567893',
            'deskripsi' => 'Kardiologis dengan spesialisasi penyakit jantung dan pembuluh darah.',
        ]);

        $dokter5 = Doctor::create([
            'nama' => 'Dr. Maria Garcia',
            'spesialis' => 'Dokter Kulit',
            'kontak' => '081234567894',
            'deskripsi' => 'Dermatologis dengan pengalaman menangani berbagai masalah kulit.',
        ]);

        // =====================
        // JADWAL DOKTER
        // =====================

        // Jadwal Dr. Sarah
        Schedule::create([
            'doctor_id' => $dokter1->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
        ]);

        Schedule::create([
            'doctor_id' => $dokter1->id,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
        ]);

        // Jadwal Dr. Michael
        Schedule::create([
            'doctor_id' => $dokter2->id,
            'hari' => 'Selasa',
            'jam_mulai' => '09:00',
            'jam_selesai' => '15:00',
        ]);

        Schedule::create([
            'doctor_id' => $dokter2->id,
            'hari' => 'Kamis',
            'jam_mulai' => '08:00',
            'jam_selesai' => '14:00',
        ]);

        // Jadwal Dr. Lisa
        Schedule::create([
            'doctor_id' => $dokter3->id,
            'hari' => 'Jumat',
            'jam_mulai' => '10:00',
            'jam_selesai' => '16:00',
        ]);

        Schedule::create([
            'doctor_id' => $dokter3->id,
            'hari' => 'Sabtu',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
        ]);

        // Jadwal Dr. Robert
        Schedule::create([
            'doctor_id' => $dokter4->id,
            'hari' => 'Senin',
            'jam_mulai' => '14:00',
            'jam_selesai' => '18:00',
        ]);

        Schedule::create([
            'doctor_id' => $dokter4->id,
            'hari' => 'Rabu',
            'jam_mulai' => '09:00',
            'jam_selesai' => '13:00',
        ]);

        // Jadwal Dr. Maria
        Schedule::create([
            'doctor_id' => $dokter5->id,
            'hari' => 'Selasa',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
        ]);

        Schedule::create([
            'doctor_id' => $dokter5->id,
            'hari' => 'Jumat',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
        ]);

        // =====================
        // ARTIKEL KESEHATAN
        // =====================

        Article::create([
            'judul' => 'Tips Menjaga Kesehatan Jantung di Usia Muda',
            'isi' => 'Jantung adalah organ vital yang perlu dijaga kesehatannya sejak dini. Berikut beberapa tips untuk menjaga kesehatan jantung:

1. Olahraga Teratur
Lakukan olahraga minimal 30 menit sehari, 5 kali seminggu. Olahraga yang baik untuk jantung meliputi jalan kaki, jogging, berenang, atau bersepeda.

2. Konsumsi Makanan Sehat
Konsumi makanan yang kaya serat, rendah lemak jenuh, dan tinggi omega-3. Perbanyak sayuran, buah-buahan, dan ikan.

3. Hindari Merokok dan Alkohol
Merokok dan konsumsi alkohol berlebihan dapat merusak pembuluh darah dan jantung.

4. Kelola Stres
Stres kronis dapat meningkatkan tekanan darah. Lakukan relaksasi, meditasi, atau hobi yang menyenangkan.

5. Rutin Cek Kesehatan
Lakukan pemeriksaan kesehatan rutin untuk mendeteksi masalah jantung sejak dini.

6. Tidur Cukup
Tidur 7-8 jam per hari membantu jantung beristirahat dan memperbaiki sel-sel tubuh.

7. Jaga Berat Badan
Kelebihan berat badan dapat meningkatkan risiko penyakit jantung.

8. Batasi Garam
Konsumi garam berlebihan dapat meningkatkan tekanan darah.

Dengan menerapkan tips di atas, Anda dapat menjaga kesehatan jantung dan mengurangi risiko penyakit kardiovaskular.',
            'doctor_id' => $dokter4->id,
        ]);

        Article::create([
            'judul' => 'Pentingnya Menjaga Kesehatan Gigi dan Mulut',
            'isi' => 'Kesehatan gigi dan mulut sangat penting untuk kesehatan tubuh secara keseluruhan. Berikut adalah panduan lengkap menjaga kesehatan gigi:

MENYIKAT GIGI DENGAN BENAR
- Sikat gigi minimal 2 kali sehari (pagi dan malam)
- Gunakan sikat gigi dengan bulu lembut
- Sikat dengan gerakan melingkar selama 2 menit
- Jangan lupa menyikat lidah untuk menghilangkan bakteri

MENGGUNAKAN DENTAL FLOSS
- Gunakan dental floss setiap hari
- Floss membantu membersihkan sela-sela gigi
- Mencegah penumpukan plak dan karang gigi

MAKANAN YANG BAIK UNTUK GIGI
- Konsumi makanan kaya kalsium (susu, keju, yogurt)
- Makan buah-buahan yang kaya vitamin C
- Hindari makanan manis dan asam berlebihan
- Minum air putih yang cukup

RUTIN KE DOKTER GIGI
- Kunjungi dokter gigi setiap 6 bulan sekali
- Untuk pemeriksaan rutin dan pembersihan karang gigi
- Deteksi dini masalah gigi dan mulut

GEJALA YANG HARUS DIWASPADAI
- Gigi berlubang
- Gusi berdarah
- Bau mulut tidak sedap
- Gigi sensitif
- Gigi goyang

Dengan menjaga kesehatan gigi dan mulut, Anda dapat mencegah berbagai masalah kesehatan serius.',
            'doctor_id' => $dokter2->id,
        ]);

        Article::create([
            'judul' => 'Nutrisi Seimbang untuk Tumbuh Kembang Anak',
            'isi' => 'Nutrisi yang seimbang sangat penting untuk tumbuh kembang anak yang optimal. Berikut adalah panduan nutrisi untuk anak:

KELOMPOK MAKANAN PENTING

1. Karbohidrat
- Beras, roti, pasta, kentang
- Memberikan energi untuk aktivitas sehari-hari
- Konsumi 6-11 porsi per hari

2. Protein
- Daging, ikan, telur, kacang-kacangan
- Penting untuk pertumbuhan otot dan sel
- Konsumi 2-3 porsi per hari

3. Sayuran dan Buah
- Kaya vitamin, mineral, dan serat
- Konsumi 5 porsi per hari
- Variasikan warna untuk nutrisi lengkap

4. Susu dan Produk Olahan
- Kaya kalsium untuk pertumbuhan tulang
- Konsumi 2-3 gelas per hari

5. Lemak Sehat
- Minyak zaitun, alpukat, kacang-kacangan
- Penting untuk perkembangan otak
- Konsumi secukupnya

TIPS MAKANAN SEHAT UNTUK ANAK

1. Sajikan makanan dengan menarik
2. Libatkan anak dalam memilih makanan
3. Berikan contoh pola makan sehat
4. Batasi makanan cepat saji
5. Ajak anak berolahraga rutin

TANDA ANAK KURANG GIZI
- Berat badan tidak naik
- Mudah lelah
- Sering sakit
- Pertumbuhan lambat

Jika anak menunjukkan tanda-tanda tersebut, segera konsultasi dengan dokter anak.',
            'doctor_id' => $dokter3->id,
        ]);

        // =====================
        // SAMPLE BOOKING
        // =====================

        $pasien = User::where('role', 'pasien')->first();
        $schedules = Schedule::all();

        if ($pasien && $schedules->count() > 0) {
            // Booking 1 - Pending
            Booking::create([
                'user_id' => $pasien->id,
                'schedule_id' => $schedules->first()->id,
                'keluhan' => 'Saya mengalami sakit kepala yang berkelanjutan selama 3 hari terakhir. Rasa sakitnya terasa di bagian belakang kepala dan kadang disertai mual. Sudah mencoba obat warung tapi belum sembuh.',
                'status' => 'pending'
            ]);

            // Booking 2 - Diterima
            if ($schedules->count() > 1) {
                Booking::create([
                    'user_id' => $pasien->id,
                    'schedule_id' => $schedules->get(1)->id,
                    'keluhan' => 'Saya ingin berkonsultasi tentang pola makan sehat untuk penderita diabetes. Saat ini saya sudah didiagnosis diabetes tipe 2 dan ingin mengetahui makanan apa yang baik dan tidak baik untuk dikonsumsi.',
                    'status' => 'diterima'
                ]);
            }

            // Booking 3 - Ditolak
            if ($schedules->count() > 2) {
                Booking::create([
                    'user_id' => $pasien->id,
                    'schedule_id' => $schedules->get(2)->id,
                    'keluhan' => 'Saya mengalami gangguan tidur, sulit tidur di malam hari dan sering terbangun. Sudah mencoba berbagai cara tapi belum berhasil. Ingin berkonsultasi untuk mendapatkan solusi yang tepat.',
                    'status' => 'ditolak'
                ]);
            }

            // Booking 4 - Pending
            if ($schedules->count() > 3) {
                Booking::create([
                    'user_id' => $pasien->id,
                    'schedule_id' => $schedules->get(3)->id,
                    'keluhan' => 'Saya ingin berkonsultasi tentang program olahraga yang aman untuk penderita hipertensi. Saat ini tekanan darah saya cukup tinggi dan ingin tetap aktif berolahraga.',
                    'status' => 'pending'
                ]);
            }
        }
    }
}
