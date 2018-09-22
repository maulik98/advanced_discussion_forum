<?php

use Illuminate\Database\Seeder;
use App\Channel;


class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'laravel'];
        $channel2 = ['title' => 'vuejs' ];
        $channel3 = ['title' => 'html'];
        $channel4 = ['title' => 'css3'];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
    }
}
