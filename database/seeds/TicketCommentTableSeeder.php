<?php

use TeachMe\Entities\TicktComment;
use Faker\Factory as Faker;
use Faker\Generator;

class TicketCommentTableSeeder extends BaseSeeder
{
	public function getModel()
    {
        return new TicktComment();
    }

    public function getDummyData(Generator $faker, array $custonValue = array())
    {
        return [
        		'comment'   => $faker->paragraph(),  
        		'link'      => $faker->randomElement(['', '', $faker->url]),  
                'ticket_id' => $this->getRandor('Ticket')->id,
                'user_id'   => $this->getRandor('User')->id 
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
