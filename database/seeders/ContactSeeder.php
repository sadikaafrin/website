<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            'id' => 1,
            'email' => 'contact@example.com',
            'phone' => '123-456-7890',
            'address' => 'Dhaka',
            'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14609.692175812828!2d90.4300882!3d23.7322891!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b84739a83751%3A0x618730d695dcce07!2sMugda%20Medical%20College%20and%20Hospital!5e0!3m2!1sen!2sbd!4v1713461868594!5m2!1sen!2sbd" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'facebook' => 'https://www.facebook.com/interactivecares',
            'instagram' => 'https://www.instagram.com/interactive_cares/',
            'linkedin' => 'dffdssdf',
            'twitter' => 'kdkdf',
            'youtube' => 'https://www.youtube.com/watch?v=WbeGacEU93w',
        ]);

    }
}
