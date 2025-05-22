<?php

namespace Codeguru\ArDrone\Navdata;

use Evenement\EventEmitter;
use Codeguru\ArDrone\Config\Config;
use React\Datagram\Factory as UdpFactory;
use React\Datagram\Socket as UdpSocket;

class UdpNavdata extends EventEmitter
{
    /**
     * @var \React\EventLoop\StreamSelectLoop
     */
    private $loop;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $ip;

    public function __construct($loop)
    {
        $this->port = Config::CONTROL_PORT;
        $this->ip = Config::DRONE_IP;
        $this->loop = $loop;

        $this->start();
    }

    private function start()
    {
        $udpFactory = new UdpFactory($this->loop);
        $udpNavdata = $this;

        // Navdata stream
        $udpFactory->createClient(Config::DRONE_IP.':'.Config::NAVDATA_PORT)->then(function (UdpSocket $client) use (&$udpNavdata) {
            // Start dialog
            $client->send('1');
            $client->send('1');

            $client->on('message',
                function ($message) use (&$udpNavdata) {
                $frame = new Frame($message);
                $udpNavdata->emit('navdata', [$frame]);
            });
        });
    }
}
