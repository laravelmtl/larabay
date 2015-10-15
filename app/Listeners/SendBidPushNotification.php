<?php

namespace App\Listeners;

use App\Broadcasters\ParseBroadcaster;
use App\Events\BidWasCreated;
use Illuminate\Contracts\Broadcasting\Factory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBidPushNotification
{
    /**
     * @var BroadcastManager
     */
    private $broadcastManager;

    /**
     * Create the event listener.
     *
     * @param Factory $broadcastManager
     */
    public function __construct(Factory $broadcastManager)
    {
        //
        $this->broadcastManager = $broadcastManager;
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(BidWasCreated $event)
    {
        $config = config('broadcasting.connections.parse');

        $broadcaster = $this->broadcastManager->extend('parse', function() use ($config) {
            return new ParseBroadcaster($config['app_id'], $config['key'], $config['url']);
        });

        $broadcaster->driver('parse')->broadcast([], $event, []);
    }
}
