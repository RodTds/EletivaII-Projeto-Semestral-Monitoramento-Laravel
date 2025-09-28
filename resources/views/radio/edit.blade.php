<!-- Aba Cadastro -->
<div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
    <form method="POST" action="{{ route('radio.update', $radio->id) }}">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input value="{{ $radio->nome }}" type="text" id="nome" name="nome"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="ip" class="form-label">IP</label>
                <input value="{{ $radio->ip }}" type="text" id="ip" name="ip"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="modelo" class="form-label">Modelo</label>
                <input value="{{ $radio->modelo }}" type="text" id="modelo" name="modelo"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="ssid" class="form-label">SSID</label>
                <input value="{{ $radio->ssid }}" type="text" id="ssid" name="ssid"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="direcao" class="form-label">Direção</label>
                <input value="{{ $radio->direcao }}" type="text" id="direcao" name="direcao"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="frequencia" class="form-label">Frequência</label>
                <input value="{{ $radio->frequencia }}" type="text" id="frequencia" name="frequencia"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="canal" class="form-label">Canal</label>
                <input value="{{ $radio->canal }}" type="text" id="canal" name="canal"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="senhawifi" class="form-label">Senha Wifi</label>
                <input value="{{ $radio->senhawifi }}" type="text" id="senhawifi" name="senhawifi"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="login" class="form-label">Login</label>
                <input value="{{ $radio->login }}" type="text" id="login" name="login"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-6">
                <label for="senhaacesso" class="form-label">Senha Acesso</label>
                <input value="{{ $radio->senhaacesso }}" type="text" id="senhaacesso" name="senhaacesso"
                    class="form-control form-control-sm" required>
            </div>

            <div class="col-md-12">
                <label for="ptp_id" class="form-label">Ponto a Ponto</label>
                <select id="ptp_id" name="ptp_id" class="form-select form-select-sm" required>
                    <option value="">Selecione um PTP</option>
                    @foreach ($ptp as $p)
                        <option value="{{ $p->id }}" {{ $radio->ptp_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Aplicar Alterações</button>
            <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>

        </div>
    </form>
</div>

</div>
</div>
</div>
