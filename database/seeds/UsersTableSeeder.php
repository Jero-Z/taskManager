<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 3)->create()->each(function ($u) {

            /** @var \App\User $u */

            $u->projects()->createMany(factory(\App\Project::class, 10)->make([
                'user_id' => $u->id
            ])->toArray())->each(function ($p) {
                $p->tasks()->createMany(factory(\App\Task::class, 10)->make([
                    'project_id' => $p->id
                ])->toArray());
            });

        });
    }
}
