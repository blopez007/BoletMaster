<?php

namespace Database\Seeders;

use App\Models\{Category, Entry, Event};
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $evento     = Event::factory()->create();
            $categories = Category::all()->random(3);
            $evento->categorias()->attach($categories);
            Entry::factory(3)->create(['event_id' => $evento->id]);
        }
    }
}
