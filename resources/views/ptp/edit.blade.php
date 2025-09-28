<form method="POST" action="{{ route('ptp.update', $ptp->id) }}">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ $ptp->nome }}" class="form-control form-control-sm" required>
        </div>

        <div class="col-md-6">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" id="descricao" name="descricao" value="{{ $ptp->descricao }}" class="form-control form-control-sm" required>
        </div>

        <div class="col-md-6">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" id="endereco" name="endereco" value="{{ $ptp->endereco }}" class="form-control form-control-sm" required>
        </div>

        <div class="col-md-6">
            <label for="responsavel" class="form-label">Responsável</label>
            <input type="text" id="responsavel" name="responsavel" value="{{ $ptp->responsavel }}" class="form-control form-control-sm" required>
        </div>

        <div class="col-md-6">
            <label for="telefone" class="form-label">Contato</label>
            <input type="text" id="telefone" name="telefone" value="{{ $ptp->telefone }}" class="form-control form-control-sm" required>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4">Salvar Alterações</button>
        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
    </div>
</form>
