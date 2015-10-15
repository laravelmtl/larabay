<?php

namespace App\Listeners;

use App\Events\BidWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBidPushNotification
{
    protected $parseApplicationId = "KVoYpkSprEY327cemJecUFQp8Vs6EbaczduSOpGp";
    protected $parseKey = "FkKK0FakS3e2Nt1cIiWdzvxOtWaNmQ309cMZ9vP2";
    protected $parseUrl = "https://api.parse.com/1/push";

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(BidWasCreated $event)
    {
        $notification = array(
            //'type' => 'ios',
            'expiry' => 1451606400,
            'where' => array(
                'deviceType' => 'ios',
            ),
            //"channels" => array(),
            'data' => array(
                'alert' => $event->bid->username . ' has just bidded '. $event->bid->amount . ' $ on ' . $event->bid->product->name,
                'mproving' => [
                    'url' => 'http:://www.larabay.com',
                    'bid' => $event->bid
                ],
                'sound' => 'push.caf',
            ),
        );

        $_data = json_encode($notification);
        $headers = array(
            'X-Parse-Application-Id: ' . $this->parseApplicationId,
            'X-Parse-REST-API-Key: ' . $this->parseKey,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );

        $curl = curl_init($this->parseUrl);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_exec($curl);
    }
}
