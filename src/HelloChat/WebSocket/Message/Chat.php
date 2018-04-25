<?php

namespace HelloChat\WebSocket\Message;

use HelloChat\WebSocket\Storage\Messages;
use HelloChat\WebSocket\Storage\Clients;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Exception;

class Chat implements MessageComponentInterface
{
    private $messages;
    private $clients;

    public function __construct()
    {
        $this->messages = new Messages();
        $this->clients = new Clients();
    }

    public function onOpen(ConnectionInterface $client)
    {
        $this->clients->add($client);

        $client->send(' ** Currently ' . $this->clients->size() . ' clients connected **');

        foreach ($this->messages->getAll() as $oldMessage) {
            $client->send($oldMessage);
        }

        $this->clients->each(function($other) use ($client) {
            if ($other !== $client) {
                $other->send(' ** New client joined **');
            }
        });
    }

    public function onMessage(ConnectionInterface $client, $message)
    {
        $this->messages->add($message);

        $this->clients->each(function($other) use ($client, $message) {
            if ($other !== $client) {
                $other->send($message);
            }
        });
    }

    public function onClose(ConnectionInterface $client)
    {
        $this->clients->remove($client);

        $this->clients->each(function($other) {
            $other->send(' ** Some client disconnected **');
        });
    }

    public function onError(ConnectionInterface $connection, Exception $e)
    {
        $connection->close();
    }

}
