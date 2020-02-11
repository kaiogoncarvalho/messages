<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class MessageHistory extends Model
{
    protected $collection = 'message_history';
    protected $primaryKey = '_id';
    protected $connection = 'mongodb';
    protected $fillable = [
        '_id',
        'message_id',
        'subject',
        'user_id',
        'content',
        'start_date',
        'expiration_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
