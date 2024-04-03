<?php

namespace Database\Seeders;

use App\Models\FrontendSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontendSections extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = json_encode(
            [
                'mainBanner' => 'active',
                'flashSale' => 'active',
                'popularCategory' => 'active',
                'doubleBanner' => 'active',
                'singleCategorySliderOne' => 'active',
                'singleCategorySliderTwo' => 'active',
                'singleCategorySliderThree' => 'active',
                'brandSlider' => 'active',

            ]
        );
        FrontendSection::insert([
            'value' => $sections,

        ]);
    }
}
