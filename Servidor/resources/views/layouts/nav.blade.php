@section("nav")
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{url("img/logo_empresa.png")}}" class="rounded-circle " width="48" height="48" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-2 ps-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route("home")}}">Home</a>
                </li>
                @can('isAdministrativo')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("clientes.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("clientes.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan

                @can('isComercial')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pedidos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("pedidos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("pedidos.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan

                @can('isAdministrativo')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("productos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("productos.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan

                @can('isAdministrativo')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("categorias.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("categorias.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan

                @can('isAdministrativo')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Formatos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("formatos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("formatos.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan

                @can('isAdministrativo')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos con formato
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("formatoproductos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("formatoproductos.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan
                @can('isResponsable')
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Clientes
                  </a>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route("clientes.index")}}">Consultar</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{route("clientes.create")}}">Crear</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pedidos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("pedidos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("pedidos.create")}}">Crear</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("productos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("productos.create")}}">Crear</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("categorias.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("categorias.create")}}">Crear</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Formatos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("formatos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("formatos.create")}}">Crear</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos con formato
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("formatoproductos.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("formatoproductos.create")}}">Crear</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route("users.index")}}">Consultar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route("users.create")}}">Crear</a></li>
                    </ul>
                </li>
                @endcan

            </ul>
            <div class=" d-none d-lg-flex nav item ">
                <hr>
                <div id="horaNavBar" style="font-size: 1.5em; color:white"></div>
                <hr>
                <script>
                    function mostrarHoraLocal() {
                        var fechaHora = new Date();
            
                        // Formato sin segundos
                        var opcionesDeFormato = { hour: 'numeric', minute: 'numeric' };
                        var hora = fechaHora.toLocaleTimeString(undefined, opcionesDeFormato);
                    
                        document.getElementById("horaNavBar").innerText = hora;
                    }
                
                    mostrarHoraLocal();
                
                    setInterval(mostrarHoraLocal, 60000);
                </script>
            </div>
            
            <div class="nav-item dropdown pb-2 pb-lg-0 ps-2 ps-lg-3 pe-lg-2">
                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end ">
                    <li><a class="dropdown-item" href="{{ route('perfil.index')}}">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{route("logout")}}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@endsection
