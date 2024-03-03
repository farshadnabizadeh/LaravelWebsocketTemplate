<?php
// app/Console/Commands/WebSocketServerCommand.php

namespace App\Console\Commands;

use App\Http\Controllers\WebSocketController;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Illuminate\Console\Command;

class WebSocketServerCommand extends Command
{
    // The name and signature of the console command
    protected $signature = 'websocket:serve';

    // The console command description
    protected $description = 'Start the WebSocket server';

    public function handle()
    {
        $this->info('Starting WebSocket server...');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            3000 // The port number you want to use
        );

        $this->info('WebSocket server started on port 3000');
        $server->run();
    }
}
