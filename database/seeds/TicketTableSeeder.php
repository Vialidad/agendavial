<?php

use TeachMe\Entities\Ticket;
use Faker\Factory as Faker;
use Faker\Generator;

class TicketTableSeeder extends BaseSeeder
{	
	public function getModel()
    {
        return new Ticket();
    }

    public function getDummyData(Generator $faker, array $custonValue = array())
    {
        return [ 
                'title'   => $faker->sentence(),
                'date'   => $faker->date(),
                'status'  => $faker->randomElement(['open', 'open', 'closed']),
                'user_id' => $this->getRandor('User')->id //$this->createFrom('UsersTableSeeder',$custonValue)->id
            ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMultiple(50);
    }

}
