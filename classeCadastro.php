<?php
class cadastrar{

    private $pdo;

    // conexao banco de dados

    public function __construct($dbname,$host,$user,$senha){

        try {
            $this->pdo = new PDO ("mysql:dbname=".$dbname.";host=".$host,$user,$senha);

        } catch (PDOException $th) {
            echo "Erro no banco de dados".$th->getMessage();
           
        }
    }
      

    public function salvar($titulo,$imagem){

     $cmd = $this->pdo->prepare("INSERT into fotos(titulo,imagem) value (:t , :i)");
     $cmd -> bindValue(":t",$titulo);
     $cmd ->bindValue(":i",$imagem);
     $cmd->execute();
     return $cmd;
     
    }


    public function buscar(){
        $cmd = $this->pdo->query("SELECT * from fotos");

        if($cmd->rowCount()>0){

            $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }

        return $dados;


    }


    public function excluir($id){
        $cmd= $this->pdo->prepare("DELETE from fotos where id_foto = :id");
        $cmd -> bindValue(":id",$id);
        $cmd -> execute();
        
    }






}




?>