<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a><?php if(isset($categorias)){
        foreach($categorias as $cat){
            echo($cat->nombre); 
        }   
    }?></a>
</body>
</html>