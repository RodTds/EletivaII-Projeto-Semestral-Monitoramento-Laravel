<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class PppoeController extends Controller
{
    private function mikrotikClient()
    {
        return new Client([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USER'),
            'pass' => env('MIKROTIK_PASS'),
        ]);
     
    }

    public function index()
    {
        $client = $this->mikrotikClient();

        // Busca todos os secrets (clientes cadastrados)
        $querySecrets = new Query('/ppp/secret/print');
        $secrets = $client->query($querySecrets)->read();

        // Busca todos os ativos online
        $queryActive = new Query('/ppp/active/print');
        
        $active = $client->query($queryActive)->read();
        dd($active);
     
        
        // Monta um array para a view
        $users = [];
        foreach ($secrets as $secret) {
            $user = [
                'name'     => $secret['name'] ?? '',
                'password' => $secret['password'] ?? '',
                'profile'  => $secret['profile'] ?? '',
                'status'   => 'Offline',
                'ip'       => null,
                'uptime'   => null,
            ];

            // Verifica se está online no array $active
           $users = [];
foreach ($secrets as $secret) {
    $user = [
        'name'     => $secret['name'] ?? '',
        'password' => $secret['password'] ?? '',
        'profile'  => $secret['profile'] ?? '',
        'status'   => 'Offline',
        'ip'       => null,
        'uptime'   => null,
    ];

    foreach ($active as $act) {
        if ($act['name'] === $secret['name']) {
            $user['status'] = 'Online';
            $user['ip']     = $act['address'] ?? null;
            $user['uptime'] = $act['uptime'] ?? $act['session-time'] ?? $act['time'] ?? null;
            break;
        }
    }

    $users[] = $user;
}

return view('pppoe.index', compact('users'));



            $users[] = $user;
        }
         
        return view('pppoe.index', compact('users'));
    }

    public function create()
    {
        return view('pppoe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'profile' => 'required|string',
        ]);

        $client = $this->mikrotikClient();

        $query = new Query('/ppp/secret/add');
        $query->equal('name', $request->name);
        $query->equal('password', $request->password);
        $query->equal('service', 'pppoe');
        $query->equal('profile', $request->profile);

        try {
            $client->query($query)->read();
            return redirect()->route('pppoe.index')->with('success', 'Cliente PPPoE adicionado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('pppoe.index')->with('error', 'Erro ao adicionar cliente: ' . $e->getMessage());
        }
    }
}
