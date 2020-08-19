
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sección</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body> 
    <section class="section"> 
        <form action="{{ route('validar_login')}}" method="POST"> 
            @csrf
            <div class="container">
                <div class="columns">
                   <div class="column is-half
                        is-offset-one-quarter">
                        @error('username')
                            <div id="note1" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                Usuario requerido
                            </div>
                        @enderror
                        @error('password')
                            <div id="note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                Debe de ingresar su contraseña
                            </div>
                        @enderror
                        <p style="margin-left: 35%;">
                            <img class="is-rounded"src="/Imagenes/icon_user.png"  width="140px">
                        </p>
                        <div class="control has-icons-left">
                            <input class="input is-primary" type="text" placeholder="Nombre de usuario" name="username"><br><br>
                            <span style ="background-image: url('../Imagenes/icon_username.png'); background-repeat: no-repeat; background-position: center;" class="icon is-small is-left">
                                <i lass="fas fa-envelope"></i>
                            </span> 
                        </div>

                        <div class="control has-icons-left">
                            <input  class="input is-primary"  type="password" placeholder="Contraseña" name="password"><br><br>
                            <span style ="background-image: url('../Imagenes/icon_pass.png'); background-repeat: no-repeat; background-position: center;" class="icon is-small is-left">
                                <i lass="fas fa-envelope"></i>
                            </span>  
                        </div>
                        
                       <div style="margin-left: 30%;"> 
                        <a href="{{ route('registro') }}" class="button is-outlined is-small is-success "> Crear cuenta </a>
                        <input class="button is-outlined is-small is-danger" value="Iniciar sección" type="submit">
                      </div> 
                   </div>
                </div>
            </div>
        </form> 
    </section>
    <script>
        $('#note1').fadeOut(4000);
        $('#note').fadeOut(4000);
    </script>
</body>
</html>