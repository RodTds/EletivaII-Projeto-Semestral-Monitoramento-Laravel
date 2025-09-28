

<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-4 bg-light" style="max-width: 600px; width: 100%; border-radius: 15px;">
        <h2 class="text-center mb-4">Alterar Informações</h2>

        <form method="post" action="/radio/{{ $radio->id }}">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input value="{{$radio->nome}}" disabled type="text" id="nome" name="nome" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="ip" class="form-label">IP</label>
                <input value="{{$radio->ip}}"  disabled type="text" id="ip" name="ip" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input value="{{$radio->modelo}}" disabled type="text" id="modelo" name="modelo" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="ssid" class="form-label">SSID</label>
                <input value="{{$radio->ssid}}" disabled type="text" id="ssid" name="ssid" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="direcao" class="form-label">Direção</label>
                <input value="{{$radio->direcao}}" disabled type="text" id="direcao" name="direcao" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="frequencia" class="form-label">Frequência</label>
                <input value="{{$radio->frequencia}}" disabled type="text" id="frequencia" name="frequencia" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="canal" class="form-label">Canal</label>
                <input value="{{$radio->canal}}" disabled type="text" id="canal" name="canal" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="senhawifi" class="form-label">Senha Wifi</label>
                <input value="{{$radio->senhawifi}}" disabled type="text" id="senhawifi" name="senhawifi" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input value="{{$radio->login}}" disabled type="text" id="login" name="login" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label for="senhaacesso" class="form-label">Senha Acesso</label>
                <input value="{{$radio->senhaacesso}}" disabled type="text" id="senhaacesso" name="senhaacesso" class="form-control form-control-sm" required>
            </div>

            <!-- SELECT de PTP -->
             <div class="mb-3">
            <label for="ptp" class="form-label">PTP</label>
            <input disabled value=" {{$radio->ptp ? $radio->ptp->nome : '-'}}" type="text" id="categoria" name="categoria" class="form-control"
                required="">
        </div>
           <p>Deseja Excluir esse Registro ?</p>

        <div>
    <p>Tem certeza que deseja excluir o rádio <strong>{{ $radio->nome }}</strong>?</p>
    
    <form method="POST" action="{{ route('radio.destroy', $radio->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
    </form>
</div>

        </form>
    </div>
</div>


