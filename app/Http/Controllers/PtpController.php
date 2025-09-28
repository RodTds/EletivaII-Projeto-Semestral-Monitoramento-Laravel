<?php

namespace App\Http\Controllers;

use App\Models\Ptp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ptps = Ptp::all();
        return view("ptp.index",compact("ptps")); // esse ptps na função compact é a variavel criada
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $ptps = Ptp::all();
        return view('ptp.create',compact('ptps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Ptp::create($request->all());
            return redirect()->route("ptp.create")->with("sucesso","Registro inserido");

        }catch(\Exception $e){
            Log::error("erro ao salvar o registro do Ponto a Ponto!".$e->getMessage(),[
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('ptp.index')->with("erro","Erro ao inserir");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $ptp = PTP::findOrFail($id);
    return view('ptp.show', compact('ptp')); // ou onde estiver a show.blade.php
}


    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $ptp = Ptp::findOrFail($id);
    return view('ptp.edit', compact('ptp'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
         try {
            $ptp = Ptp::findOrFail("$id");
            $ptp->update($request->all());


            return redirect()->route("ptp.create")->with("sucesso", "Registro Alterado");
        } catch (\Exception $e) {
            Log::error("erro ao alterar o registro do cliente!" . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('ptp.index')->with("erro", "Erro ao alterar");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
       public function destroy(string $id)
    {
            try{
              $ptp = Ptp::findOrFail("$id");
              $ptp->delete();

           
            return redirect()->route("ptp.create")->with("sucesso","Registro Exluido");

        }catch(\Exception $e){
            Log::error("erro ao excluir o registro do cliente!".$e->getMessage(),[
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route('ptp.create')->with("erro","Erro ao excluir");
        }
    }
}
