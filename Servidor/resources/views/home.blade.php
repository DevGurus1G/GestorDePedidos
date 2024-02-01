@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@endsection

@section('content')
<div class="col-12 col-lg-9 min-h-100">
    <div class="row">
        <div class="col-12" id="bienvenida">
            <div class="card mt-3 min-h-100">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h3><strong>Bienvenido {{Auth::user()->name}}, esta es la web de Gestión de Killer</strong></h3>
                </div>
                <div class="card-body">
                  <p>Este panel esta diseñado para realizar todas las tareas correspondientes a tu rol de {{ Auth::user()->rol}}. 
                    Podras realizar todo tipo de gestión sobre la base de datos que se te tenga permitida, 
                    asi como consultas y seguimiento de las diferentes caracteristicas a las que se te haya autorizado. <br>
                    ¡Que tengas un buen dia!
                </p> 
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-3" id="HoraMadrid">
            <div class="card mt-3 text-center mx-auto">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h3><strong>Madrid</strong></h3>
                </div>
                    <div class="card-body">
                        <hr>
                        <div id="horaLocal" class="text-bold" style="font-size: 2em"></div>
                        <hr>
                    <script>
                        function mostrarHoraLocal() {

                            var fechaHora = new Date();

                            var hora = fechaHora.toLocaleTimeString();
                        
                            document.getElementById("horaLocal").innerText = hora;
                        }
                    
                        mostrarHoraLocal();
                    
                        setInterval(mostrarHoraLocal, 1000);
                    </script>
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-3" id="HoraLondres">
            <div class="card mt-3 text-center mx-auto">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h3><strong>Londres</strong></h3>
                </div>
                <div class="card-body">
                    <hr>
                    <div id="horaLondres" class="text-bold" style="font-size: 2em"></div>
                    <hr>
                    <script>
                        function mostrarHoraLondres() {
                            var horaLondres = new Date().toLocaleTimeString('en-US', { timeZone: 'Europe/London', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
        
                            document.getElementById("horaLondres").innerText = horaLondres;
                        }
        
                        mostrarHoraLondres();
        
                        setInterval(mostrarHoraLondres, 1000);
                    </script>
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-3" id="HoraJapon">
            <div class="card mt-3 text-center mx-auto">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h3><strong>Japón</strong></h3>
                </div>
                <div class="card-body">
                    <hr>
                    <div id="horaJapon" class="text-bold" style="font-size: 2em"></div>
                    <hr>
                    
                    <script>
                        // Función para obtener y actualizar solo la hora local de Japón
                        function mostrarHoraJapon() {
                            // Obtener la hora actual en Japón (zona horaria GMT+9)
                            var horaJapon = new Date().toLocaleTimeString('ja-JP', { timeZone: 'Asia/Tokyo', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
        
                            // Mostrar solo la hora de Japón en el elemento con el ID "horaJapon"
                            document.getElementById("horaJapon").innerText = horaJapon;
                        }
        
                        // Llamar a la función inicialmente
                        mostrarHoraJapon();
        
                        // Actualizar la hora cada segundo (1000 milisegundos)
                        setInterval(mostrarHoraJapon, 1000);
                    </script>
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-3" id="HoraEstadosUnidos">
            <div class="card mt-3 text-center mx-auto">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h3><strong>USA</strong></h3>
                </div>
                <div class="card-body">
                    <hr>
                    <div id="horaEstadosUnidos" class="text-bold" style="font-size: 2em"></div>
                    <hr>
                    <script>
                        function mostrarHoraEstadosUnidos() {

                            var horaEstadosUnidos = new Date().toLocaleTimeString('en-US', { timeZone: 'America/New_York', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
        
                            document.getElementById("horaEstadosUnidos").innerText = horaEstadosUnidos;
                        }
        
                        mostrarHoraEstadosUnidos();
        
                        setInterval(mostrarHoraEstadosUnidos, 1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none d-lg-block col-lg-3" id="viajeRapido">
    <div class="card mt-3 text-center mx-auto">
        <div class="card-header d-flex justify-content-center align-items-center">
            <h3><strong>Panel rápido - {{ ucfirst(Auth::user()->rol) }}</strong></h3>
        </div>
        <div class="card-body">
            @switch(Auth::user()->rol)
                @case('comercial')
                    <p><a href="{{ route('pedidos.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Pedidos</a></p>
                    <p><a href="{{route('pedidos.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Pedidos</a></p>
                    @break

                @case('administrativo')
                    <p><a href="{{ route('clientes.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Clientes</a></p>
                    <p><a href="{{route('clientes.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Clientes</a></p>
                    <hr>
                    <p><a href="{{ route('productos.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Productos</a></p>
                    <p><a href="{{route('productos.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Productos</a></p>
                    <hr>
                    <p><a href="{{ route('categorias.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Categorias</a></p>
                    <p><a href="{{route('categorias.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Categorias</a></p>   
                    @break

                @case('responsable')
                    <p><a href="{{ route('pedidos.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Pedidos</a></p>
                    <p><a href="{{route('pedidos.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Pedidos</a></p>
                    <hr>
                    <p><a href="{{ route('clientes.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Clientes</a></p>
                    <p><a href="{{route('clientes.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Clientes</a></p>
                    <hr>
                    <p><a href="{{ route('productos.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Productos</a></p>
                    <p><a href="{{route('productos.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Productos</a></p>
                    <hr>
                    <p><a href="{{ route('users.index')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Consultar Usuarios</a></p>
                    <p><a href="{{route('users.create')}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Crear Usuarios</a></p>  
                    @break
                @default
                    
            @endswitch
            
        </div>
    </div>
</div>


</div>
@switch(Auth::user()->rol)
    @case('comercial')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3" id="solicitado">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Pedidos Solicitados</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" >
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($pedidosSolicitados))
                                        @foreach ($pedidosSolicitados as $pedido)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('pedidos.show', $pedido)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$pedido->id}}</a></p>
                                            </td>
                                            <td>
                                                {{$pedido->cliente->nombre}} - {{$pedido->cliente->dni}}
                                            </td>
                                            <td>
                                                <p>Solicitado</p>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay pedidos</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" id="en_preparacion">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Pedidos en Preparación</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" >
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($pedidosEnPreparacion))
                                        @foreach ($pedidosEnPreparacion as $pedido)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('pedidos.show', $pedido)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$pedido->id}}</a></p>
                                            <td>
                                                {{$pedido->cliente->nombre}} - {{$pedido->cliente->dni}}
                                            </td>
                                            <td>
                                                <p>En Preparación</p>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay pedidos</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" id="en_entrega">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Pedidos en Entrega</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" > 
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($pedidosEnEntrega))
                                        @foreach ($pedidosEnEntrega as $pedido)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('pedidos.show', $pedido)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$pedido->id}}</a></p>
                                            </td>
                                            <td>
                                                {{$pedido->cliente->nombre}} - {{$pedido->cliente->dni}}
                                            </td>
                                            <td>
                                                <p>En Entrega</p>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay pedidos</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" id="entregado">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Pedidos Entregados</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" > 
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($pedidosEntregados))
                                        @foreach ($pedidosEntregados as $pedido)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('pedidos.show', $pedido)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$pedido->id}}</a></p>
                                            </td>
                                            <td>
                                                {{$pedido->cliente->nombre}} - {{$pedido->cliente->dni}}
                                            </td>
                                            <td>
                                                <p>Entregado</p>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay pedidos</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @break
    @case('administrativo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4" id="clientes">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Clientes</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" >
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>DNI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($clientes))
                                        @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('clientes.show', $cliente)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$cliente->id}}</a></p>
                                            </td>
                                            <td>
                                                {{$cliente->nombre}}
                                            </td>
                                            <td>
                                                <p>{{$cliente->dni}}</p>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay clientes</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4" id="productosFormatos">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Productos</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" >
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Categoria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($productos))
                                        @foreach ($productos as $producto)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('productos.show', $producto)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$producto->id}}</a></p>
                                            <td>
                                                {{$producto->producto->nombre}} - {{$producto->formato->tipo}}
                                            </td>
                                            <td>
                                                {{$producto->producto->categoria->nombre}}
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay productos</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4" id="categorias">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Categorias</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;" > 
                            <table class="table table-responsive table-hover ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Categoria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($categorias))
                                        @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>
                                                <p><a href="{{ route('categorias.show', $categoria)}}" class="link-secondary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">{{$categoria->id}}</a></p>
                                            </td>
                                            <td>
                                                {{$categoria->nombre}}
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No hay categorias</td>
                                        </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @break
    @case('responsable')
        <div class="row mb-3">
            <div class="col-12 d-lg-block col-lg-4" id="PedidoProducto">
                <div class="card mt-3 text-center mx-auto">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Pedido - Producto</strong></h3>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        
                        {!! $chartPP->container() !!}
                        

                    </div>
                </div>
            </div>
            <div class="col-12 d-lg-block col-lg-4" id="IngresoMes">
                <div class="card mt-3 text-center mx-auto">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Ingreso - Mes</strong></h3>
                    </div>
                    <div class="card-body">
                        {!! $chartIM->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-12 d-lg-block col-lg-4" id="PedidoMes">
                <div class="card mt-3 text-center mx-auto">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3><strong>Pedido - Mes</strong></h3>
                    </div>
                    <div class="card-body">
                        {!! $chartPM->container() !!}
                    </div>
                </div>
            </div>
        </div>
        {!! $chartPP->script() !!}
        {!! $chartIM->script() !!}
        {!! $chartPM->script() !!}
        @break
    @default
        Error: rol no asignado.
@endswitch

@endsection