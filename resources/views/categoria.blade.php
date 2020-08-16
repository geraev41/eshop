

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link   rel="stylesheet" href="../CSS/cantidad.css">
</head>
<body>
    <section>
    <form action="{{ route('guardar_categoria') }}" method="POST">
        @csrf
        <div class="container">
            <div class="columns">
                

                <div class="column is-half is-offset-one-quarter" id="idMain">
                    @if (session ('mensaje'))
                <div class="notification is-success is-small" >
                            <button class="delete"></button>
                            {{ session ('mensaje')}}
                        </div>
                    @endif
                    <img style="margin-left:35%;" src="../Imagenes/category.png">
                   <?php
                        $btnName = "btnAddCategoria"; 
                        $btnValue ="Guardar";
                       
                        $nombre = trim(isset($cat[0]->nombre)? ($cat[0]->nombre): "","");  

                   ?> 
                    <div class="column is-half is-offset-one-quarter">
                        <input type="text" value="" class="input is-primary" placeholder="Nombre categoria" name="categoria"><br><br>
                        <a href ="{{ route('admin')}}"style="margin-left:10%;"  class="button is-info d-inline" >Regresar</a>
                        <input  style="margin-left:10%;"type="submit" class="button is-success" value="<?php echo ("$btnValue");?>">

                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
</body>
</html>

