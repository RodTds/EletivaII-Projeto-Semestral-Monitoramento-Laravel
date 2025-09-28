@extends('layout')
@section('conteudo')

<h2>PTPs</h2>

@if(session('sucesso'))
  <p class="text-success">{{ session('sucesso') }}</p>
@endif

@if(session('erro'))
  <p class="text-danger">{{ session('erro') }}</p>
@endif

<a href="/ptp/create" class="btn btn-success mb-3">Novo Registro</a>

<table class="table table-hover table-striped">
  <thead class="thead-sidebar"> <!-- ✅ Alterado aqui -->
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Endereço</th>
      <th>Responsável</th>
      <th>Telefone</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($ptps as $c)
      <tr>
        <td>{{ $c->id }}</td>
        <td>{{ $c->nome }}</td>
        <td>{{ $c->descricao }}</td>
        <td>{{ $c->endereco }}</td>
        <td>{{ $c->responsavel }}</td>
        <td>{{ $c->telefone }}</td>
        <td class="d-flex gap-2">
          <a href="#" class="btn btn-sm btn-success">Editar</a> <!-- ✅ Verde -->
          <a href="#" class="btn btn-sm btn-info">Consultar</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection
