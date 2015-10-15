<?php

namespace App\Events;

use App\Bid;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BidWasCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $bid;
    /**
     * Create a new event instance.
     *
     * @param Bid $bid
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['all-users'];
    }
}
