<?php
    session_start(); 
    if($_SESSION && $_SESSION['user']) {
        $user = new User();
        $user = unserialize($_SESSION['user']);
        if($user->tipo != "ad"){
        }
    }else{
    } 

    /**
     * obtiene un mensaje del url para mostrar un mensaje
     */
    if(isset($_GET['message'])){ 
        switch ($_GET['message']) {
            case 'error prod':
                    alert ("No puede eliminar una categoria con productos asociados");
                break;
            case 'eliminó':
                alert ("Se elimino con exitó!");
                break;
            default:
                # code...
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/admin.css"/>

</head>
<body>
    <section>
            <div id="container">    
                <div id="divLeft">
                    <br><br>
                    <label></label>
                    <ul class="menu-list"> 
                        <li><a id="aList" href="#divCategorias ">Categorias</a> </li>
                        <li><a id="aList" href="#divProductos" >Productos</a></li>
                        <li><a id="aList" href="#divClientes" >Clientes</a></li>
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
                                            <td><a href="#">Agregar producto</a></td>                                        
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
                                    <select name="select"  onchange="this.form.submit()">
                                        <option selected disabled>Selecione una categoria    </option>
                                            <?php
                                                //categorias cmbx
                                            ?>

                                    </select>  
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
                                <?php
                                    //Productos
                                ?>
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
                                <?php
                                    //clientes
                                ?>
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
</body>
</html>
