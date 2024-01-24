<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @vite(['resources/sass/app.scss', 'resources/js/app.js', "resources/js/cliente.js"])
  <script src="{{url("js/cliente.js")}}" defer></script>
  <title>Killer Cervezas</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    #sidebar {
      /* width: 250px; */
      /* position: fixed;
      top: 0;
      left: -250px; */
      flex: 0 0 0;
      opacity: 0;
      /* background-color: #343a40; */
      transition: all 0.3s;
    } 

     #sidebar.show {
      flex-grow: 1;
      opacity: 1;
    }

     #content {
      flex-grow: 1
      transition: all 3s;
    }

    .navbar-light .navbar-nav .nav-link.active svg {
    fill: #fff; /* Cambia el color a blanco */
  }

    

  </style>
</head>
<body>

<div class="container-fluid overflow-hidden min-vh-100 flex-grow-1 " id="wrapper">
    <div class="row d-flex">
        @yield("aside")
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');
    var menuToggle = document.getElementById('menu-toggle');

    menuToggle.addEventListener('click', function () {
      sidebar.classList.toggle('show');
      sidebar.classList.toggle('d-none');
      content.classList.toggle('col');
      content.classList.toggle('col-9');
    });
  });
</script>

</body>
</html>
