<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
  use DatabaseMigrations;
   /** @test */
   function it_has_a_threads()
   {
       $channel = create('App\Channel');
       $thread = create('App\Thread',['channel_id'=>$channel->id]);
    
        $this->assertTrue($channel->threads->contains($thread));
   }
}
