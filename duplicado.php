<?php

require_once 'conexao.php';

if((isset($_POST['busca']))AND($_POST['busca']<>"")){
    $busca = $_POST['busca'];
    $query = mysqli_query($conexao,"SELECT * FROM cliente WHERE excluir ='' AND nome LIKE '%$busca%' OR cpf = '$busca' OR endereco LIKE '%$busca%' OR barra = '$busca' OR telefone = '$busca' OR email = '$busca' ");
    $total = mysqli_num_rows($query);   
};

if((isset($_POST['data']))AND($_POST['data']<>"")){
    $busca = $_POST['data'];
    $query = mysqli_query($conexao,"SELECT * FROM cliente WHERE dataNascimento = '$busca' AND excluir ='' ");
    $total = mysqli_num_rows($query); 
};

?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <style>
        .duplicado{
            position:relative;
            zoom:1.7;
            top:4px;
        }
         
    </style>
</head>
<body>
<div class="container">
<div id="busca" class="pesquisa">
    <b>Digite o nome, cpf, telefone, endereço, email ou codigo de barra</b>
    
    <!-- primeiro formulário de pesquisa --> 
    <form id="formulario" name="frmEnviaDados" class="form-horizontal" action="duplicado.php"  method="post">
        <input id="cpf" type="text" name="busca" placeholder="Digite aqui para pesquisar" autocomplete="off">
        <input class="botao but-azul" type="submit" value="buscar">
        <a href="index.php" class="botao" > VOLTAR </a> 
        <input id="buscaCliente" type="hidden" name="buscaCad" autocomplete="off" />
    </form>
   
    <b>Digite a data de nascimento</b>
    <form id="formulario" name="frmEnviaDados" class="form-horizontal" action="duplicado.php"  method="post">
        <input id="data" type="date" name="data" placeholder="Digite aqui para pesquisar" autocomplete="off">
        <input class="botao but-azul" type="submit" value="busca pela  data de  nascimento">
    </form>
        
    
</div>

<div id="div_formulario" class="formulario">
   <div class="titulo">Formulário de alteração</div>
    <form id="form_cadastro" name="frmEnviaDados" class="form-horizontal" action="cadastro.php"  method="post" enctype="multipart/form-data"  >       
        <!--<input id="id_cliente" type="hidden" name="id_cliente" value="" >-->
        <input id="id_AltCliente" type="hidden" name="id_AltCliente" value="" >
        
        <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <td  class="tabela3 OS">
                        CPF <br>
                        
                        <input class="cpf-form" type="text" autocomplete="off" id="cpf2" name="cpf"  maxlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onkeyup="verificar2()"  >
                    </td>
                    <td colspan="2" class="tabela3">
                        Nome<br>
                        <input id="nome" class="nome-form" type="text" name="nome" value="" autocomplete="off">
                    </td>
                    <td  class="tabela3">
                        Telefone<br>
                        <input id="telefone" class="telefone-form" autocomplete="off" placeholder="(99)9999-9999" maxlength="14" type="text" name="telefone" value="" >
                    </td>	
                    <td  class="tabela3">
                    Telefone 2<br>
                       
                        <input id="telefone2" class="telefone-form" autocomplete="off" placeholder="(99)9999-9999" maxlength="14" type="text" name="telefone2" value="" >
                    </td>	
                         
                </tr>
                
                    <tr class="divNovoCadastro">
                    
                        <td class="tabela3">
                            DT. Nascimento<br>
                                <input class="data-form" id="dataNascimento" type="date" name="dataNascimento">
                        </td>
                        <td class="tabela3" colspan="4">
                            Endereço<br>
                                <input class="nome-form" id="endereco"  type="text" name="endereco" >
                        </td>
                    
                    </tr>
                    <tr class="divNovoCadastro">
                        <td class="tabela3">
                            DT. Cadastro<br>
                                <input class="data-form" id="dataCadCliente" type="date" name="dataCadCliente">
                        </td>
                        <td class="tabela3" colspan="2">
                            Email<br>
                                <input class="nome-form" id="email"  type="text" name="email" >
                        </td>
                        <td class="tabela3">
                            Barra<br>
                                <input class="nome-form" id="barra"  type="text" name="" >
                        </td>
                       
                        <td class="tabela3">
                             <!--
                            N/C<br>
                                <input class="nome-form" id=""  type="text" name="" >
                                 -->
                        </td>
   
                    </tr>  
                    <tr>
                    
                    <td class="tabela3" colspan="4">
    </td>
                                
                    <td  class="tabela3">
                        <input type="submit" id="submitCadastro" name="submitCadastro" class="botao cadastro" value="ALTERAR">
                        <a href="#" id="botaoExcluir" class="botao but-vermelho"  OnClick="this.href='excluir_cliente.php?codigo='+ id_AltCliente.value;return confirm('Confirma Exclusão da ' +'\n' + nome.value)" >exc</a>
                        <span class="botao" style="width:50px;" onclick="return retornar2()">VOLTAR</span>
                    </td>
                </tr>
            </thead>
        </table>
    </form>

</div>
<?php 
    if((isset($_POST['busca']))AND($_POST['busca']<>"")OR(isset($_POST['data']))AND($_POST['data']<>"")){   
        
?>
        <div id="tabela_exibicao">
            <div class="titulo">Tabela de exibição &nbsp&nbsp <?php echo $total;?></div>
            <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                <thead>
                   
                    <tr>
                   
                        <th class="tabela2">
                            ID
                        </th>
                        <th  class="tabela2">
                            Nome do cliente
                        </th>
                        <th  class="tabela2">
                            Tel.
                        </th>
                        <th  class="tabela2">
                            Tel. 2
                        </th>
                        <th  class="tabela2">
                            CPF
                        </th>
                        <th  class="tabela2">
                            Dt Nascimento
                        </th>
                        <th  class="tabela2">
                            Email
                        </th>	
                        <th  class="tabela2">
                            Barra
                        </th>	
                       
                        <th class="funcoes">
                            Funções<br>
                        </th>
                       
                    </tr>
                </thead>  
                <tbody>
                <?php
                   
                    while ($linha = mysqli_fetch_array($query,MYSQLI_ASSOC)) {;?>
                        <tr>
                           
                            <td class="td"><?php echo $linha['id']; ?></td>                          
                            <td  class="nome"><?php echo $linha['nome']; ?></td>
                            <td class="telefone"><?php echo $linha['telefone']; ?></td>
                            <td class="telefone"><?php echo $linha['telefone2']; ?></td>
                            <td><?php echo $linha['cpf']; ?></td>
                            
                           
                            <td><?php if($linha['dataNascimento']<>'0000-00-00'){echo date("d/m/Y",strtotime($linha['dataNascimento']));} ?></td>
                            <td><?php echo $linha['email']; ?></td>
                            <td><?php echo $linha['barra']; ?></td>
                            <td >
                            
                                <span class="botao  but-azul" onclick="buscaCliente.value='<?php echo $linha['id']; ?>'; buscaNoBanco4()" >alt</span>
                                <a href="excluir_cliente.php?codigo=<?= $linha['id']; ?>" class="botao but-vermelho"  OnClick="return confirm('Confirma Exclusão da OS <?php echo $linha['id']; ?>' +'\n'+'<?php echo $linha['nome']; ?>')" >exc</a>
                            
                            </td>
                        </tr>
                    <?php };?>
                   
                </tbody>
            </table>
        </div>
   
    </div>
    <?php } 
        require_once 'js.php';
    ?>
    </body>
    </html>
           



