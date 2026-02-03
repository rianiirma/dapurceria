<?php
namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Resep;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Admin
        $admin = User::create([
            'name'     => 'Admin Dapur Ceria',
            'email'    => 'admin@dapurceria.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Buat User Biasa
        $user1 = User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        $user2 = User::create([
            'name'     => 'Siti Aminah',
            'email'    => 'siti@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // Buat Kategori
        $kategoris = [
            ['nama_kategori' => 'Masakan Indonesia', 'deskripsi' => 'Resep masakan tradisional Indonesia'],
            ['nama_kategori' => 'Masakan Barat', 'deskripsi' => 'Resep masakan western'],
            ['nama_kategori' => 'Dessert', 'deskripsi' => 'Resep kue dan makanan manis'],
            ['nama_kategori' => 'Minuman', 'deskripsi' => 'Resep minuman segar'],
            ['nama_kategori' => 'Masakan Cepat Saji', 'deskripsi' => 'Resep praktis dan cepat'],
        ];

        foreach ($kategoris as $kat) {
            Kategori::create($kat);
        }

        // Buat Resep Sample
        $reseps = [
            [
                'id_user'           => $user1->id,
                'id_kategori'       => 1,
                'judul'             => 'Nasi Goreng Spesial',
                'deskripsi'         => 'Nasi goreng dengan bumbu rempah pilihan dan topping telur mata sapi',
                'bahan'             => "- 2 piring nasi putih\n- 2 butir telur\n- 3 siung bawang putih\n- 5 siung bawang merah\n- 2 sdm kecap manis\n- 1 sdt garam\n- 1/2 sdt merica\n- Minyak goreng secukupnya",
                'langkah_langkah'   => "1. Haluskan bawang putih dan bawang merah\n2. Tumis bumbu halus hingga harum\n3. Masukkan telur, orak-arik\n4. Masukkan nasi, aduk rata\n5. Tambahkan kecap, garam, dan merica\n6. Masak hingga matang dan bumbu meresap\n7. Sajikan dengan telur mata sapi dan kerupuk",
                'waktu_memasak'     => 20,
                'porsi'             => 2,
                'tingkat_kesulitan' => 'mudah',
            ],
            [
                'id_user'           => $user2->id,
                'id_kategori'       => 1,
                'judul'             => 'Rendang Daging Sapi',
                'deskripsi'         => 'Rendang daging sapi khas Padang dengan bumbu rempah lengkap',
                'bahan'             => "- 500 gram daging sapi\n- 500 ml santan kental\n- 5 lembar daun jeruk\n- 3 batang serai\n- 2 cm lengkuas\n- Bumbu halus: bawang merah, bawang putih, cabai merah, jahe, kunyit",
                'langkah_langkah'   => "1. Haluskan semua bumbu\n2. Tumis bumbu halus dengan serai, daun jeruk, dan lengkuas\n3. Masukkan daging, aduk rata\n4. Tuang santan, masak dengan api kecil\n5. Masak hingga santan menyusut dan bumbu meresap (sekitar 3 jam)\n6. Aduk sesekali agar tidak gosong\n7. Sajikan dengan nasi putih hangat",
                'waktu_memasak'     => 180,
                'porsi'             => 5,
                'tingkat_kesulitan' => 'sulit',
            ],
            [
                'id_user'           => $user1->id,
                'id_kategori'       => 2,
                'judul'             => 'Spaghetti Carbonara',
                'deskripsi'         => 'Pasta Italia dengan saus krim lembut dan bacon crispy',
                'bahan'             => "- 200 gram spaghetti\n- 100 gram bacon\n- 2 butir telur\n- 100 ml cooking cream\n- 50 gram keju parmesan\n- 2 siung bawang putih\n- Garam dan merica",
                'langkah_langkah'   => "1. Rebus spaghetti hingga al dente\n2. Tumis bawang putih dan bacon hingga crispy\n3. Kocok telur dengan cooking cream dan keju parmesan\n4. Masukkan spaghetti ke dalam tumisan bacon\n5. Matikan api, tuang campuran telur, aduk cepat\n6. Beri garam dan merica sesuai selera\n7. Sajikan selagi hangat dengan taburan keju",
                'waktu_memasak'     => 25,
                'porsi'             => 2,
                'tingkat_kesulitan' => 'sedang',
            ],
            [
                'id_user'           => $user2->id,
                'id_kategori'       => 3,
                'judul'             => 'Brownies Coklat Fudgy',
                'deskripsi'         => 'Brownies coklat dengan tekstur fudgy dan topping kacang almond',
                'bahan'             => "- 200 gram dark chocolate\n- 150 gram butter\n- 200 gram gula pasir\n- 3 butir telur\n- 100 gram tepung terigu\n- 50 gram cocoa powder\n- 100 gram kacang almond",
                'langkah_langkah'   => "1. Tim dark chocolate dan butter hingga meleleh\n2. Kocok telur dan gula hingga mengembang\n3. Campurkan lelehan coklat ke dalam kocokan telur\n4. Ayak tepung dan cocoa powder, aduk rata\n5. Tuang adonan ke loyang yang sudah diolesi margarin\n6. Taburi kacang almond di atas\n7. Panggang 180°C selama 30 menit\n8. Dinginkan sebelum dipotong",
                'waktu_memasak'     => 45,
                'porsi'             => 8,
                'tingkat_kesulitan' => 'sedang',
            ],
            [
                'id_user'           => $admin->id,
                'id_kategori'       => 4,
                'judul'             => 'Es Teh Manis Segar',
                'deskripsi'         => 'Minuman teh manis dingin yang menyegarkan',
                'bahan'             => "- 2 kantong teh celup\n- 3 sdm gula pasir\n- 500 ml air panas\n- Es batu secukupnya",
                'langkah_langkah'   => "1. Seduh teh celup dengan air panas\n2. Tambahkan gula pasir, aduk rata\n3. Biarkan dingin\n4. Masukkan es batu\n5. Sajikan dingin",
                'waktu_memasak'     => 10,
                'porsi'             => 2,
                'tingkat_kesulitan' => 'mudah',
            ],
        ];

        foreach ($reseps as $resep) {
            Resep::create($resep);
        }
    }
}
