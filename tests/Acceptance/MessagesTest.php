<?php

namespace Test\Acceptance;

use Illuminate\Http\Response;
use Test\TestCase;

class MessagesTest extends TestCase
{
    /**
     * Test Create Message
     * @covers \App\Http\Controllers\MessagesController::create
     */
    public function testCreate()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        $message = factory('App\Models\Message')->make()->toArray();
        $body = [
            'subject'         => $message['subject'],
            'content'         => $message['content'],
            'start_date'      => $message['start_date'],
            'expiration_date' => $message['expiration_date'],
        ];
        $this->json(
            'POST',
            "/v1/messages",
            $body
        )->seeStatusCode(Response::HTTP_CREATED);
        
        $this->seeInDatabase(
            'messages',
            $body
        );
    
        $this->seeInDatabase(
            'message_history',
            $body,
            'mongodb'
        );
    }

    /**
     * Test Update Message
     * @covers \App\Http\Controllers\MessagesController::update
     */
    public function testUpdate()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        $message = factory('App\Models\Message')->create(['user_id' => $user->id]);
        $newMessage = factory('App\Models\Message')->make()->toArray();
        $body = [
            'subject'         => $newMessage['subject'],
            'content'         => $newMessage['content'],
            'start_date'      => $newMessage['start_date'],
            'expiration_date' => $newMessage['expiration_date'],
        ];
        
        $this->json(
            'PATCH',
            '/v1/messages/' . $message->id,
            $body
        )->seeStatusCode(Response::HTTP_OK);
        
        $this->seeInDatabase(
            'messages',
            $body
        );
    
        $this->seeInDatabase(
            'message_history',
            $body,
            'mongodb'
        );
    }

    /**
     * Test Get Message
     * @covers \App\Http\Controllers\MessagesController::get
     */
    public function testGet()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        $message = factory('App\Models\Message')->create(['user_id' => $user->id]);
        $this->json(
            'GET',
            '/v1/messages/' . $message->id
        )->seeStatusCode(Response::HTTP_OK)
            ->seeJson($message->toArray());
    }


    /**
     * Test Get All Messages
     * @covers \App\Http\Controllers\MessagesController::getAll
     */
    public function testGetAll()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        $message = factory('App\Models\Message')->create(['user_id' => $user->id]);
        $this->json(
            'GET',
            '/v1/messages'
        )->seeStatusCode(Response::HTTP_OK);

        $response = json_decode($this->response->getContent(), true);
        $this->assertEquals($response['data'][0], $message->toArray());
    }

    /**
     * Test Create Get All Paginate
     * @covers \App\Http\Controllers\MessagesController::getAll
     */
    public function testGetAllPaginate()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        factory('App\Models\Message')->times(30)->create(['user_id' => $user->id]);
        $this->json(
            'GET',
            '/v1/messages',
            [
            ],
            [
                'perpage' => 5,
                'page' => 2
            ]
        )->seeStatusCode(Response::HTTP_OK);

        $response = json_decode($this->response->getContent(), true);
        $this->assertCount(5, $response['data']);
        $this->assertEquals(2, $response['current_page']);
        $this->assertEquals(6, $response['from']);
        $this->assertEquals(6, $response['last_page']);
        $this->assertEquals(10, $response['to']);
        $this->assertEquals(30, $response['total']);
    }

    /**
     * Test Delete Message
     * @covers \App\Http\Controllers\MessagesController::delete
     */
    public function testDelete()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        $message = factory('App\Models\Message')->create(['user_id' => $user->id]);
        $this->json(
            'DELETE',
            '/v1/messages/' . $message->id
        )->seeStatusCode(Response::HTTP_NO_CONTENT)
            ->notSeeInDatabase(
                'messages',
                ['id' => $message->id, 'deleted_at' => null]
            );
    }
    
}
