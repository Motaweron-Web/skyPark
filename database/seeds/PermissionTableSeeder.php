<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Add Client',
            'Edit Ticket',
            'Family Sale',
            'Family Access',
            'Reservation',
            'Capacity',
            'Group Access',
            'Group Sale',
            'Corporations',
            'Exit',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
