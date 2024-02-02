<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @vite(['resources/sass/app.scss', 'resources/js/app.js', "resources/js/cliente.js"])
  <script src="{{url("js/cliente.js")}}" defer></script>
  <script src="{{url("js/select.js")}}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8" defer></script>
  <title>Killer Cervezas</title>
</head>
<body>

<div class="container-fluid overflow-hidden min-vh-100 flex-grow-1 " id="wrapper">
    <div class="row d-flex">
        <div class="col" id="content">
            <!-- Contenido de la página -->
                <div class="row">
                    @yield("nav")
                </div>
                <div class="row">
                <!-- Contenido de la página aquí -->
                  @yield("content")
                </div>
        </div>
    </div>
</div>
</body>
</html>
