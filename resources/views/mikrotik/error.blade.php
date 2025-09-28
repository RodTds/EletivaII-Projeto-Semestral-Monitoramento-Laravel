<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro de Conexão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container text-center">
        <div class="alert alert-danger shadow-lg p-5 rounded-3">
            <h1 class="mb-3">⚠️ Erro de Conexão</h1>
            <p class="lead">Não foi possível conectar à Mikrotik.</p>
            <p>Verifique se o servidor está ligado e acessível.</p>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">🔄 Tentar Novamente</a>
        </div>
    </div>
</body>
</html>
