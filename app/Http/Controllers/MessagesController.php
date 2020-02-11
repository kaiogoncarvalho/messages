<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Rules\Double;
use App\Services\MessagesService;
use Illuminate\Validation\Rule;
use App\Services\UsersService;
use Illuminate\Validation\ValidationException;

/**
 * Class MessagesController
 * @package App\Http\Controllers
 */
class MessagesController extends Controller
{
    
    /**
     * @param Request $request
     * @param MessagesService $messagesService
     * @param UsersService $usersService
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request, MessagesService $messagesService, UsersService $usersService)
    {
        $rules = [
            'subject'         => 'required|string|min:1|max:256',
            'content'         => 'required|string|min:1|max:1000',
            'start_date'      => 'required|date',
            'expiration_date' => 'required|date'
        
        ];
        
        $this->validate($request, $rules);
    
        
        
        $message = $messagesService->create(
            $request->all(
                [
                    'subject',
                    'content',
                    'start_date',
                    'expiration_date',
                ]
            ) + ['user_id' => $usersService->getAuthUser()->id]
        );
        
        return new JsonResponse($message->toArray(), Response::HTTP_CREATED);
    }
    
    /**
     * @param $id
     * @param Request $request
     * @param MessagesService $messagesService
     * @param UsersService $usersService
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update($id, Request $request, MessagesService $messagesService, UsersService $usersService)
    {
    
        $rules = [
            'subject'         => 'string|min:1|max:256',
            'content'         => 'string|min:1|max:1000',
            'start_date'      => 'date',
            'expiration_date' => 'date'
    
        ];
        
        $this->validate($request, $rules);
        
        $message = $messagesService->update(
            $id,
            $usersService->getAuthUser()->id,
            $request->all(
                [
                    'subject',
                    'content',
                    'start_date',
                    'expiration_date',
                ]
            )
        );
        
        return new JsonResponse($message->toArray(), Response::HTTP_OK);
    }
    
    /**
     * @param $id
     * @param MessagesService $messagesService
     * @param UsersService $usersService
     * @return \App\Models\Message
     */
    public function get($id, MessagesService $messagesService, UsersService $usersService)
    {
        return $messagesService->get($id, $usersService->getAuthUser()->id);
    }
    
    /**
     * @param $id
     * @param MessagesService $messagesService
     * @param UsersService $usersService
     * @return \App\Models\Message
     */
    public function getHistory($id, MessagesService $messagesService, UsersService $usersService)
    {
        return $messagesService->getHistory($id, $usersService->getAuthUser()->id);
    }
    
    /**
     * @param $id
     * @param MessagesService $messagesService
     * @param UsersService $usersService
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete($id, MessagesService $messagesService, UsersService $usersService)
    {
        $messagesService->delete($id, $usersService->getAuthUser()->id);
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
    
    /**
     * @param Request $request
     * @param MessagesService $messagesService
     * @param UsersService $usersService
     * @return JsonResponse
     */
    public function getAll(Request $request, MessagesService $messagesService, UsersService $usersService)
    {
        return new JsonResponse($messagesService->getAll($usersService->getAuthUser()->id, $request->all(), $request->header()), Response::HTTP_OK);
    }
}
