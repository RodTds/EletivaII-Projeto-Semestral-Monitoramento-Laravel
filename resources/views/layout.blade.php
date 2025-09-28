<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Monitoramento')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f8f8f8;
    }
.thead-sidebar {
  background-color: #1a2630;
  color: #ffffff;
}

    .sidebar {
      background-color: #1a2630;
      color: #50b948;
      height: 100vh;
      padding: 20px;
      min-width: 220px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar h1 {
      font-weight: 700;
      font-size: 20px;
      margin-bottom: 1.5rem;
    }

    .sidebar h2 {
      font-weight: 700;
      font-size: 14px;
      background-color: #009f4d;
      padding: 4px 8px;
      border-radius: 4px;
      margin-bottom: 2rem;
      color: white;
      display: inline-block;
    }

    .menu-item {
      font-weight: 700;
      color: #d4d4d4;
      cursor: pointer;
      padding: 10px 15px;
      display: flex;
      align-items: center;
      text-decoration: none;
      user-select: none;
      margin-bottom: 1.5rem;
      gap: 0.5rem;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .menu-item:hover {
      background-color: #50b948;
      color: white;
      text-decoration: none;
    }

    .icon-blue {
      color: #0d6efd;
      font-size: 1.2em;
    }

    .btn-atualizar {
      background-color: #2d7c2d;
      border: none;
      color: white;
      font-weight: 600;
      padding: 6px 24px;
      border-radius: 4px;
      cursor: pointer;
      align-self: center;
      min-width: 120px;
      transition: background-color 0.3s ease;
      text-align: center;
      user-select: none;
      display: inline-block;
    }

    .btn-atualizar:hover {
      background-color: #1f541f;
      color: white;
      text-decoration: none;
    }

  </style>
</head>
<body>
  <div class="d-flex">
    <nav class="sidebar d-flex flex-column">
      <div class="menu">
        <h1>Telecom Net</h1>
        <h2>Monitoramento</h2>

        <a href="{{ route('radio.index') }}" class="menu-item">📊 Estado da Rede</a>
        <a href="{{ route('radio.create') }}" class="menu-item">📶 Radio</a>
        <a href="{{ route('ptp.create') }}" class="menu-item">🌐 PTP</a>
        <a href="{{ route('pppoe') }}" class="menu-item"><i class="bi bi-person-fill icon-blue"></i> Clientes PPPoE</a>

        <!-- Reinicializar -->
        <a href="#" class="menu-item">↻ Reinicializar o Sistema</a>
      </div>

      <!-- Botão atualizar -->
      <button class="btn-atualizar" type="button">Atualizar</button>
    </nav>

    <!-- Área de conteúdo -->
    <main class="flex-grow-1 p-4">
      @yield('conteudo')
    </main>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>
