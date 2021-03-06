<?php

use Illuminate\Database\Seeder;
use App\Model\Package\Content;
use App\Model\Package\Theme;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(PlanSeed::class);
    }
}
