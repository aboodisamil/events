<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function a_user_can_create_an_event()
    {
        $event = [
          'name' => 'First Event',
          'desc' => 'Event Desc',
            'order' => 1
        ];
        $this->post('api/events', $event)
            ->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'desc',
                'order',
                'created_at'
            ]);

        $event = Event::find(1);

        $this->assertEquals('First Event', $event->name);
        $this->assertEquals('Event Desc', $event->desc);
        $this->assertEquals(1, $event->order);
    }

    /** @test **/
    public function a_user_can_delete_an_event()
    {
        $this->withoutExceptionHandling();
        $event = factory(Event::class)->create();

        $this->assertDatabaseHas('events', ['id' => 1]);
        
        $this->delete("api/events/$event->id")
            ->assertStatus(200);

        $this->assertDatabaseMissing('events', ['id' => 1]);

    }
}
