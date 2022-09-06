<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //Permissions
        $permissions = [
            'Invoices',
            'Invoices List',
            'Paid Invoices',
            'Partially Paid Invoices',
            'Unpaid Invoices',
            'Invoices Archive',

            'Reports',
            'Invoices Report',
            'Customers Report',

            'Users',
            'Users List',
            'Users Privileges',

            'Settings',

            'Products',
            
            'Sections',

            'Add Invoice',
            'Delete Invoice',
            'Export Invoice',
            'Change Payment Status',
            'Edit Invoice',
            'Add Attachment',
            'Delete Attachment',


            'Add User',
            'Edit User',
            'Delete User',


            'Show Privilege',
            'Add Privilege',
            'Edit Privilege',
            'Delete Privilege',

            'Add Product',
            'Edit Product',
            'Delete Product',

            'Add Section',
            'Edit Section',
            'Delete Section'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
