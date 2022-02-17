<?php

require_once 'conexao.php';
   
   if(isset($_GET['busca'])){
      $busca = $_GET['busca'];
      //$sql =  mysqli_query($conexao,"SELECT * FROM cadastro WHERE id = '$busca' OR barra = '$busca'");
      
      $sql = mysqli_query(
         $conexao,"SELECT cadastro.id, 
         cadastro.ordem_servico cadastro_ordem, 
         cadastro.defeitoReclamado cadastro_defeitoReclamado,
         cadastro.dataEntrada cadastro_dataEntrada,
         cadastro.dataPronto cadastro_dataPronto,
         cadastro.dataSaida cadastro_dataSaida,
         cadastro.material cadastro_material,
         cadastro.obs cadastro_obs,
         cadastro.orcamento cadastro_orcamento,
         cadastro.acessorio cadastro_acessorio,
         cadastro.modelo cadastro_modelo,
         cadastro.numeroSerie cadastro_numeroSerie,
         cadastro.barra cadastro_barra,
         cliente.id cliente_id, 
         cliente.nome cliente_nome,
         cliente.telefone cliente_telefone,
         cliente.telefone2 cliente_telefone2,
         cliente.cpf cliente_cpf,
         cliente.endereco cliente_endereco,
         cliente.dataNascimento cliente_dataNascimento,
         cliente.dataCadastro cliente_dataCadastro,
         cliente.email cliente_email,
         cliente.barra cliente_barra,
         aparelho.id aparelho_id,
         aparelho.nome_aparelho aparelho_nome,
         marca.id marca_id,
         marca.nome_marca marca_nome,
         estado.id estado_id,
         estado.nome_estado estado_nome
         FROM cadastro cadastro 
         INNER JOIN cliente cliente ON cadastro.id_cliente = cliente.id 
         INNER JOIN aparelho aparelho ON cadastro.id_aparelho = aparelho.id 
         INNER JOIN marca marca ON cadastro.id_marca = marca.id
         INNER JOIN estado estado ON cadastro.id_estado = estado.id  
         WHERE cadastro.id = '$busca' OR cadastro.barra = '$busca'");


      $tot = mysqli_num_rows($sql);
      $cadastro = mysqli_fetch_array($sql);
      if($tot == 0){
         echo json_encode("zero");
      }else{
         echo json_encode($cadastro);
      };
   };

   if(isset($_GET['cliente'])){
      $busca = $_GET['cliente'];
      $sql = mysqli_query($conexao,"SELECT * FROM cliente WHERE  id = '$busca'");
      $tot = mysqli_num_rows($sql);
      $buscaCliente = mysqli_fetch_array($sql);
         echo json_encode($buscaCliente);

   }
?>