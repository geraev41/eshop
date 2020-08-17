
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/admin.css"/>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

</head>
<body>
    <section>
            <div id="container">    
                <div id="divLeft">
                    @if (!empty ($msj))
                        <div id="note"class="notification is-success" style="top:3%; height: 5%; font-size: 80%; 
                         padding-top: 5%">
                            {{$msj }}
                        </div>
                    @endif
                    <br><br>
                    <label></label>
                    <ul class="menu-list"> 
                        <li><a id="aList" href="/ver_categorias#divCategorias ">Categorias</a> </li>
                        <li><a id="aList" href="#divProductos" >Productos</a></li>
                        <li><a id="aList" href="/ver_clientes#divClientes" >Clientes</a></li>
                        <li><a id="aList" href="#divGanancias" >Mis ganancias</a></li>

                    <ul>
                    <a href ="../logicaDatos/logout.php"id="idBtn" class="button is-outlined is-small is-danger">Cerrar Sección<a>
                </div>

                <div id="divRight">
                    <div id="divCategorias">

                        <a href="{{ route('mostrar_categorias')}}">Todas las categorias</a>
                        <table class="table">
                            <tr> 
                                <th>Nombre Categoria</th>
                                <th>Agregar Producto</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            <tbody> 
                               
                                @if(!empty($categorias))
                                    @foreach ($categorias as $c)
                                        <tr>
                                            <td>{{$c->nombre}}</td> 
                                            <td><a href="{{ route('producto',$c->id) }}">Agregar producto</a></td>                                        
                                            <td><a href="{{ route('editar_categoria',$c) }}">Editar</a></td>  
                                                                                  
                                            <td>
                                                <form action="{{ route ('eliminar_categoria',$c)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="" type="submit">Eliminar</button>
                                                </form>
                                            </td>                                        
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>                          
                        </table>     
                    <a href="{{ route('crear_categoria')}}" style="margin-left:5%;" class="button is-outlined is-small is-danger ">Agregar Nueva Categoria</a><br><br>
                    </div>
                    <div id="divProductos">
                        <br>
                        <div class="field">
                            <div class="control">
                                <div class="select is-info ">
                                <form method="POST" action="{{route('cargar_producto')}}">
                                    @csrf
                                    <select name="select"  onchange="this.form.submit()">
                                        <option selected disabled>Selecione una categoria    </option>
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
                                <th>Vendidos</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            <tbody>
                                @if (!empty($productos))
                                <?php// var_dump($productos);die;?>

                                    @foreach ($productos as $p)
                                        <tr>
                                            <td><img with="60px" height="50px" src="images/{{ $p->imagen}}"></td> 
                                            <td>{{$p->nombre}}</td> 
                                            <td>{{$p->descripcion}}</td>
                                            <td>{{$p->stock}}</td> 
                                            <td>{{$p->precio}}</td> 
                                            <td>{{$p->vendidos}}</td> 
                                            <td><a href="{{ route('editar_producto',$p->id)}}">Editar</a></td>  
                                            <td>
                                                <form action="{{ route ('eliminar_producto',$p)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="" type="submit">Eliminar</button>
                                                </form>
                                            </td>                                        
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table> 
                    </div>
                    <div id="divClientes">
                        <table class ="table">
                            <tr> 
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                            </tr>
                            <tbody>
                               @if (!empty($users))
                                   @foreach ($users as $u)
                                    <tr>
                                        <td>{{ $u->nombre }}</td> 
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->telefono }}</td>
                                        <td>{{ $u->direcion }}</td>
                                    <tr>
                                   @endforeach
                               @endif
                            </tbody>
                        </table>
                    </div>
                    <div id="divGanancias">

                       <strong> Sus ganancias por todas las ventas </strong>  
                                    <?php
                                       //ganancias
                                    ?>
                    </div>
                </div>
            </div>
    </section>
    <script type="text/javascript">
        /**
        * id del producto a eliminar
        * confirma si quiere realmente eliminar un producto
         */
        function eliminar(id){
            if(confirm("¿Realmente esta seguro de querer eliminar este producto?")){
                window.location.href= ""; 
            }
        }
        /**
        * id del producto a eliminar
        * confirma si quiere realmente eliminar una categoria
         */
        function eliminarCat(id){
            if(confirm("¿Realmente esta seguro de querer eliminar esta categoria?")){
                window.location.href= ""; 
            }
        }
    </script>
    <script>
        $('#note').fadeOut(4000);
    </script>
</body>
</html>
