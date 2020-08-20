
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de compra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/orden.css"/>

</head>
<body>
    <section>
    <form action="orden.php" method="POST">    
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter" id="center">
                    <div id="id_head">
                        <img height='60px' width='50px' src="../Imagenes/show_info.png"><br>
                        <strong>Tienda Online de compras</strong><br><br>
                    </div>
                    
                    <div id="id_text"> 
                        <label >Producto comprado:  {{ $compra->nombre}}</label><br><br>
                        <label >Fecha de Compra:    {{ $compra->fecha_compra}} </label><br><br>
                        <label >Cantidad comprada:  {{ $compra->cantidad}} </label><br><br>
                        <label >Valor por unidad:  ₡{{ $compra->precio}}</label><br><br>
                        <label >Total pagado:      ₡{{ $compra->costo}}</label><br><br>
                        <label >Descripción:        {{ $compra->descripcion}}      </label><br><br>
                        <a href=" {{ route('cliente')}}"style="margin-left:30%;" class="button is-info" >Volver</a>
                    </div>    
                </div>
            </div>
        </div>
    </form>
    </section>
</body>
</html>
