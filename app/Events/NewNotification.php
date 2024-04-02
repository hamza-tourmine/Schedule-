<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_id;
    public $comment;
    public $main_emploi_id;
    public $date;
    public $time;
    public function __construct($info)
    {
        $this-> user_id = $info['user_id'];
        $this-> comment = $info['comment'];
        $this-> main_emploi_id = $info['main_emploi_id'];
        $this-> date = date('Y-m-d',strtotime(Carbon::now()));
        $this-> time = date('h:i A',strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() :array
    {
        return ['my-channel'];
    }
    public function broadcastAs() 
    {
        return 'request-submitted';
    }
}
