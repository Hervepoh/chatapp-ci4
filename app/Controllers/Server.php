<?php

namespace App\Controllers;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Chat;

class Server extends BaseController
{
    public function index()
    {
        if (!is_cli())
            die('Not this time, Mate');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8082
        );

        $db = db_connect();
        $builder = $db->table('connections');
        $builder->where(['id >'=> 0])->delete();

        $server->run();
    }
}
