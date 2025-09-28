<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Radio;
use App\Models\Ptp;
use RouterOS\Client;
use RouterOS\Query;

class RadioController extends Controller
{
    // ✅ Exibir rádios com status
    public function index()
    {
        $radios = Radio::with('ptp')->get();

        return view('radio.index', compact('radios'));
    }

    public function create()
    {
        $ptps = Ptp::all();
        $radios = Radio::all();
        return view('radio.create', compact('ptps', 'radios'));
    }

    // ✅ Salvar rádio e criar Netwatch no MikroTik
    public function store(Request $request)
    {
        try {
            $radio = Radio::create($request->all());

            $client = new Client([
                'host' => env('MIKROTIK_HOST'),
                'user' => env('MIKROTIK_USER'),
                'pass' => env('MIKROTIK_PASS'),
                'port' => (int) env('MIKROTIK_PORT', 8728),
            ]);

            $appIp = env('APP_IP');

            $upScript = '/tool fetch url="http://' . $appIp . ':8000/radio/update-status?ip=' . $radio->ip . '&status=online" keep-result=no';
            $downScript = '/tool fetch url="http://' . $appIp . ':8000/radio/update-status?ip=' . $radio->ip . '&status=offline" keep-result=no';

            $query = new Query('/tool/netwatch/add');
            $query->equal('host', $radio->ip)
                ->equal('interval', '00:00:10')
                ->equal('timeout', '10s')
                ->equal('up-script', $upScript)
                ->equal('down-script', $downScript)
                ->equal('comment', "Monitor Radio {$radio->nome}");

            $response = $client->query($query)->read();

            Log::info('Netwatch criado com sucesso', [
                'ip' => $radio->ip,
                'response' => $response
            ]);

            return redirect()->route("radio.index")->with("sucesso", "Rádio cadastrado e monitoramento iniciado!");
        } catch (\Exception $e) {
            Log::error("Erro ao cadastrar rádio: " . $e->getMessage());
            return redirect()->route('radio.index')->with("erro", "Erro ao cadastrar rádio: " . $e->getMessage());
        }
    }
    public function edit(string $id)
    {
        $radio = Radio::findOrFail($id);
        $ptp = Ptp::all();
        return view('radio.edit', compact('radio', 'ptp'));
    }
    public function update(Request $request, string $id)
    {
        try {
            $radio = Radio::findOrFail("$id");
            $radio->update($request->all());


            return redirect()->route("radio.create")->with("sucesso", "Registro Alterado");
        } catch (\Exception $e) {
            Log::error("erro ao alterar o registro do cliente!" . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('radio.index')->with("erro", "Erro ao alterar");
        }
    }

    public function show($id)
    {
        $radio = Radio::with('ptp')->findOrFail($id);
        return view('radio.show', compact('radio'));
    }

    public function destroy(string $id)
    {
        try {
            $radio = Radio::findOrFail("$id");
            $radio->delete();


            return redirect()->route("radio.index")->with("sucesso", "Radio Exluido");
        } catch (\Exception $e) {
            Log::error("erro ao excluir o registro do Radio!" . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route('radio.index')->with("erro", "Erro ao excluir");
        }
    }

    // ✅ Endpoint que o MikroTik chama via Netwatch
    public function updateStatus(Request $request)
    {
        $ip = $request->get('ip');
        $status = $request->get('status');

        $radio = Radio::where('ip', $ip)->first();

        if ($radio) {
            $radio->status = $status;
            $radio->save();

            Log::info("Status atualizado via Netwatch", [
                'ip' => $ip,
                'status' => $status
            ]);

            return response('OK', 200);
        }

        return response('Rádio não encontrado', 404);
    }
}
