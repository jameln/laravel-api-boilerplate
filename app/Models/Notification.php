<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Notifications\DatabaseNotificationCollection;

/**
 * Class Notification.
 */
class Notification extends ApiModel
{
    use UuidModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Pagination limit inclusive max value.
     * @var int
     */
    protected $perPageMax = 50;

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    /**
     * Get the notifiable entity that the notification belongs to.
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Mark the notification as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
        }
    }

    /**
     * Mark the notification as runead.
     *
     * @return void
     */
    public function markAsUnread()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => null])->save();
        }
    }

    /**
     * Determine if a notification has been read.
     *
     * @return bool
     */
    public function read()
    {
        return $this->read_at !== null;
    }

    /**
     * Determine if a notification has not been read.
     *
     * @return bool
     */
    public function unread()
    {
        return $this->read_at === null;
    }

    /**
     * Create a new database notification collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Notifications\DatabaseNotificationCollection
     */
    public function newCollection(array $models = [])
    {
        return new DatabaseNotificationCollection($models);
    }
}
