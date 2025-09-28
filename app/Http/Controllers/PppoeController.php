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
            return redirect()->route('pppoe.create')->with('success', 'Cliente PPPoE adicionado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('pppoe.create')->with('error', 'Erro ao adicionar cliente: ' . $e->getMessage());
        }
    }
}
