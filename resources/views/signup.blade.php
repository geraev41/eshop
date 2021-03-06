<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creando una cuenta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>

</head>
<body>
    <section class="section">
    <form method="POST" action="{{ route('register') }}">
        @csrf
            <div class="container">
                <div class="columns"> 
                    <div class="column">
                        <div class="column is-half
                        is-offset-one-quarter">
                        @error('username')
                            <div id="note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                Ya existe un usuario registrado con este nombre de usuario
                            </div>
                        @enderror
                             <input REQUIRED class="input is-primary" type="text" placeholder="Nombre"  name="nombre"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Cedula"  name="cedula"><br><br>
                             <input REQUIRED  class="input is-primary" type="text" placeholder="Correo Eletronico"  name="email"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Télefono"  name="telefono"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Direcion"  name="direcion"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Nombre de usuario"  name="username"><br><br>
                             <input REQUIRED class="input is-primary" type="password" placeholder="Contraseña"  name="password"><br><br>
                            <div style="margin-left: 38%">  
                                <a href="{{ route('login') }}" class="button is-small is-success">Regresar</a>
                                <input  class="button is-small is-danger " value="Guardar" name="btnGuardar" type="submit">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section> 
    <script>
        $('#note').fadeOut(4000);
    </script>
</body>
</html>
<?php