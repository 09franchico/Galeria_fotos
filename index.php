<?php

require("classeCadastro.php");

$dados = new cadastrar("db_fotos","localhost:3307","root","");


// cadstrar as fotos e titulo
if(isset($_POST["titulo"])){

    $titulo = $_POST ["titulo"];
    $imagem = $_FILES["imagem"]["name"].rand(1,999).'.png';
     // mover a foto para a pasta img
    move_uploaded_file($_FILES["imagem"]["tmp_name"],"imagens/".$imagem);

    if(!empty($titulo) && !empty($imagem)){
        
        $dados ->salvar($titulo,$imagem);
        header("location:index.php");

    }else{
        echo"<script> alert ('PREENCHA OS CAMPOS')</script>";
    }


}

// buscar as fotos
$dadosBuscado = $dados->buscar();


//deletar as fotos

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dadosExcluir = $dados -> excluir($id);
    header("location:index.php");
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Galeria</title>
</head>
<body>
    <div class="conteiner">
        <div class="btn-cont">
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="titulo" placeholder="TITULO FOTO"><br><br>
                <input id="file" type="file" name="imagem"><br><br>
                <button type="submit">SALVAR</button>
            </form>
        </div>
    </div>
    <div class="res">
        <?php
           for ($i=0; $i <count($dadosBuscado) ; $i++) {    
          
        ?>
        <div class="img">
           <h3><?php echo $dadosBuscado[$i]["titulo"]; ?></h3>
           <img src="imagens/<?php echo $dadosBuscado[$i]["imagem"] ?>" height="200px" width="300px" alt=""><br>
           <a href="index.php?id=<?php echo $dadosBuscado[$i]["id_foto"]  ?>"><button>EXCLUIR</button></a>

        </div>
        <?php
         }


        ?>

    </div>
    
</body>
</html>