<?php

use Illuminate\Database\Seeder;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Waleed Ahmad';
        $user->email = 'waleedgplus@gmail.com';
        $user->password = bcrypt("binarystar");
        $user->type = 'admin';
        $user->verified = 1;
        $user->gender = 'male';
        $user->image_uri = 'default/img/default_img_male.jpg';
        $user->registration_id = '';
        $user->card_uri = '';

        if($user->save()){
            echo "\nAdmin user : ".$user->email." seeded\n";
        }

        $user = new \App\User();
        $user->name = 'Taimoor Qamar';
        $user->email = 'taimoor@gmail.com';
        $user->password = bcrypt("binarystar");
        $user->type = 'user';
        $user->verified = 1;
        $user->gender = 'male';
        $user->image_uri = 'default/img/default_img_male.jpg';
        $user->registration_id = '';
        $user->card_uri = '';

        if($user->save()){
            echo "\nAdmin user : ".$user->email." seeded\n";
        }

    }
}
