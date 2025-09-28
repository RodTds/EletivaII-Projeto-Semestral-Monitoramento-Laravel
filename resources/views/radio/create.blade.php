@extends('layout')

@section('conteudo')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-white border-bottom-0">
                <ul class="nav nav-tabs card-header-tabs" id="radioTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" data-bs-target="#cadastro"
                            type="button" role="tab" aria-controls="cadastro" aria-selected="true">
                            Cadastro
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="listar-tab" data-bs-toggle="tab" data-bs-target="#listar"
                            type="button" role="tab" aria-controls="listar" aria-selected="false">
                            Lista de Rádios
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body tab-content" id="radioTabsContent">
                <!-- Aba Cadastro -->
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    <form method="post" action="/radio">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="ip" class="form-label">IP</label>
                                <input type="text" id="ip" name="ip" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" id="modelo" name="modelo" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="ssid" class="form-label">SSID</label>
                                <input type="text" id="ssid" name="ssid" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="direcao" class="form-label">Direção</label>
                                <input type="text" id="direcao" name="direcao" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="frequencia" class="form-label">Frequência</label>
                                <input type="text" id="frequencia" name="frequencia" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="canal" class="form-label">Canal</label>
                                <input type="text" id="canal" name="canal" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="senhawifi" class="form-label">Senha Wifi</label>
                                <input type="password" id="senhawifi" name="senhawifi" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" id="login" name="login" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="senhaacesso" class="form-label">Senha Acesso</label>
                                <input type="password" id="senhaacesso" name="senhaacesso"
                                    class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-12">
                                <label for="ptp_id" class="form-label">Ponto a Ponto</label>
                                <select id="ptp_id" name="ptp_id" class="form-select form-select-sm" required>
                                    <option value="">Selecione um PTP</option>
                                    @foreach ($ptps as $ptp)
                                        <option value="{{ $ptp->id }}">{{ $ptp->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4">Salvar</button>
                        </div>
                    </form>
                </div>

                <!-- Aba Lista -->
                <div class="tab-pane fade" id="listar" role="tabpanel" aria-labelledby="listar-tab">

                    <!-- Campo de busca -->
                    <div class="row mb-3 mt-3">
                        <div class="col-auto">
                            <input type="text" class="form-control form-control-sm" id="buscaRadio"
                                placeholder="🔍 Buscar..." style="width: 100%;">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabelaRadios">
                            <thead class="table-success">
                                <tr>
                                    <th>Nome</th>
                                    <th>IP</th>
                                    <th>Modelo</th>
                                    <th>SSID</th>
                                    <th>Direção</th>
                                    <th>Frequência</th>
                                    <th>Canal</th>
                                    <th>PTP</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($radios as $radio)
                                    <tr>
                                        <td>{{ $radio->nome }}</td>
                                        <td>{{ $radio->ip }}</td>
                                        <td>{{ $radio->modelo }}</td>
                                        <td>{{ $radio->ssid }}</td>
                                        <td>{{ $radio->direcao }}</td>
                                        <td>{{ $radio->frequencia }}</td>
                                        <td>{{ $radio->canal }}</td>
                                        <td>{{ $radio->ptp->nome ?? 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success"
                                                onclick="abrirModalEdicao({{ $radio->id }})">Editar</button>

                                            <button class="btn btn-sm btn-danger" onclick="abrirModalExcluir({{ $radio->id }})">
                                                Excluir
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($radios) === 0)
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Nenhum rádio cadastrado.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal de Edição -->
                <div class="modal fade" id="modalEdicao" tabindex="-1" aria-labelledby="modalEdicaoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Rádio</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body" id="conteudoModalEdicao">
                                <p class="text-muted">Carregando...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal de Exclusão -->
                <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="modalExcluirLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body" id="conteudoModalExcluir">
                                <p class="text-muted">Carregando...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function abrirModalExcluir(id) {
                        const modal = new bootstrap.Modal(document.getElementById('modalExcluir'));
                        document.getElementById('conteudoModalExcluir').innerHTML = '<p class="text-muted">Carregando...</p>';
                        modal.show();

                        fetch(`/radio/${id}`)
                            .then(response => {
                                if (!response.ok) throw new Error('Erro ao carregar confirmação');
                                return response.text();
                            })
                            .then(html => {
                                document.getElementById('conteudoModalExcluir').innerHTML = html;
                            })
                            .catch(error => {
                                document.getElementById('conteudoModalExcluir').innerHTML =
                                    '<div class="alert alert-danger">Erro ao carregar confirmação.</div>';
                                console.error(error);
                            });
                    }
                </script>


                <!-- Scripts -->
                <script>
                    function abrirModalEdicao(id) {
                        const modal = new bootstrap.Modal(document.getElementById('modalEdicao'));
                        document.getElementById('conteudoModalEdicao').innerHTML = '<p class="text-muted">Carregando...</p>';
                        modal.show();

                        fetch(`/radio/${id}/edit`)
                            .then(response => {
                                if (!response.ok) throw new Error('Erro ao carregar formulário');
                                return response.text();
                            })
                            .then(html => {
                                document.getElementById('conteudoModalEdicao').innerHTML = html;
                            })
                            .catch(error => {
                                document.getElementById('conteudoModalEdicao').innerHTML =
                                    '<div class="alert alert-danger">Erro ao carregar formulário.</div>';
                                console.error(error);
                            });
                    }
                </script>

                <script>
                    document.getElementById('buscaRadio').addEventListener('input', function() {
                        const termo = this.value.toLowerCase();
                        const linhas = document.querySelectorAll('#tabelaRadios tbody tr');

                        linhas.forEach(linha => {
                            const texto = linha.textContent.toLowerCase();
                            linha.style.display = texto.includes(termo) ? '' : 'none';
                        });
                    });
                </script>
            @endsection
