<?php

use App\Models\Data\Category;
use App\Models\Data\Subcategory;
use App\Models\Data\Unit;
use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->categories();
        $this->subcategories();
        $this->units();
    }

    private function categories()
    {
        $data = [
            [
                'name' => 'alkes',
                'description' => 'alat kesehatan'
            ],
            [
                'name' => 'obat',
                'description' => 'obat-obatan'
            ],
            [
                'name' => 'BMHP',
                'description' => 'bahan medis habis pakai'
            ]
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }

    private function subcategories()
    {
        // http://regalkes.depkes.go.id/informasi_alkes/Pedoman%20Klasifikasi.pdf
        $data = [
            [
                'name' => 'alat kesehatan aktif',
                'description' => 'Alat kesehatan yang dioperasikan menggunakan sumber energi listrik
                atau sumber energi lainnya selain yang dihasilkan langsung oleh tubuh
                manusia atau gravitasi; yang bekerja dengan mengubah energi tersebut. - Depkes [Pedoman Klasifikasi Hal 4 No 2.1.3]',
                'category_id' => 1
            ],
            [
                'name' => 'alat kesehatan aktif terapetik',
                'description' => 'alat kesehatan aktif, yang digunakan sendiri atau digabungkan dengan
                alat kesehatan lain, untuk mendukung, mengubah, menggantikan atau
                memperbaiki fungsi atau struktur biologi untuk pengobatan atau
                mengurangi penyakit, cedera, atau cacat',
                'category_id' => 1
            ],
            [
                'name' => 'herbal',
                'description' => 'Obat herbal atau alami',
                'category_id' => 2
            ],
            [
                'name' => 'farma',
                'description' => 'Obat berbahan kimia',
                'category_id' => 2
            ],
            [
                'name' => 'selang',
                'description' => 'alat-alat yang berhubungan dengan selang',
                'category_id' => 3
            ],
            [
                'name' => 'suntik',
                'description' => 'alat-alat yang berhubungan dengan suntik',
                'category_id' => 3
            ],
        ];

        foreach ($data as $subcategory) {
            Subcategory::create($subcategory);
        }
    }

    private function units()
    {
        $data = [
            [
                'name' => 'pcs',
                'description' => 'pieces'
            ],
            [
                'name' => 'btl',
                'description' => 'botol'
            ],
        ];

        foreach($data as $unit) {
            Unit::create($unit);
        }
    }
}
