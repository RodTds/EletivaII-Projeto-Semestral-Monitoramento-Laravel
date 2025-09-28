@extends('layout')

@section('conteudo')
<div class="container mt-5">
    <h2 class="text-center mb-4">Clientes PPPoE</h2>

    <!-- Campo de pesquisa -->
  <div class="mb-3">
    <label>Pesquisar</label>
    <input type="text" id="searchInput" 
           class="form-control form-control-sm w-25" 
           placeholder="Pesquisar por login...">
</div>


    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="clientesTable">
            <thead class="table-primary">
                <tr>
                    <th>Nome</th>
                    <th>Senha</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['password'] }}</td>
                        <td>{{ $user['profile'] }}</td>
                        <td>
                            @if($user['status'] === 'Online')
                                <span class="badge bg-success">Online</span>
                            @else
                                <span class="badge bg-danger">Offline</span>
                            @endif
                        </td>
                        <td>
                            @if($user['status'] === 'Online')
                                <a href="http://{{ $user['ip'] }}" target="_blank">{{ $user['ip'] }}</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Script para filtro -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#clientesTable tbody tr");

        rows.forEach(row => {
            let login = row.cells[0].textContent.toLowerCase(); // Coluna "Nome"
            if (login.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
@endsection
