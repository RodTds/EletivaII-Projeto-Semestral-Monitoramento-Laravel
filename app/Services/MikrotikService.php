<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;
use Exception;

class MikrotikService
{
    protected $client;

    public function __construct()
    {
        try {
            $this->client = new Client([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USER'),
                'pass' => env('MIKROTIK_PASS'),
                'port' => (int) env('MIKROTIK_PORT', 8728),
            ]);
        } catch (Exception $e) {
            // Se não conseguir conectar, não mata o sistema
            $this->client = null;
        }
    }

    public function getPppUsersWithStatusAndIp()
    {
        if (!$this->client) {
            return false; // Retorna falso se não conectou
        }

        try {
            // Todos os usuários PPPoE
            $queryUsers = new Query('/ppp/secret/print');
            $users = $this->client->query($queryUsers)->read();

            // Usuários ativos
            $queryActive = new Query('/ppp/active/print');
            $activeUsers = $this->client->query($queryActive)->read();

            // Mapear usuários ativos pelo nome
            $activeMap = [];
            foreach ($activeUsers as $active) {
                $activeMap[$active['name']] = $active['address'] ?? '-';
            }

            // Adicionar status e IP
            foreach ($users as &$user) {
                if (isset($activeMap[$user['name']])) {
                    $user['status'] = 'Online';
                    $user['ip'] = $activeMap[$user['name']];
                } else {
                    $user['status'] = 'Offline';
                    $user['ip'] = '-';
                }
            }

            return $users;
        } catch (Exception $e) {
            return false; // Caso dê erro durante a consulta
        }
    }
}
