<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

</head>
<body>
    <section>
        
        <form method="post" action="{{ route('guardar_producto') }}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="columns">
                    <br><br>
                    <div class ="column is-half is-offset-one-quarter">
                        @if (session ('msj'))
                            <div id="#note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                {{session('msj')}}
                            </div>
                        @endif
                        @error('nombre')
                            <div id="#note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                Debe de escribir un nombre
                            </div>
                        @enderror
                        @error('descripcion')
                            <div id="#note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                Debe de escribir una descripcion

                            </div>
                        @enderror
                        @error('Image')
                            <div id="#note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                                Por favor elija una foto para el producto
                            </div>
                        @enderror
                        @error('stock')
                            <div id="#note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                               Debe de escribir una cantidad del stock
                            </div>
                        @enderror
                        @error('precio')
                            <div id="#note" class="notification is-danger" style="top:3%; height: 5%; font-size: 80%; 
                            text-align: center; padding-top: 1%">
                                <button class="delete"></button>
                               Digite un precio al producto
                            </div>
                        @enderror
                     

                        <input class="" style="visibility: hidden" value="{{ $id }}"name ="id_categoria" type="text">
                        <input class="input is-primary" placeholder="Nombre" name ="nombre" type="text"><br><br>
                        <input class="input is-primary" placeholder="Descripción" name ="descripcion" type="text"><br><br>
                        <div class="file" style="margin-left:35%;">
                            <label class="file-label">
                                <input class="file-input" type="file" name="Image">
                                <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                   Elija foto
                                </span>
                                </span>
                            </label>
                        </div>

                        <img height="600px" width="500px" src="" >
                        <br><br>
                        <input class="input is-primary" placeholder="Stock" name ="stock" type="text" ><br><br>
                        <input class="input is-primary" placeholder="Precio por unidad ₡" name ="precio" type="text"><br><br>
                        <div style = "margin-left:32%;">
                            <a href="{{ route('admin')}}" class="button is-info">Regresar</a>
                            <input class="button is-success" value="Guardar" type="submit">
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