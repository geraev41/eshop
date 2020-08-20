<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantidad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
   <link   rel="stylesheet" href="../CSS/cantidad.css">
</head>
<body>
    <form action="{{ route('update_carro', $result['carro']->id)}}" method="POST"> 
        @csrf
        @method('PUT')
    <section>
        <div class="container">
            <div class="columns">
               <div id="idCenter" class = "column is-half
                is-offset-one-quarter"><br><br>
                <div class = "column is-half
                is-offset-one-quarter">

                <label>Producto {{ $result['p']->nombre}}</label><br>
                   <label>Cantidad disponible {{ $result['p']->stock}}</label><br>
                   <label>Precio por unidad ₡{{ $result['p']->precio}}</label><br><br>
                    <input type="number" name="cantidad" min="1"  max="{{ $result['p']->stock }}" value="{{ $result['carro']->cantidad}}"><br><br>
                   <label>Costo (Sin guardar cambios) ₡{{ $result['carro']->valor}}</label><br><br>
                   <input class="button is-outlined is-small is-danger is-rounded"type="submit" value="Guardar Cambios"><br><br>
                   <a href="{{ route('cliente') }}" class="button is-outlined is-small is-danger is-rounded">Regresar</a><br><br>
                </div>
               </div>
            </div>
        </div>
    </section>
</form> 
</body>
</html>