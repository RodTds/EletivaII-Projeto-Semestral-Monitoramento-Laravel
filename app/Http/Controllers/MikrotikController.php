<?php

namespace App\Http\Controllers;

use App\Services\MikrotikService;

class MikrotikController extends Controller
{
    protected $mikrotik;

    public function __construct(MikrotikService $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    public function pppoe()
    {
        $users = $this->mikrotik->getPppUsersWithStatusAndIp();

        if ($users === false) {
            // Retorna uma view de erro
            return view('mikrotik.error');
        }

        return view('mikrotik.pppoe', compact('users'));
    }
}
