<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Article;

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

        // Pasien 3
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@meditalk.com',
            'password' => Hash::make('ahmad123'),
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
Konsumsi makanan yang kaya serat, rendah lemak jenuh, dan tinggi omega-3. Perbanyak sayuran, buah-buahan, dan ikan.

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
Konsumsi garam berlebihan dapat meningkatkan tekanan darah.

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
- Konsumsi makanan kaya kalsium (susu, keju, yogurt)
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
- Konsumsi 6-11 porsi per hari

2. Protein
- Daging, ikan, telur, kacang-kacangan
- Penting untuk pertumbuhan otot dan sel
- Konsumsi 2-3 porsi per hari

3. Sayuran dan Buah
- Kaya vitamin, mineral, dan serat
- Konsumsi 5 porsi per hari
- Variasikan warna untuk nutrisi lengkap

4. Susu dan Produk Olahan
- Kaya kalsium untuk pertumbuhan tulang
- Konsumsi 2-3 gelas per hari

5. Lemak Sehat
- Minyak zaitun, alpukat, kacang-kacangan
- Penting untuk perkembangan otak
- Konsumsi secukupnya

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

        Article::create([
            'judul' => 'Pencegahan Penyakit Musim Hujan yang Efektif',
            'isi' => 'Musim hujan sering membawa berbagai penyakit. Berikut adalah cara efektif mencegah penyakit musim hujan:

PENYAKIT YANG SERING MUNCUL SAAT HUJAN

1. Flu dan Pilek
- Virus mudah menyebar saat udara lembab
- Gejala: demam, batuk, pilek, sakit tenggorokan

2. Demam Berdarah
- Nyamuk Aedes aegypti berkembang biak di genangan air
- Gejala: demam tinggi, sakit kepala, nyeri otot

3. Diare
- Kontaminasi air dan makanan
- Gejala: BAB cair, mual, muntah

4. Leptospirosis
- Bakteri dari air kencing tikus
- Gejala: demam, sakit kepala, nyeri otot

CARA PENCEGAHAN

1. Jaga Kebersihan Lingkungan
- Bersihkan genangan air
- Tutup tempat penampungan air
- Buang sampah dengan benar

2. Jaga Kebersihan Diri
- Cuci tangan dengan sabun
- Mandi setelah kehujanan
- Gunakan pakaian kering

3. Konsumsi Makanan Sehat
- Makan makanan bergizi
- Konsumsi vitamin C
- Minum air yang bersih

4. Gunakan Pelindung
- Payung atau jas hujan
- Sepatu anti air
- Pakaian hangat

5. Vaksinasi
- Vaksin flu tahunan
- Vaksin sesuai jadwal

Jika mengalami gejala penyakit, segera konsultasi ke dokter.',
            'doctor_id' => $dokter1->id,
        ]);

        Article::create([
            'judul' => 'Manfaat Olahraga untuk Kesehatan Mental',
            'isi' => 'Olahraga tidak hanya baik untuk kesehatan fisik, tetapi juga kesehatan mental. Berikut adalah manfaat olahraga untuk mental:

MANFAAT OLAHRAGA UNTUK MENTAL

1. Mengurangi Stres
- Olahraga melepaskan endorfin (hormon bahagia)
- Mengurangi hormon stres (kortisol)
- Memberikan waktu untuk relaksasi

2. Meningkatkan Mood
- Olahraga teratur dapat mengatasi depresi ringan
- Meningkatkan kepercayaan diri
- Memberikan perasaan puas

3. Meningkatkan Kualitas Tidur
- Olahraga membantu tidur lebih nyenyak
- Mengatur siklus tidur-bangun
- Mengurangi insomnia

4. Meningkatkan Fungsi Otak
- Meningkatkan aliran darah ke otak
- Meningkatkan daya ingat
- Meningkatkan konsentrasi

5. Mengurangi Kecemasan
- Olahraga sebagai terapi alami
- Mengalihkan pikiran dari masalah
- Meningkatkan ketenangan

JENIS OLAHRAGA YANG BAIK UNTUK MENTAL

1. Jalan Kaki
- Olahraga ringan dan mudah dilakukan
- Dapat dilakukan di mana saja
- Baik untuk pemula

2. Yoga
- Menggabungkan gerakan dan pernapasan
- Meningkatkan fleksibilitas
- Menenangkan pikiran

3. Berenang
- Olahraga low impact
- Baik untuk semua usia
- Menenangkan dan menyegarkan

4. Bersepeda
- Olahraga kardio yang menyenangkan
- Dapat dilakukan outdoor atau indoor
- Meningkatkan stamina

TIPS OLAHRAGA UNTUK MENTAL

1. Mulai dengan olahraga ringan
2. Lakukan secara teratur (3-5 kali seminggu)
3. Pilih olahraga yang disukai
4. Lakukan bersama teman atau keluarga
5. Tetapkan target yang realistis

Dengan olahraga teratur, Anda dapat menjaga kesehatan mental dan fisik secara optimal.',
            'doctor_id' => $dokter1->id,
        ]);

        Article::create([
            'judul' => 'Pentingnya Vaksinasi untuk Anak dan Dewasa',
            'isi' => 'Vaksinasi adalah cara terbaik untuk melindungi diri dan keluarga dari berbagai penyakit berbahaya. Berikut adalah informasi lengkap tentang vaksinasi:

MANFAAT VAKSINASI

1. Mencegah Penyakit
- Vaksin merangsang sistem kekebalan tubuh
- Membentuk antibodi terhadap penyakit
- Mencegah infeksi dan komplikasi

2. Melindungi Keluarga
- Vaksinasi mencegah penularan penyakit
- Melindungi anggota keluarga yang rentan
- Menciptakan kekebalan kelompok

3. Menghemat Biaya
- Mencegah biaya pengobatan mahal
- Mengurangi waktu sakit
- Mencegah kecacatan permanen

JADWAL VAKSINASI ANAK

0-2 Bulan:
- Hepatitis B
- BCG (Tuberkulosis)
- DPT (Difteri, Pertusis, Tetanus)

2-4 Bulan:
- Polio
- Hib (Haemophilus influenzae)
- Rotavirus

6-12 Bulan:
- Campak
- Hepatitis A
- Varisela (Cacar Air)

12-18 Bulan:
- MMR (Campak, Gondong, Rubella)
- DPT Booster

VAKSINASI DEWASA

1. Vaksin Flu (Tahunan)
- Mencegah influenza
- Penting untuk lansia dan penderita kronis

2. Vaksin Hepatitis B
- Mencegah penyakit hati
- Penting untuk petugas kesehatan

3. Vaksin Tetanus
- Booster setiap 10 tahun
- Mencegah tetanus

4. Vaksin Pneumonia
- Mencegah pneumonia
- Penting untuk lansia

EFEK SAMPING VAKSIN

Efek samping ringan yang normal:
- Demam ringan
- Nyeri di tempat suntikan
- Kemerahan dan bengkak

Efek samping serius sangat jarang terjadi.

KAPAN HARUS MENUNDA VAKSINASI

1. Sedang demam tinggi
2. Alergi terhadap komponen vaksin
3. Sistem kekebalan tubuh lemah
4. Hamil (untuk vaksin tertentu)

Konsultasi dengan dokter sebelum vaksinasi untuk memastikan keamanan.',
            'doctor_id' => $dokter3->id,
        ]);

        Article::create([
            'judul' => 'Cara Merawat Kulit yang Benar Sesuai Jenis Kulit',
            'isi' => 'Merawat kulit dengan benar sangat penting untuk menjaga kesehatan dan kecantikan kulit. Berikut adalah panduan lengkap perawatan kulit:

JENIS-JENIS KULIT

1. Kulit Normal
- Seimbang, tidak terlalu berminyak atau kering
- Pori-pori halus
- Tekstur halus dan kenyal

2. Kulit Kering
- Terasa kencang dan kasar
- Mudah mengelupas
- Garis halus lebih terlihat

3. Kulit Berminyak
- Berkilau dan licin
- Pori-pori besar
- Mudah berjerawat

4. Kulit Sensitif
- Mudah iritasi dan kemerahan
- Reaktif terhadap produk
- Terasa gatal atau terbakar

5. Kulit Kombinasi
- Berminyak di area T (dahi, hidung, dagu)
- Kering di area pipi

RUTIN PERAWATAN KULIT

PAGI:
1. Cuci muka dengan pembersih lembut
2. Gunakan toner (opsional)
3. Oleskan serum vitamin C
4. Gunakan pelembap dengan SPF
5. Oleskan tabir surya

MALAM:
1. Bersihkan makeup dengan micellar water
2. Cuci muka dengan pembersih
3. Gunakan toner
4. Oleskan serum retinol
5. Gunakan pelembap

TIPS PERAWATAN KULIT

1. Kenali Jenis Kulit
- Konsultasi dengan dermatologis
- Pilih produk sesuai jenis kulit
- Perhatikan reaksi kulit

2. Gunakan Tabir Surya
- SPF minimal 30
- Oleskan setiap 2 jam
- Lindungi dari UVA dan UVB

3. Jaga Kebersihan
- Cuci tangan sebelum menyentuh wajah
- Bersihkan makeup sebelum tidur
- Ganti sarung bantal secara rutin

4. Konsumsi Makanan Sehat
- Makanan kaya antioksidan
- Minum air putih cukup
- Hindari makanan berminyak

5. Kelola Stres
- Stres dapat mempengaruhi kulit
- Lakukan relaksasi
- Tidur cukup

MASALAH KULIT UMUM

1. Jerawat
- Bersihkan wajah secara teratur
- Hindari menyentuh wajah
- Konsultasi dengan dermatologis

2. Flek Hitam
- Gunakan produk pencerah
- Lindungi dari sinar matahari
- Konsultasi untuk perawatan khusus

3. Keriput
- Gunakan produk anti-aging
- Lindungi dari sinar matahari
- Jaga kelembapan kulit

4. Kulit Kering
- Gunakan pelembap intensif
- Hindari air panas
- Gunakan humidifier

Konsultasi dengan dermatologis untuk perawatan yang tepat sesuai kondisi kulit Anda.',
            'doctor_id' => $dokter5->id,
        ]);
    }
}