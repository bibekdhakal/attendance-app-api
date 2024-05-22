<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'name' => 'CDU',
                'domain' => 'cdu.ac.za',
                'database' => 'cdu', // Assuming database names match tenant names
            ],
            [
                'name' => 'WSU',
                'domain' => 'ws.ac.za',
                'database' => 'wsu', // Assuming database names match tenant names
            ],
        ];

        foreach ($tenants as $tenantData) {
            Tenant::create($tenantData);
        }
    }
}
