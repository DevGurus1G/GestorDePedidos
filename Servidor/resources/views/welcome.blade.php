<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/sass/app.scss', 'resources/js/app.js', "resources/js/cliente.js"])
        <title>Killer - Home</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Exo:400,700');

            *{
                margin: 0px;
                padding: 0px;
            }

            body{
                font-family: 'Exo', sans-serif;
            }


            .context {
                width: 100%;
                position: absolute;
                top:50vh;
                
            }

            .context h1{
                text-align: center;
                color: #fff;
                font-size: 50px;
            }


            .area{
                background: beige;  
                background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);  
                width: 100%;
                height:100vh;
                
            
            }

            .circles{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .circles li{
                position: absolute;
                display: block;
                list-style: none;
                width: 20px;
                height: 20px;
                background: rgba(25, 24, 24, 0.2);
                animation: animate 25s linear infinite;
                bottom: -150px;
                
            }

            .circles li:nth-child(1){
                left: 25%;
                width: 80px;
                height: 80px;
                animation-delay: 0s;
            }


            .circles li:nth-child(2){
                left: 10%;
                width: 20px;
                height: 20px;
                animation-delay: 2s;
                animation-duration: 12s;
            }

            .circles li:nth-child(3){
                left: 70%;
                width: 20px;
                height: 20px;
                animation-delay: 4s;
            }

            .circles li:nth-child(4){
                left: 40%;
                width: 60px;
                height: 60px;
                animation-delay: 0s;
                animation-duration: 18s;
            }

            .circles li:nth-child(5){
                left: 65%;
                width: 20px;
                height: 20px;
                animation-delay: 0s;
            }

            .circles li:nth-child(6){
                left: 75%;
                width: 110px;
                height: 110px;
                animation-delay: 3s;
            }

            .circles li:nth-child(7){
                left: 35%;
                width: 150px;
                height: 150px;
                animation-delay: 7s;
            }

            .circles li:nth-child(8){
                left: 50%;
                width: 25px;
                height: 25px;
                animation-delay: 15s;
                animation-duration: 45s;
            }

            .circles li:nth-child(9){
                left: 20%;
                width: 15px;
                height: 15px;
                animation-delay: 2s;
                animation-duration: 35s;
            }

            .circles li:nth-child(10){
                left: 85%;
                width: 150px;
                height: 150px;
                animation-delay: 0s;
                animation-duration: 11s;
            }



            @keyframes animate {

                0%{
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                    border-radius: 0;
                }

                100%{
                    transform: translateY(-1000px) rotate(720deg);
                    opacity: 0;
                    border-radius: 50%;
                }

            }
        </style>
    </head>
    <body>
        <div class="container-fluid g-0 overflow-hidden" style="background-color: beige">
            <div class="row">
                <div class="d-none d-lg-block  col-lg-6">
                    <img src="{{ url('img/foto_carousel_2.jfif') }}" class="object-fit-cover vh-100 rounded-end-5 w-100">
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">

                    <div class="area d-flex justify-content-center align-items-center" >
                        
                            <ul class="circles">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                            </ul>
                            <div class="card border-secondary" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-secondary">Bienvenido a Killer Cervezas</div>
                                <div class="card-body">
                                  <h5 class="card-title">¿Como quiere entrar?</h5>
                                  <p class="card-text">Clique en la opcion que necesite para loguearse.</p>
                                </div>
                                <div class="card-footer bg-transparent border-success d-flex justify-content-center gap-2">
                                    <a href="{{route("login")}}" class="btn btn-primary">Empleado</a>
                                    <div class="vr"></div>
                                    <a href="#" class="btn btn-primary">Cliente</a>
                                </div>
                            </div>
                    </div >
                </div>                                             
            </div>
        </div>
    </body>
</html>
