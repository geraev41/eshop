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
    <form action="{{ route('update_categoria', $cat->id) }}" method="POST">
        @method('PUT')
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

                    <div class="column is-half is-offset-one-quarter">
                    <input type="text" value="{{$cat->nombre}}" class="input is-primary" placeholder="Nombre categoria" name="categoria"><br><br>
                        <a href ="{{ route('admin')}}"style="margin-left:10%;"  class="button is-info d-inline" >Regresar</a>
                    <input  style="margin-left:10%;"type="submit" class="button is-success" value="Editar">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
</body>
</html>

