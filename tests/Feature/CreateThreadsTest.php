<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
 
    /** @test */
    function guest_may_not_create_and_see_the_thread()
    {
        $this->withExceptionHandling();
        $this->post('threads', [])
            ->assertRedirect('/login');

        $this->get('threads/create')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/threads',$thread->toArray());

        $this->get($response->headers->get('Location'))
             ->assertSee($thread->title)
             ->assertSee($thread->body);
    }

    /** @test */
    function a_thraed_require_a_title()
    {
        $this->publishThread(['title'=>null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_require_a_body()
    {
        $this->publishThread(['body'=>null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    function a_thread_require_a_valid_channel()
    {
        factory('App\Channel',2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    
    }

    function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        
        $thread = make('App\Thread',$overrides);

        return $this->post('/threads',$thread->toArray());
    }
}
