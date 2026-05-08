<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::firstOrCreate(
            ['name' => 'ALiNE GLOBAL'],
            [
                'legal_name' => 'ALiNE GLOBAL Limited',
                'website' => 'https://www.alineglobalbd.com',
                'main_email' => 'info@alineglobalbd.com',
                'phone' => '+88 01870764354',
                'tagline' => 'Digital Solutions for Global Business',
                'about' => 'ALiNE GLOBAL is a leading digital solutions company providing cutting-edge technology and marketing services worldwide.',
                'bangladesh_office_address' => 'Borak Mehnur, 51/B, Kemal Ataturk Avenue, Banani, Dhaka-1213, Bangladesh',
                'uk_office_address' => '167-169 Great Portland Street, 5th Floor, London W1W 5PF, United Kingdom',
                'facebook_url' => 'https://www.facebook.com/alineglobalbd',
                'linkedin_url' => 'https://www.linkedin.com/company/aline-global',
                'instagram_url' => 'https://www.instagram.com/alineglobalbd',
                'youtube_url' => 'https://www.youtube.com/@alineglobal',
                'is_active' => true,
            ]
        );
    }
}
