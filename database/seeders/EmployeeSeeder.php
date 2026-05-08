<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('name', 'ALiNE GLOBAL')->first();

        if ($company) {
            Employee::firstOrCreate(
                ['email' => 'bijit@alineglobalbd.com'],
                [
                    'company_id' => $company->id,
                    'full_name' => 'Bijit Das',
                    'slug' => 'bijit-das',
                    'designation' => 'Brand Acquisition Manager',
                    'phone' => '+8801870764354',
                    'whatsapp' => '+8801870764354',
                    'status' => 'active',
                    'public_profile_enabled' => true,
                    'show_phone' => true,
                    'show_whatsapp' => true,
                    'show_email' => true,
                    'show_photo' => true,
                    'show_company_address' => true,
                ]
            );
        }
    }
}
