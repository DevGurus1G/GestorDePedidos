<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | KillerCervezas</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body>
    <div class="container min">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col" style="width: 100%; max-width: 550px">
                <div class="card shadow">
                    <div class="card-header text-white">Entrar en la Gestion de Pedidos</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="mb-3 row">
                                
                                <div class="col">
                                    <label for="email" class="form-label text-md-end">Correo electronico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-3 row">
                                
                                <div class="col">
                                    <label for="password" class="form-label text-md-end">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-3 row">
                                <div class="col d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Recuerdame
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            ¿Has olvidado tu contraseña?
                                        </a>
                                    @endif
                                </div>
                            </div>
    
                            <div class="mb-0 row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Entrar
                                    </button>
                                </div>
                                <div class="col-12 mt-3"> 
                                    <a href="{{route("register")}}" class="btn btn-outline-primary w-100">Registrarse</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

