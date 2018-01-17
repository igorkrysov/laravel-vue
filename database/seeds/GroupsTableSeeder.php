<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('groups')->insert(
          [
           'group' => "administrator"
          ]
        );
        DB::table('groups')->insert(
          [
           'group' => "moderator"
          ]
        );

    }
}
