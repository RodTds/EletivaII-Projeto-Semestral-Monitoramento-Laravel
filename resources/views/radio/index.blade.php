@extends('layout')

@section('conteudo')
<div class="container mt-4">

    {{-- Faixa com cores do menu lateral --}}
    <div class="text-center py-2 mb-4" 
         style="background-color:#1a2630; border-radius:6px;">
        <h2 class="mb-0" style="color:#fff;">
            <span style="color:#50b948;">TelecomNet Rede Monitorada</span> 
        </h2>
    </div>

    @if (session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    @if (session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    <div class="row justify-content-start">
        @foreach ($radios as $radio)
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <div class="card 
                    @if($radio->status === 'online') bg-success text-white 
                    @elseif($radio->status === 'offline') bg-danger text-white 
                    @else bg-secondary text-white @endif" 
                    style="min-height: 150px;">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">{{ $radio->nome }}</h6>
                        <small class="d-block"><strong>IP:</strong> {{ $radio->ip }}</small>
                        <small class="d-block"><strong>PTP:</strong> {{ $radio->ptp->nome ?? 'N/A' }}</small>
                        <small class="d-block">
                            <strong>Status:</strong> 
                            @if ($radio->status === 'online')
                                Online
                            @elseif ($radio->status === 'offline')
                                Offline
                            @else
                                Desconhecido
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
