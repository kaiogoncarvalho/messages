<?php

namespace App\Services;

use App\Models\Message;
use App\Models\MessageHistory;

/**
 * Class MessagesService
 * @package App\Services
 */
class MessagesService
{
    /**
     * @param array $fields
     * @return Message
     */
    public function create(array $fields): Message
    {
        /**
         * @var Message $message
         */
        $message = Message::create($fields);
        MessageHistory::create($message->toHistory());
        return $message;
    }
    
    /**
     * @param int $id
     * @param int $userId
     * @param array $fields
     * @return Message
     */
    public function update(int $id, int $userId, array $fields)
    {
        /**
         * @var Message $message
         */
        $message = Message::where(['id' => $id])
            ->where(['user_id' => $userId])->first();
        
        $message->subject = $fields['subject'] ?? $message->subject;
        $message->content = $fields['content'] ?? $message->content;
        $message->start_date = $fields['start_date'] ?? $message->start_date;
        $message->expiration_date = $fields['expiration_date'] ?? $message->expiration_date;
        
        $message->save();
        
        MessageHistory::create($message->toHistory());
        
        return $message;
    }
    
    /**
     * @param int $id
     * @param int $userId
     * @return Message
     */
    public function get(int $id, int $userId): Message
    {
        return Message::where(['id' => $id])
            ->where(['user_id' => $userId])->first();
    }
    
    /**
     * @param int $id
     * @param int $userId
     * @return Message
     */
    public function getHistory(int $id, int $userId)
    {
        return MessageHistory::where(['message_id' => $id])
            ->where(['user_id' => $userId])->paginate(
                $headers['perpage'][0] ?? 10,
                ['*'],
                'page',
                $headers['page'][0] ?? 1
            );
    }
    
    /**
     * @param int $userId
     * @param array|null $filters
     * @param array|null $headers
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(int $userId, ?array $filters, ?array $headers)
    {
        $messages = Message::where(['user_id' => $userId])->orderBy($filters['order'] ?? 'subject');
        
        if (array_key_exists('subject', $filters)) {
            $messages->whereRaw("subject like '%{$filters['subject']}%'");
        }
        if (array_key_exists('content', $filters)) {
            $messages->whereRaw("content like '%{$filters['content']}%'");
        }
        
        return $messages->paginate(
            $headers['perpage'][0] ?? 10,
            ['*'],
            'page',
            $headers['page'][0] ?? 1
        );
    }
    
    /**
     * @param int $id
     * @param int $userId
     * @throws \Exception
     */
    public function delete(int $id, int $userId): void
    {
        /**
         * @var Message $message
         */
        $message = $message = Message::where(['id' => $id])
            ->where(['user_id' => $userId])->first();
        $message->delete();
        
        MessageHistory::create($message->toHistory());
    }
}
