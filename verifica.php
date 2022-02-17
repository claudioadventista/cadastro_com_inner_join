<?php

require_once 'conexao.php';
   
   if(isset($_GET['busca'])){
      $busca = $_GET['busca'];
     
      $query =  mysqli_query($conexao,"SELECT * FROM cliente WHERE nome = '$busca' OR cpf = '$busca' OR barra = '$busca' OR telefone = '$busca' OR email = '$busca' ");	
      $total = mysqli_num_rows($query);
      $linha = mysqli_fetch_array($query);
      if($total == 0){
         echo json_encode("zero");
      }else if($total >1){
         echo json_encode("Duplicado");
      }else{
         echo json_encode($linha);
      }
   }
?>