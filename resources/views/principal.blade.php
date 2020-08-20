<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/principal.css"/>

</head>
<body>
    <section> 
        <div id="container">   
        <div id="divLeft"><br>
            <label> {{ Auth::user()
            ->nombre}} </label>  
            <br>
            <ul class="menu-list"> 
                <li><a id="aList" href="#divProductos" >Productos</a></li> 
                <li><a id="aList" href="productos_en_carro#divCarrito" >Mi carrito</a></li> 
                <li><a id="aList" href="ver_compras#divCompras" >Mis compras</a></li>
            <ul>
            <form action="{{ route('salir')}}" method="POST"> 
                @csrf
            <input class="button is-outlined is-small is-danger is-rounded" type="submit" value="Salir">
            </form>
        </div>
        <div id="divRight">
            <div id="divProductos">
                <a href="{{ route('mostrar_categorias')}}">Todas las categorias</a>
            <br> 
                <div class="field" style="margin-left:25%;">
                    <div class="control">
                        <div class="select is-info ">
                            <form method="POST" action="{{route('cargar_producto')}}">
                                @csrf

                                <input type="text" name="view" value="principal" style="display: none;">
                            <select name="select"  onchange="this.form.submit()">
                                <option selected disabled>Selecione una categoria</option>
                                @if (!empty($categorias))
                                    @foreach ($categorias as $c)
                                        <option value="{{$c->id}}">{{$c->nombre}}</option>
                                    @endforeach
                                @endif
                            </select>  
                            </form> 
                        </div>
                    </div>
                </div> 
                <table class="table">
                    <tr> 
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Aciones</th>
                    <th style='visibility: hidden;'>id</th>
                    </tr>
                    <tbody>
                        @if (!empty($productos))
                        @foreach ($productos as $p)
                            <tr>
                                <td><img with="60px" height="50px" src="images/{{ $p->imagen}}"></td> 
                                <td>{{$p->nombre}}</td> 
                                <td>{{$p->descripcion}}</td>
                                <td>{{$p->stock}}</td> 
                                <td>{{$p->precio}}</td> 
                                <td><a href="{{ route('agregar_producto',$p->id)}}">Agregar a carrito</a></td>  
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table> 
            </div>
            <div id="divCarrito">
                <table class="table">
                    <tr> 
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>cantidad</th>
                        <th>Costo</th>
                        <th>Eliminar</th>
                        <th>Confirmar Cambios</th>
                    </tr>
                    <tbody>
                        @if (!empty($result))
                            @foreach ($result['pros'] as $p)
                                <tr>
                                    <td>{{$p->nombre}}</td>
                                    <td>{{$p->descripcion}}</td>
                                    <td><img src='images/{{ $p->imagen }}'/></td>
                                    <td>{{ $p->stock}}</td>
                                    <td> {{ $p->precio}}</td>
                                    @foreach ($result['carro'] as $c)
                                        @if ($c->id_producto == $p->id)
                                            <td> {{ $c->cantidad }}</td>
                                            <td>₡{{ $c->valor}}</td>
                                            <td>
                                                <form action="{{ route('eliminar_pr_carro',$c->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Decartar">
                                                </form>  
                                            </td>
                                            <td><a href="{{route('editar_carro',$c->id)}}">Hacer cambios</a></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                </tbody>
             </table><br> 
            <label>Total a pagar<?php $total = 0;?> 
                @if(!empty($result))
                    @foreach ($result['carro'] as $c)
                        <?php $total = $c->valor + $total;?>
                    @endforeach
                    ₡{{ $total}}
                @endif
            </label>
            <a href="{{ route('pagar_compras')}}" style="left:4%;" class="button is-outlined is-small is-danger">Pagar</a>
        </div>
        </div>
        <div id="divCompras">
            <h2>Sus compras realizadas</h2>
            <table class="table"  style="width:'500px';">
                <tr> 
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Fecha de compra</th>
                    <th>Cantidad comprada</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Pagó</th>
                    <th>Quitar</th> 
                    <th>Ver orden</th> 

                </tr>
                <tbody>
                    @if(!empty($compras))
                        @foreach($compras as $c)
                            <tr>
                                <td><img height='60px' width='50px'src='images/{{$c->imagen}}'/></td>
                                <td>{{$c->nombre}}</td>
                                <td>{{$c->fecha_compra}}</td>
                                <td>{{$c->cantidad}}</td>
                                <td>{{$c->descripcion}}</td>
                                <td>₡{{$c->precio}}</td>
                                <td>₡{{$c->costo}}</td>
                                <td><a href =''>Quitar</a></td>
                                <td><a href="{{ route('ver_orden', $c->id)}}"> Ver detalles</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>   
        </div>
    </div>
</section>
</body>
</html>

