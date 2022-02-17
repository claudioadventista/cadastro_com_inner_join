<?php

require_once 'conexao.php';

   $query = mysqli_query(
   $conexao,"SELECT 
   cadastro.id, 
   cadastro.ordem_servico cadastro_ordem, 
   cadastro.barra cadastro_barra, 
   cliente.id cliente_id, 
   cliente.nome cliente_nome, 
   cliente.telefone cliente_telefone, 
   cliente.cpf cliente_cpf, 
   aparelho.nome_aparelho aparelho_nome,
   marca.nome_marca marca_nome,
   estado.nome_estado estado_nome 
   FROM cadastro cadastro 
   INNER JOIN cliente cliente ON cadastro.id_cliente = cliente.id 
   INNER JOIN aparelho aparelho ON cadastro.id_aparelho = aparelho.id 
   INNER JOIN marca marca ON cadastro.id_marca = marca.id 
   INNER JOIN estado estado ON cadastro.id_estado = estado.id
   WHERE cadastro.excluir='' AND cliente.excluir=''
   ORDER BY cadastro.id ASC");
  

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>
    <div class="container">
        <div id="busca" class="pesquisa">
            <b>Digite o nome, cpf, telefone, email ou codigo de barra <span class="texto">Digite para buscar o cadastro</span></b>
            
            <!-- primeiro formulário de pesquisa --> 
            <form id="formulario" name="frmEnviaDados" class="form-horizontal" action="busca.php"  method="post">
                <input id="cpf" type="text" name="busca" placeholder="Digite aqui para novo cadastro" autocomplete="off" onkeyup="verificar()">
                <input  id="verifica" class="botao cadastro" type="submit" value="verificar" onclick="return buscar()">
                <a href="duplicado.php" class="botao but-azul" > página cliente </a>
                
            </form>
            <form id="buscaCadastro" name="frmEnviaDados" class="form-horizontal" action="busca.php"  method="post">
                <input id="buscaCad" type="text" name="buscaCad" placeholder="Digite o id ou codigo de barra" autocomplete="off" />
                <input  id="buscar" class="botao but-azul" type="submit" value="buscar" onclick="buscaNoBanco3();  return false;"> 
            </form>
            </div> 

        <div id="div_formulario">
            <div class="titulo">Formulário de entrada e alteração</div>
            <form id="form_cadastro" name="frmEnviaDados" action="cadastro.php"  method="post" enctype="multipart/form-data"  >       
                <input id="id_cliente" type="hidden" name="id_cliente" value="" >
                <input id="idCliente" type="hidden" name="idCliente" value="" >
                <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                    <tr>
                        <td  class="tabela3 OS">
                            O. S. &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  CPF <br>
                            <input class="os-form" type="text" autocomplete="off" id="ordemServico" name="ordemServico" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required >
                            <input class="cpf-form" type="text" autocomplete="off" id="cpf2" name="cpf2"  maxlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onkeyup="verificar2()"  >
                        </td>
                        <td colspan="2" class="tabela3">
                            Nome<br>
                            <input id="nome" class="nome-form" type="text" name="nome" value="" autocomplete="off" required>
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
                    <tr>
                        <td class="tabela3">
                            DT. Nascimento<br>
                                <input class="data-form" id="dtNascimento" type="date" name="dataNascimento">
                        </td>
                        <td class="tabela3" colspan="4">
                            Endereço<br>
                                <input class="nome-form" id="endereco"  type="text" name="endereco" >
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            DT. Cadastro<br>
                                <input class="data-form" id="dtCadCliente" type="date" name="dataCadCliente">
                        </td>
                        <td class="tabela3" colspan="2">
                            Email<br>
                                <input class="nome-form" id="email"  type="text" name="email" >
                        </td>
                        <td class="tabela3" colspan="1">
                            Barra Cliente<br>
                                <input class="nome-form" id="barraCliente"  type="text" name="" disabled >
                        </td>
                        <td class="tabela3" colspan="1">
                            Barra Cadastro<br>
                                <input class="nome-form" id="barraCadastro"  type="text" name="" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3" colspan="5">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            DT. Entrada<br>
                                <input class="data-form" id="dtEntrada" type="date" name="dtEntrada">
                        </td>
                        <td class="tabela3" colspan="4">
                            Defeito<br>
                                <input class="nome-form" id="defeito"  type="text" name="defeito" required >
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            DT. Pronto<br>
                                <input class="data-form" id="dtPronto" type="date" name="dtPronto">
                        </td>
                        <td class="tabela3" colspan="4">
                            Acessório<br>
                                <input class="nome-form" id="acessorio" type="text" name="acessorio">
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            DT. Saída<br>
                                <input class="data-form" id="dtSaida" type="date" name="dtSaida">
                        </td>
                        <td class="tabela3" colspan="4">
                            Observação<br>
                                <input class="nome-form" id="observacao" autocomplete="off" type="text" name="observacao">
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3" colspan="5">
                            Material<br>
                            <textarea class="nome-form textarea_material" id="material" autocomplete="off" cols="10" rows="4" id="material" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td  class="tabela3">
                            Aparelho<br>
                            <select id="select_aparelho"  class="data-form" name="id_aparelho" >    
                                <option id="id_aparelho" value=""></option>                                  
                                <?php $listaAparelho = mysqli_query($conexao,"SELECT * FROM aparelho ORDER BY nome_aparelho ASC");               		  
                                while($aparelhos = mysqli_fetch_array($listaAparelho)) {; ?>                                      	
                                    <option value="<?php echo $aparelhos['id']; ?>"><?php echo $aparelhos['nome_aparelho']; ?></option>                                                                      	
                                <?php } ?>						  				  				  	                                                                                                                                                                                           
                            </select>
                        </td>
                        <td  class="tabela3">
                            Marca<br>
                            <select id="select_marca" class="data-form" name="id_marca" >    
                                <option id="id_marca" value=""></option>                                  
                                <?php $listaMarca = mysqli_query($conexao,"SELECT * FROM marca ORDER BY nome_marca ASC");               		  
                                while($marcas = mysqli_fetch_array($listaMarca)) {; ?>                                      	
                                    <option value="<?php echo $marcas['id']; ?>"><?php echo $marcas['nome_marca']; ?></option>                                                                      	
                                <?php } ?>						  				  				  	                                                                                                                                                                                           
                            </select>
                        </td>
                        <td  class="tabela3">
                            Estado<br>
                            <select id="select_estado" class="data-form"  name="id_estado" required >    
                                <option id="id_estado" value=""></option>                                  
                                <?php $listaEstado = mysqli_query($conexao,"SELECT * FROM estado ORDER BY nome_estado ASC");               		  
                                while($estados = mysqli_fetch_array($listaEstado)) {; ?>                                      	
                                    <option value="<?php echo $estados['id']; ?>"><?php echo $estados['nome_estado']; ?></option>                                                                      	
                                <?php } ?>						  				  				  	                                                                                                                                                                                           
                            </select>
                        </td>
                        <td class="tabela3 OS" >
                            Modelo<br>
                                <input class="nome-form" id="modelo" type="text" name="modelo">
                        </td>
                        <td class="tabela3 OS" >
                            Nº série<br>
                                <input class="nome-form" id="numeroSerie" type="text" name="numeroSerie">
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3 OS">
                            Novo Aparelho<br>
                                <input class="data-form" id="novoAparelho" type="text" autocomplete="off" name="novoAparelho" maxlength="25">
                        </td>
                        <td class="tabela3 OS">
                            Nova Marca<br>
                                <input class="data-form" id="novaMarca" type="text" autocomplete="off" name="novaMarca" maxlength="25">
                        </td>
                        <td class="tabela3 OS">
                            Foto1 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Foto 2 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Foto 3<br>
                        </td>                  
                        <td  class="tabela3">
                            Orçamento  &nbsp&nbsp&nbsp&nbsp&nbsp Desconto<br>
                            <input class="orcamento" id="orcamento" type="text" autocomplete="off" name="orcamento" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            
                            <input class="orcamento" id="desconto" type="text" autocomplete="off" name="desconto" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                <!-- <input  id="verifica" class="botao" type="submit" value="verificar" onclick="return buscar()">-->
                            
                        </td>                           
                        <td  class="tabela3">
                           
                            <input type="submit" id="submitCadastro" name="submitCadastro" class="botao cadastro" value=""  onclick="return validaForm()">
                            <a href="#" id="botaoExcluir" class="botao but-vermelho"  OnClick="this.href='excluir_cadastro.php?codigo='+ id_cliente.value;return confirm('Confirma Exclusão da OS ' + ordemServico.value +'\n' + nome.value)" >exc</a>
                            <span class="botao" style="width:50px;" onclick="return retornar()">VOLTAR</span>
                        
                        </td>
                    </tr>
                </table> 
            </form>
        </div>
        <div id="tabela_exibicao">
            <div class="titulo">Tabela de exibição</div>
            <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                <thead>
                    <tr>
                        <th class="tabela1">
                            Tab cadastro
                        </th>
                        <th  class="tabela1">
                            Tab cadastro
                        </th>
                        <th  class="tabela1">
                            Tab cadastro
                        </th>
                        <th  class="tabela2">
                            Tab cliente
                        </th>
                        <th  class="tabela2">
                            Tab cliente
                        </th>
                        <th  class="tabela2">
                            Tab cliente
                        </th>	
                        <th  class="tabela3">
                            Tab aparelho
                        </th>
                        <th  class="tabela4">
                            Tab marca
                        </th>
                        <th  class="tabela5">
                            Tab estado
                        </th>
                        <th  class="funcoes">
                        
                        </th>
                    </tr>
                    <tr>
                        <th class="tabela1">
                            ID cadastro
                        </th>
                        <th  class="tabela1">
                            O. S. cadastro
                        </th>
                        <th  class="tabela1">
                            Barra cadastro
                        </th>
                        <th  class="tabela2">
                            Nome cliente
                        </th>
                        <th  class="tabela2">
                            Telefone cliente
                        </th>
                        <th  class="tabela2">
                            CPF cliente
                        </th>	
                        <th  class="tabela3">
                            nome do Aparelho
                        </th>
                        <th  class="tabela4">
                            nome da Marca
                        </th>
                        <th  class="tabela5">
                            nome do Estado
                        </th>
                        <th class="funcoes">
                            Funções<br>
                        </th>
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    while ($categoria = mysqli_fetch_array($query,MYSQLI_ASSOC)) {; ?>
                        <tr>
                            <td class="td"><?php echo $categoria['id']; ?></td>
                            <td><?php echo $categoria['cadastro_ordem']; ?></td>
                            <td><?php echo $categoria['cadastro_barra']; ?></td>
                            <td><?php echo $categoria['cliente_nome']; ?></td>
                            <td><?php echo $categoria['cliente_telefone']; ?></td>
                            <td><?php echo $categoria['cliente_cpf']; ?></td>
                            <td><?php echo $categoria['aparelho_nome']; ?></td>
                            <td><?php echo $categoria['marca_nome']; ?></td>
                            <td><?php echo $categoria['estado_nome']; ?></td>
                            <td >
                                <span class="botao  but-azul" onclick="buscaCad.value='<?php echo $categoria['id']; ?>'; desabilitaCampos(); buscaNoBanco3()" >alt</span>
                                <a href="excluir_cadastro.php?codigo=<?= $categoria['id']; ?>" class="botao but-vermelho"  OnClick="return confirm('Confirma Exclusão da OS <?php echo $categoria['cadastro_ordem']; ?>' +'\n'+'<?php echo $categoria['cliente_nome']; ?>')" >exc</a>
                            </td>
                        </tr>
                    <?php };?>
                </tbody>
            </table>
        </div>            
    </div>
    <?php
        require_once 'js.php';
    ?>
</body>
</html>
           



