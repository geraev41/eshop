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
             @if (!empty ($msj))
             <div id="note"class="notification is-success" style="top:3%; height: 5%; font-size: 80%; 
              padding-top: 5%">
                 {{$msj }}
             </div>
            @endif
            <br>
            <ul class="menu-list"> 
                <li><a id="aList" href="{{ route('mostrar_categorias','principal')}}#divProductos" >Productos</a></li> 
                <li><a id="aList" href="{{ route('ver_productos')}}#divCarrito" >Mi carrito</a></li> 
                <li><a id="aList" href="{{ route('ver_compras')}}#divCompras" >Mis compras</a></li>
            <ul>
            <form action="{{ route('salir')}}" method="POST"> 
                @csrf
            <input class="button is-outlined is-small is-danger is-rounded" type="submit" value="Salir">
            </form>
        </div>
        <div id="divRight">
            <div id="divProductos">
                <a href="{{ route('mostrar_categorias','principal')}}">Todas las categorias</a>
            <br> 
                <div class="field" style="margin-left:25%;">
                    <div class="control">
                        <div class="select is-info ">
                            <form method="POST" action="{{route('cargar_producto')}}#divProductos">
                                @csrf

                                <input type="text" name="view" value="principal" style="display: none;">
                            <select name="select"  onchange="this.form.submit()">
                                <option selected disabled>Selecione una categoria</option>
                                @if (!empty($result['categorias']))
                                    @foreach ($result['categorias'] as $c)
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
                        @if (!empty($result['productos']))
                        @foreach ($result['productos'] as $p)
                            <tr>
                                <td><img with="60px" height="50px" src="images/{{$p->imagen}}"></td> 
                                <td>{{$p->nombre}}</td> 
                                <td>{{$p->descripcion}}</td>
                                <td>{{$p->stock}}</td> 
                                <td>{{$p->precio}}</td> 
                                <td><a class="button is-success is-active is-small" href="{{ route('agregar_producto',$p->id)}}">Agregar a carrito</a></td>  
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
                        @if (!empty($result['pros']))
                            @foreach ($result['pros'] as $p)
                                <tr>
                                    <td>{{$p->nombre}}</td>
                                    <td>{{$p->descripcion}}</td>
                                    <td><img src='images/{{ $p->imagen }}'/></td>
                                    <td>{{ $p->stock}}</td>
                                    <td> ₡{{ $p->precio}}</td>
                                    @foreach ($result['carro'] as $c)
                                        @if ($c->id_producto == $p->id)
                                            <td> {{ $c->cantidad }}</td>
                                            <td>₡{{ $c->valor}}</td>
                                            <td>
                                                <form action="{{ route('eliminar_pr_carro',$c->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="button is-small is-danger is-active" type="submit" value="Decartar">
                                                </form>  
                                            </td>
                                            <td><a class="button is-success is-active is-small" href="{{route('editar_carro',$c->id)}}">Hacer cambios</a></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                </tbody>
             </table><br> 
            <label>Total a pagar<?php $total = 0;?> 
                @if(!empty($result['carro']))
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
           <div  style="margin: auto"> 
           <form action="/ver_orde_fecha#divCompras" method="POST">
                @csrf
                <h2>Sus compras realizadas</h2>
                <input class="button is-small is-hovered" type="date" name="fecha"> 
                <button style="background-image: url('Imagenes/search.png'); 
                    background-repeat: no-repeat; 
                    background-position: left center; 
                    width:80px;"  class="button is-small is-hovered" type="submit"> buscar</button>
                <a class="button is-small is-hovered"href="/ver_compras#divCompras">ver todo</a>
            </form>
           </div>
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
                    <?php  ?>
                    @if(!empty($compras))
                        @foreach($compras as $c)
                            <tr>
                                <td><img height='60px' width='50px'src='images/{{$c->imagen}}'/></td>
                                <td>{{$c->nombre}}</td>
                                <td>{{$c->created_at}}</td>
                                <td>{{$c->cantidad}}</td>
                                <td>{{$c->descripcion}}</td>
                                <td>₡{{$c->precio}}</td>
                                <td>₡{{$c->costo}}</td>
                                <td>
                                    <form action="{{ route('eliminar_compra',$c->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="button is-small is-danger is-active"type="submit" value="Quitar">
                                    </form>
                                </td>
                                <td><a class="button is-success is-active is-small" href="{{ route('ver_orden', $c->id)}}"> Ver detalles</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>   
        </div>
    </div>
</section>
<script>
    $('#note').fadeOut(4000);
</script>
</body>
</html>

