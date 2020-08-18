
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sección</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>

</head>
<body> 
    <section class="section"> 
            <div class="container">
                <div class="columns">
                   <div class="column is-half
                        is-offset-one-quarter">
                        <p style="margin-left: 35%;">
                            <img class="is-rounded"src="/Imagenes/icon_user.png"  width="140px">
                        </p>
                        <div class="control has-icons-left">
                            <input class="input is-primary" type="text" placeholder="Nombre de usuario" name="txtUser"><br><br>
                            <span style ="background-image: url('../Imagenes/icon_username.png'); background-repeat: no-repeat; background-position: center;" class="icon is-small is-left">
                                <i lass="fas fa-envelope"></i>
                            </span> 
                        </div>

                        <div class="control has-icons-left">
                            <input  class="input is-primary"  type="password" placeholder="Contraseña" name="txtPass"><br><br>
                            <span style ="background-image: url('../Imagenes/icon_pass.png'); background-repeat: no-repeat; background-position: center;" class="icon is-small is-left">
                                <i lass="fas fa-envelope"></i>
                            </span>  
                        </div>
                        
                       <div style="margin-left: 30%;"> 
                        <a href="{{ route('cliente') }}" class="button is-outlined is-small is-success "> Crear cuenta </a>
                        <a href="{{ route('admin') }}" class="button is-outlined is-small is-danger "> Iniciar sección</a>
                      </div> 
                   </div>
                </div>
            </div>
    </section>
</body>
</html>