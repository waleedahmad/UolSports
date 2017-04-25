<?php

use App\Sports;
use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sports = [
            'Cricket',
            'Football',
            'Hockey',
            'Rugby',
            'Volleyball'
        ];

        foreach($sports as $sport){
            $s = new Sports();
            $s->name = $sport;
            $s->enabled = true;
            $s->save();
        }
    }
}
