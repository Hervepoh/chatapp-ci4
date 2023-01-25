<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\UserModel;
use App\Models\ConnectionModel;


class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        //ws://localhost:8082/?access_token={id_user}
        $user_id =$this->get_ws_user_id($conn);

        $userModel = new UserModel();
        $connectionModel = new ConnectionModel();

        $user = $userModel->find($user_id);
        $conn->user = $user;

        $this->clients->attach($conn);
        
        $connectionModel->where('user_id',$user['id'])->delete();

        $connectionData = [
            'user_id' => $user['id'],
            'ressource_id' => $conn->resourceId,
            'name' => $user['firstname'],
        ];
        $connectionModel->save($connectionData);
        $users = $connectionModel->findAll();

        foreach($this->clients as $client){
            $client->send(json_encode(compact('users')));
        }

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $data = [
                    'message' => $msg,
                    'author' => $from->user['firstname'],
                    'time' => date('H:i')
                ];
                //$client->send($msg);
                $client->send(json_encode($data));
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        $connectionModel = new ConnectionModel();

        $connectionModel->where('ressource_id', $conn->resourceId)->detlete();
        $users = $connectionModel->findAll();

        foreach($this->clients as $client){
            $client->send(json_encode(compact('users')));
        }
        

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    private function get_ws_user_id($conn) {
        $uriQuery = $conn->httpRequest->getUri()->getQuery();
        $uriQueryArr = explode('=',$uriQuery);
        return $uriQueryArr[1];
    }
}
