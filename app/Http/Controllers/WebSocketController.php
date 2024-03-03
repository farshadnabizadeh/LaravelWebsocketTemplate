<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketController extends Controller implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        // New connection
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // New message
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Connection closed
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Error occurred
    }
}
