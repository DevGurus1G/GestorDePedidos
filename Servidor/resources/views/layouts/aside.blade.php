@section('aside')
<div class="d-flex flex-column p-3 text-bg-dark min-vh-100 col-3 d-none " id="sidebar">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link active" aria-current="page">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" viewBox="0 0 24 24" class="bi pe-none me-2"><path fill="#ffffff" d="m12 3l8 6v12h-5v-7H9v7H4V9z"/></svg>
          Home
        </a>
      </li>
      <hr>
      {{-- Comercial --}}
      <li class="nav-item dropdown">
        <a class="w-100 text-start btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Pedidos
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('pedidos.create') }}">Crear</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="{{ route('pedidos.index')}}">Consultar</a></li>
        </ul>
      </li>
      <hr>
      {{-- Administrativos --}}
      <li class="nav-item dropdown">
        <a class="w-100 text-start btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Productos
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route('productos.create')}}">Crear</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="{{ route('productos.index')}}">Consultar</a></li>
        </ul>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="w-100 text-start btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Clientes
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('clientes.create')}}">Crear</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="{{ route('clientes.index')}}">Consultar</a></li>
        </ul>
      </li>
      <hr>
      <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Estadisticas
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
  </div>
@endsection
