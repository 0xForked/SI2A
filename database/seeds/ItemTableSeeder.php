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
                'name' => 'narkotika',
                'description' => 'Narkoba adalah singkatan dari narkotika dan obat/bahan berbahaya. Selain "narkoba", istilah lain yang diperkenalkan khususnya oleh Kementerian Kesehatan Republik Indonesia adalah Napza yang merupakan singkatan dari narkotika, psikotropika, dan zat adiktif.'
            ],
            [
                'name' => 'psikotropika',
                'description' => 'Psikotropika adalah suatu zat atau obat alamiah maupun sintetis bukan narkotika, yang berkhasiat psikoaktif melalui pengaruh selektif pada susunan saraf pusat yang menyebabkan perubahan khas pada aktivitas mental dan perilaku.'
            ]
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }

    private function subcategories()
    {
        $data = [
            [
                'name' => 'fentanil',
                'description' => 'fentanil adalah opioid yang digunakan sebagai analgesik atau jika bersamaan dengan obat lain berfungsi sebagai obat bius.',
                'category_id' => 1
            ],
            [
                'name' => 'flakka',
                'description' => 'Flakka, atau nama ilmiahnya α-Pyrrolidinopentiophenone (dikenal juga dengan nama α-pyrrolidinovalerophenone, α-PVP, O-2387, β-keto-prolintane, prolintanone, atau desmethylpyrovalerone) adalah stimulan sintetis dari jenis katinon yang dikembangkan tahun 1960-an, dan dijual sebagai obat desainer.',
                'category_id' => 1
            ],
            [
                'name' => 'halusinogen',
                'description' => 'halusinogen adalah jenis narkoba yang dapat menimbulkan efek halusinasi yang bersifat mengubah perasaan, pikiran dan seringkali menciptakan daya pandang yang berbeda sehingga seluruh perasaan dapat terganggu.',
                'category_id' => 1
            ],
            [
                'name' => 'heroin',
                'description' => 'heroin atau diamorfin (INN) adalah sejenis opioid alkaloid. ',
                'category_id' => 1
            ],
            [
                'name' => 'katinona',
                'description' => 'Katinona, atau benzoyletanamina atau bisa juga disebut Neropedron. ',
                'category_id' => 1
            ],
            [
                'name' => 'krokodil',
                'description' => 'Krokodil atau nama ilmiahnya Desomorphine adalah narkotika jenis opioid sintetis yang dahulunya dibuat oleh Roche.',
                'category_id' => 1
            ],
            [
                'name' => 'metamfetamina',
                'description' => 'Metamfetamina, disingkat met, dan dikenal di Indonesia sebagai sabu-sabu, adalah obat psikostimulansia dan simpatomimetik.',
                'category_id' => 1
            ],
            [
                'name' => 'opium',
                'description' => 'Opium, apiun, atau candu adalah getah bahan baku narkotika yang diperoleh dari buah candu yang belum matang.',
                'category_id' => 1
            ],
            [
                'name' => 'rohypnol',
                'description' => 'Rohypnol atau nama lainnya Flunitrazepam adalah obat jenis benzodiazepin untuk mengobati keluhan tidur dan dalam frekuensi yang jarang sebagai obat bius. ',
                'category_id' => 1
            ],
            [
                'name' => 'afrodisiak',
                'description' => 'Afrodisiak adalah zat yang mampu meningkatkan gairah seksual. ',
                'category_id' => 2
            ],
            [
                'name' => 'Metilendioksimetamfetamina',
                'description' => 'MDMA (3,4-metilendioksi-metamfetamina), biasanya dikenal dengan nama Ekstasi, E, X, atau XTC adalah senyawa kimia yang sering digunakan sebagai obat rekreasi yang membuat penggunanya menjadi sangat aktif.',
                'category_id' => 2
            ],
            [
                'name' => 'Tetrahidrokanabinol',
                'description' => 'Tetrahidrokanabinol adalah psikotropika yang merupakan senyawa utama dari ganja. Zat ini hanya dihasilkan tanaman Kanabis.',
                'category_id' => 2
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
            ]
        ];

        foreach($data as $unit) {
            Unit::create($unit);
        }
    }
}
