@extends('layout')

@section('conteudo')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-white border-bottom-0">
            <ul class="nav nav-tabs card-header-tabs" id="ptpTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="listar-tab" data-bs-toggle="tab" data-bs-target="#listar"
                        type="button" role="tab" aria-controls="listar" aria-selected="true">
                        Lista de PTPs
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="cadastro-tab" data-bs-toggle="tab" data-bs-target="#cadastro"
                        type="button" role="tab" aria-controls="cadastro" aria-selected="false">
                        Cadastrar 
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content" id="ptpTabsContent">

            <!-- Aba de Listagem -->
            <div class="tab-pane fade show active" id="listar" role="tabpanel" aria-labelledby="listar-tab">

                <!-- Campo de busca -->
                <div class="row mb-3 mt-3">
                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm" id="buscaPTP"
                            placeholder="🔍 Buscar PTP..." style="width: 200px;">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tabelaPTP">
                        <thead class="table-success">
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Endereço</th>
                                <th>Responsável</th>
                                <th>Contato</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ptps as $ptp)
                                <tr>
                                    <td>{{ $ptp->nome }}</td>
                                    <td>{{ $ptp->descricao }}</td>
                                    <td>{{ $ptp->endereco }}</td>
                                    <td>{{ $ptp->responsavel }}</td>
                                    <td>{{ $ptp->telefone }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success"
                                            onclick="abrirModalEdicaoPTP({{ $ptp->id }})">Editar</button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="abrirModalExcluirPTP({{ $ptp->id }})">Excluir</button>
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($ptps) === 0)
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Nenhum PTP cadastrado.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Aba de Cadastro -->
            <div class="tab-pane fade" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                <form method="post" action="/ptp">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-6">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input type="text" id="descricao" name="descricao" class="form-control form-control-sm"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" id="endereco" name="endereco" class="form-control form-control-sm"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="responsavel" class="form-label">Responsável</label>
                            <input type="text" id="responsavel" name="responsavel" class="form-control form-control-sm"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Contato</label>
                            <input type="text" id="telefone" name="telefone" class="form-control form-control-sm"
                                required>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success px-4">Aplicar</button>
                    </div>
                </form>
            </div>

            <!-- Modal de Edição de PTP -->
            <div class="modal fade" id="modalEdicaoPTP" tabindex="-1" aria-labelledby="modalEdicaoPTPLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar PTP</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body" id="conteudoModalEdicaoPTP">
                            <p class="text-muted">Carregando...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Exclusão de PTP -->
            <div class="modal fade" id="modalExcluirPTP" tabindex="-1" aria-labelledby="modalExcluirPTPLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar Exclusão de PTP</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body" id="conteudoModalExcluirPTP">
                            <p class="text-muted">Carregando...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script>
                function abrirModalEdicaoPTP(id) {
                    const modal = new bootstrap.Modal(document.getElementById('modalEdicaoPTP'));
                    document.getElementById('conteudoModalEdicaoPTP').innerHTML = '<p class="text-muted">Carregando...</p>';
                    modal.show();

                    fetch(`/ptp/${id}/edit`)
                        .then(response => {
                            if (!response.ok) throw new Error('Erro ao carregar formulário');
                            return response.text();
                        })
                        .then(html => {
                            document.getElementById('conteudoModalEdicaoPTP').innerHTML = html;
                        })
                        .catch(error => {
                            document.getElementById('conteudoModalEdicaoPTP').innerHTML =
                                '<div class="alert alert-danger">Erro ao carregar formulário.</div>';
                            console.error(error);
                        });
                }

                document.getElementById('buscaPTP').addEventListener('input', function() {
                    const termoBusca = this.value.toLowerCase();
                    const linhas = document.querySelectorAll('#tabelaPTP tbody tr');

                    linhas.forEach(linha => {
                        const textoLinha = linha.textContent.toLowerCase();
                        linha.style.display = textoLinha.includes(termoBusca) ? '' : 'none';
                    });
                });

                function abrirModalExcluirPTP(id) {
                    const modal = new bootstrap.Modal(document.getElementById('modalExcluirPTP'));
                    document.getElementById('conteudoModalExcluirPTP').innerHTML = '<p class="text-muted">Carregando...</p>';
                    modal.show();

                    fetch(`/ptp/${id}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Erro ao carregar confirmação');
                            return response.text();
                        })
                        .then(html => {
                            document.getElementById('conteudoModalExcluirPTP').innerHTML = html;
                        })
                        .catch(error => {
                            document.getElementById('conteudoModalExcluirPTP').innerHTML =
                                '<div class="alert alert-danger">Erro ao carregar confirmação.</div>';
                            console.error(error);
                        });
                }
            </script>

        </div>
    </div>
</div>
@endsection
