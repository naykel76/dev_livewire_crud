<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\Project::create([
            'title' => 'Iron Bridge Magnetite Project - Raw Water Pipeline',
            'description' => '<div>The portion of the Iron Bridge project is for the development of Raw Water pipeline infrastructure which is located in the Canning Basin, South of Pardoo Roadhouse and heads South-West towards Iron Bridge mine in the Pilbara region of Western Australia.<br><br></div><div>The overall scope of the project includes the civil enabling works required to be completed at the Iron Bridge Magnetite Project for the raw water pipeline and supporting infrastructure, including:<br><br></div><ul><li>Clearing and Grubbing, Topsoil Stripping and Foundation Treatment</li><li>Drill and Blast, including blasting the trench alignment</li><li>Cut to Fill operations levelling the Construction Right of Way (CROW)</li><li>Trimming batters</li><li>Trimming subgrade</li></ul>',
            'status' => 'published',
            'image_name' => '',
            'published_at' => now(),
            'project_value' => '12000000',

        ]);

        \App\Models\Project::factory(50)->create();
    }
}
