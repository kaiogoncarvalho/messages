<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property string $subject
 * @property string $content
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $expiration_date
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message withoutTrashed()
 * @mixin \Eloquent
 */
class Message extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'id',
        'subject',
        'user_id',
        'content',
        'start_date',
        'expiration_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    protected $hidden = [
        'deleted_at',
        'pivot'
    ];
    
    protected $dates = [
        'start_date',
        'expiration_date',
        'created_at',
        'updated_at'
    ];
    
    public function toHistory()
    {
        return [
            'message_id'      => $this->id,
            'subject'         => $this->subject,
            'user_id'         => $this->user_id,
            'content'         => $this->content,
            'start_date'      => $this->start_date->format('Y-m-d H:i:s'),
            'expiration_date' => $this->expiration_date->format('Y-m-d H:i:s'),
            'created_at'      => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'      => $this->updated_at->format('Y-m-d H:i:s'),
            'deleted_at'      => ($this->deleted_at !== null) ? $this->deleted_at->format('Y-m-d H:i:s') : null,
        ];
    }
    
}
