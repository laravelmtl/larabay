<?php

namespace App\Broadcasters;

use Pusher;
use Illuminate\Contracts\Broadcasting\Broadcaster;

class ParseBroadcaster implements Broadcaster
{
    /**
     * The Parse SDK instance.
     *
     * @var \Parse
     */
    protected $app_id;
    protected $key;
    protected $url;

    /**
     * Create a new broadcaster instance.
     *
     * @param $appId
     * @param $key
     * @param $url
     */
    public function __construct($appId, $key, $url)
    {
        $this->app_id = $appId;
        $this->key = $key;
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        $notification = $this->buildMessage($event);

        $this->sendPush($notification);
    }

    /**
     * @param $notification
     */
    private function sendPush($notification)
    {
        $_data = json_encode($notification);

        $headers = $this->setHeaders($_data);

        $this->curl($_data, $headers);
    }

    /**
     * @param $_data
     * @return array
     */
    private function setHeaders($_data)
    {
        return [
            'X-Parse-Application-Id: ' . $this->app_id,
            'X-Parse-REST-API-Key: ' . $this->key,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        ];
    }

    /**
     * @param $_data
     * @param $headers
     */
    private function curl($_data, $headers)
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_exec($curl);
    }

    /**
     * @param $event
     * @return array
     */
    private function buildMessage($event)
    {
        return [
            //'type' => 'ios',
            'expiry' => 1451606400,
            'where' => [
                'deviceType' => 'ios',
            ],
            //"channels" => array(),
            'data' => [
                'alert' => $event->bid->username . ' has just bidded ' . $event->bid->amount . ' $ on ' . $event->bid->product->name,
                'mproving' => [
                    'url' => 'http:://www.larabay.com',
                    'bid' => $event->bid
                ],
                'sound' => 'push.caf',
            ],
        ];
    }
}
