<?php

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
        // $this->call(UsersTableSeeder::class);

		$this->call('UsersTableSeeder');
        $this->call('UsersHRDTableSeeder');
        $this->call('UsersCheckpointTableSeeder');
        $this->call('UsersCostControlTableSeeder');

        $this->call('AppsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('AppUserTableSeeder');
        $this->call('RoleUserTableSeeder');
        
        $this->call('ProjectsTableSeeder');
        $this->call('ContractsTableSeeder');
        $this->call('RefftypesTableSeeder');
        $this->call('SheetgroupsTableSeeder');
        $this->call('UomsTableSeeder');
        $this->call('VendortypesTableSeeder');
        $this->call('VendorsTableSeeder');



        
        // $this->call('UsersTableSeeder');
        // $this->call('AppsTableSeeder');
        // $this->call('AppUserTableSeeder');
        // $this->call('RolesTableSeeder');
        // $this->call('RoleUserTableSeeder');

        //$this->call('AttendsTableSeeder');
    }
}
