<?php

use App\Role;
use App\Permission;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, starting from blank database');
        }

        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Default permissions added');

        if ($this->command->confirm('Create roles for user, default is admin and user? [y|N]', true)) {
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'admin,user');

            $roles_array = explode(',', $input_roles);

            foreach ($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'admin') {
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                $this->createUser($role);
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully.');
        } else {
            Role::firstOrCreate(['name' => 'user']);
            $this->command->inf('Added only default user role.');
        }
    }

    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'admin') {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "password"');
        }
    }
}
