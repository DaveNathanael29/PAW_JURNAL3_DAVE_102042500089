<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pengguna LMS (1 Dosen & 1 Mahasiswa)

        // >>> TODO 1
        $dosen = User::updateOrCreate(
            ['email' => 'dosen@celoe.test'],
            [
                'name' => 'ILHAM RONI YANSYAH',
                'password' => Hash::make('admin'),
                'role' => 'dosen',
                'nomor_induk' => '2345678901',
            ]
        );
        // <<< TODO 1

        // Tambahan saya (bukan TODO): akun mahasiswa
        User::updateOrCreate(
            ['email' => 'mahasiswa@celoe.test'],
            [
                'name' => 'Dave Nathanael',
                'password' => Hash::make('admin'),
                'role' => 'mahasiswa',
                'nomor_induk' => '1234567890',
            ]
        );

        // Tambahan saya (bukan TODO): data awal mata kuliah dan tugas
        $course = MataKuliah::updateOrCreate(
            ['kode_mk' => 'PAW'],
            [
                'nama_mk' => 'Pengembangan Aplikasi Website',
                'deskripsi' => 'Mempelajari pengembangan aplikasi web dinamis menggunakan framework Laravel.',
                'sks' => 2,
                'semester' => 'Ganjil 2026/2027',
                'dosen_id' => $dosen->id,
            ]
        );

        Assignment::updateOrCreate(
            ['course_id' => $course->id, 'judul' => 'Tugas 01 - Bikin Sistem Kasir pake Laravel'],
            [
                'deskripsi' => 'Buatlah sistem kasir sederhana menggunakan Laravel dengan fitur CRUD barang dan transaksi.',
                'deadline' => now()->addDays(7),
            ]
        );
    }
}