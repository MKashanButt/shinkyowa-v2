<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Overall Permissions
        $permission = Permission::create([
            'name' => 'add_customer',
        ]);

        $permission->role()->attach([1, 2, 3]);

        $permission = Permission::create([
            'name' => 'add_payment',
        ]);

        $permission->role()->attach([1, 2, 3]);

        $permission = Permission::create([
            'name' => 'view_shipment',
        ]);

        $permission->role()->attach([1, 2, 3]);

        $permission = Permission::create([
            'name' => 'view_documents',
        ]);

        $permission->role()->attach([1, 2, 3]);

        $permission = Permission::create([
            'name' => 'view_inquiries',
        ]);

        $permission->role()->attach([1, 2, 3]);

        $permission = Permission::create([
            'name' => 'view_settings',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_edit_customer',
        ]);

        $permission->role()->attach([1, 2, 3]);

        // Agent Only Permission
        $permission = Permission::create([
            'name' => 'view_own_payments',
        ]);

        $permission->role()->attach([3]);

        $permission = Permission::create([
            'name' => 'view_own_customers',
        ]);

        $permission->role()->attach([3]);

        $permission = Permission::create([
            'name' => 'view_own_reserved_vehicles',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'view_own_shipments',
        ]);

        $permission->role()->attach([1]);


        // Admin & Manager Only Permissions
        $permission = Permission::create([
            'name' => 'edit_reserve_vehicle',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'add_shipment',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_edit_shipment',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_delete_shipment',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_edit_document',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_delete_document',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'add_stock',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_see_agent_name',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_delete_customer',
        ]);

        $permission->role()->attach([1, 2]);

        $permission = Permission::create([
            'name' => 'can_edit_payment',
        ]);

        $permission->role()->attach([1, 2]);

        // Manager Only Permissions
        $permission = Permission::create([
            'name' => 'view_team_members',
        ]);

        $permission->role()->attach([2]);

        $permission = Permission::create([
            'name' => 'view_team_reserved_vehicles',
        ]);

        $permission->role()->attach([2]);

        $permission = Permission::create([
            'name' => 'view_team_customers',
        ]);

        $permission->role()->attach([2]);

        $permission = Permission::create([
            'name' => 'view_team_shipments',
        ]);

        $permission->role()->attach([2]);

        // Admin Only Permissions
        $permission = Permission::create([
            'name' => 'delete_reserve_vehicle',
        ]);

        $permission = Permission::create([
            'name' => 'view_notifications',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'view_permissions',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'can_delete_stock',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'can_edit_stock',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'add_payment_recieved_date',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'can_delete_payment',
        ]);

        $permission->role()->attach([1]);

        $permission = Permission::create([
            'name' => 'add_document',
        ]);

        $permission->role()->attach([1]);
    }
}
