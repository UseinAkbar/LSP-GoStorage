<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\models\User;
use App\models\Gudang;
use App\models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama'=> 'Admin',
            'email'=>'admin@admin.com',
            'noTelp'=>'08123456789',
            'instansi'=>'',
            'password' => Hash::make('admin123'),
            'isAdmin' => '1',
         ]);

         User::create([
            'nama'=> 'Bagus',
            'email'=>'bagus@gmail.com',
            'noTelp'=>'08123456234',
            'instansi'=>'swasta',
            'password' => Hash::make('tes123'),
            'isAdmin' => '0',
         ]);

         Kategori::create([
            'nama'=>'Bahan Baku',
        ]);

        Gudang::create([
            'nama_gudang' => 'Gudang Sunter',
            'kode_gudang' => 'GS-012',
            'lokasi' => 'Jakarta Utara',
            'deskripsi' => 'Ruangan ini adalah tempat penyimpanan bahan baku atau bahan mentah sebelum dipergunakan untuk proses produksi oleh perusahaan yang bersangkutan. Biasanya, warehouse bahan baku terletak dekat dengan pusat pengolahan produksi.',
            'harga' => '100000000',
            'luas' => '2500m2',
            'status' => 'available'
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
