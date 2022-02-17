<script>
     // -------------------------------- Tratamento para validação do Cpf ------------------------------
                
        // valida cpf
        function isValidCPF(cpf) {
            if (typeof cpf !== 'string') return false
            if (cpf == "12345678909") return false
            
            cpf = cpf.replace(/[^\d]+/g, '')
            if (cpf.length !== 11 || !!cpf.match(/(\d)\1{10}/)) return false
            
            cpf = cpf.split('')
            const validator = cpf
                .filter((digit, index, array) => index >= array.length - 2 && digit)
                .map( el => +el )
            const toValidate = pop => cpf
                .filter((digit, index, array) => index < array.length - pop && digit)
                .map(el => +el)
            const rest = (count, pop) => (toValidate(pop)
                .reduce((soma, el, i) => soma + el * (count - i), 0) * 10) % 11 % 10
            return !(rest(10,2) !== validator[0] || rest(11,1) !== validator[1])
        }

        // verifica cpf digitado
        function verificar(){
            let cpf =  document.getElementById('cpf');
            // conta o número de caracteres até chegar o valor para fazer a validação
            if(cpf.value.length < 3 || cpf.value.trim() ==''){
                    document.getElementById("verifica").style.visibility="hidden";
            } else {
                    document.getElementById("verifica").style.visibility="visible";
            }
                if(cpf.value.length == 11){
                    // verifica se todos os caracers do campo são números
                    if (!isNaN(cpf.value)){
                        // faz a validação
                        var resultado = isValidCPF(cpf.value);
                        // mostra o resultado
                        if(resultado ===true){  
                            cpf2.value = cpf.value;
                            cpf2.disabled = "true";
                            buscaNoBanco();
                        }else{
                            cpf.style.background = "#f00";
                            cpf.style.color ="#fff";     
                        } 
                    }
                }else{
                    cpf.style.background = "#fff";
                    cpf.style.color ="#000";
            }
        }; 

        function verificar2(){
            let cpf2 =  document.getElementById('cpf2');  
            if(cpf2.value.length >0){
                submitCadastro.disabled ="true";
                submitCadastro.style.background ="#f1f1f1";
                submitCadastro.style.color ="ddd";
                submitCadastro.style.borderColor ="ccc";
                submitCadastro.style.cursor ="default";

                if(cpf2.value.length == 11){
                    // verifica se todos os caracers do campo são números
                    if (!isNaN(cpf2.value)){
                        // faz a validação
                        var resultado2 = isValidCPF(cpf2.value);
                        // mostra o resultado
                        if(resultado2 ===true){
                            buscaNoBanco2();
                        }else{
                            cpf2.style.background = "#f00";
                            cpf2.style.color ="#fff";           
                        } 
                    }
                }else{
                    cpf2.style.background = "#fff";
                    cpf2.style.color ="#000";
                };
            }else{
                submitCadastro.disabled ="";
                submitCadastro.style.background ="lightgreen";
                submitCadastro.style.color ="#000";
                submitCadastro.style.borderColor ="#999";
                submitCadastro.style.cursor ="pointer";
            }
        };

        function buscaNoBanco(){
            let texto = document.getElementById('cpf').value;
            fetch('http://localhost:80/inner_join_mysql_tres_tabelas/verifica.php?busca=' + texto)
            .then(response => {// retorna a requisição fetch
                if (response.ok) {// se reornar ok
                return response.json();// converte num objeto json
                }
            })

            .then(json => {
                if(json == "Duplicado"){
                    alert(json);
                }

                if(json == "zero"){
                    submitCadastro.value ="NOVO";
                    div_formulario.style.display="block";
                    tabela_exibicao.style.display="none";
                    cpf.disabled = "true";
                    botaoExcluir.style.visibility="hidden";
                    document.getElementById('verifica').style.visibility="hidden";
                }
            
                if(json.nome == texto || json.cpf == texto || json.telefone == texto || json.barra == texto){
                    submitCadastro.value ="EXISTENTE";
                    div_formulario.style.display="block";
                    tabela_exibicao.style.display="none";
                    botaoExcluir.style.visibility="hidden";
                    id_cliente.value = json.id;
                    cpf2.value = json.cpf;
                    barraCliente.value = json.barra;
                    telefone.value = json.telefone;
                    telefone2.value = json.telefone2;
                    nome.value = json.nome;
                    email.value = json.email;
                    endereco.value = json.endereco;
                    dtCadCliente.value = json.dataCadastro;
                    dtNascimento.value = json.dataNascimento;
                    desabilitaExistente();
                    verifica.style.visibility="hidden";
                } 
            })

            .catch(error => {
                document.getElementById('verifica').style.visibility="hidden";
               
            });   
        };

        function retornar(){
            // limpa todos os campos do formulário
            submitCadastro.disabled ="";
            submitCadastro.style.background ="lightgreen";
            submitCadastro.style.color ="#000";
            submitCadastro.style.borderColor ="#999";
            submitCadastro.style.cursor ="pointer";
            form_cadastro.reset();
            reabilitaCampos();
            div_formulario.style.display="none";
            tabela_exibicao.style.display="block";
            verifica.style.visibility="hidden";
            return false;
        };

        function buscaNoBanco2(){
            let texto2 = document.getElementById('cpf2').value;
            fetch('http://localhost:80/inner_join_mysql_tres_tabelas/verifica.php?busca=' + texto2)
            .then(response => {// retorna a requisição fetch
                if (response.ok) {// se reornar ok
                return response.json();// converte num objeto json
                }
            })

            .then(json => {
                if(json.cpf == texto2){
                    alert("CPF já cadastrado");
                };
                if(json == "zero"){
                    submitCadastro.disabled ="";
                    submitCadastro.style.background ="lightgreen";
                    submitCadastro.style.color ="#000";
                    submitCadastro.style.borderColor ="#999";
                    submitCadastro.style.cursor ="pointer"; 
                };
            })

            .catch(error => {
                alet("Erro ao consultar o cpf no banco");
            }); 
        };// fim da função buscar banco

        function buscaNoBanco3(){
            let texto = document.getElementById('buscaCad').value;
            fetch('http://localhost:80/inner_join_mysql_tres_tabelas/buscaCadastro.php?busca=' + texto)
            .then(response => {// retorna a requisição fetch
                if (response.ok) {// se reornar ok
                return response.json();// converte num objeto json
                }
            })

            .then(json => {
                if(json == "zero"){
                alert("nada encontrado");
                }else{
                    submitCadastro.value ="ALTERAR";
                    id_cliente.value = buscaCad.value; 
                    idCliente.value = json.cliente_id;
                    tabela_exibicao.style.display="none";
                    div_formulario.style.display="block";
                    botaoExcluir.style.visibility="visible";
                    ordemServico.value = json.cadastro_ordem;
                    defeito.value = json.cadastro_defeitoReclamado;
                    dtEntrada.value = json.cadastro_dataEntrada; 
                    dtPronto.value = json.cadastro_dataPronto;
                    dtSaida.value = json.cadastro_dataSaida;
                    material.value = json.cadastro_material;
                    observacao.value = json.cadastro_obs;
                    orcamento.value = json.cadastro_orcamento;
                    acessorio.value = json.cadastro_acessorio;
                    modelo.value = json.cadastro_modelo;
                    numeroSerie.value = json.cadastro_numeroSerie;
                    id_aparelho.value = json.aparelho_id;
                    id_aparelho.text = json.aparelho_nome;
                    id_marca.value = json.marca_id;
                    id_marca.text = json.marca_nome;
                    id_estado.value = json.estado_id;
                    id_estado.text = json.estado_nome;
                    barraCadastro.value = json.cadastro_barra;
                    nome.value = json.cliente_nome;
                    cpf2.value = json.cliente_cpf;
                    cpf.disabled = 'true';
                    if(cpf2.value!=""){
                            cpf2.disabled = 'true';
                        };
                    telefone.value = json.cliente_telefone;
                    telefone2.value = json.cliente_telefone2;
                    endereco.value = json.cliente_endereco;
                    dtNascimento.value = json.cliente_dataNascimento;
                    dtCadCliente.value = json.cliente_dataCadastro;
                    email.value = json.cliente_email;
                    barraCliente.value = json.cliente_barra;     
                }
            })

            .catch(error => {
                alert("erro");
            });  
        };

        function buscaNoBanco4(){
            let texto = document.getElementById('buscaCliente').value;
            fetch('http://localhost:80/inner_join_mysql_tres_tabelas/buscaCadastro.php?cliente=' + texto)
            .then(response => {// retorna a requisição fetch
                if (response.ok) {// se reornar ok
                return response.json();// converte num objeto json
               
                }
            })

            .then(json => {
                if(json == "zero"){
                }else{
                    id_AltCliente.value = json.id; 
                    tabela_exibicao.style.display="none";
                    div_formulario.style.display="block";
                    nome.value = json.nome;
                    cpf2.value = json.cpf;
                    telefone.value = json.telefone;
                    telefone2.value = json.telefone2;
                    endereco.value = json.endereco;
                    dataNascimento.value = json.dataNascimento;
                    dataCadCliente.value = json.dataCadastro;
                    email.value = json.email;
                    barra.value = json.barra;    
                    barra.disabled = 'true'; 
                }
            })

            .catch(error => {
                alert("erro");
            });  
        };

        function retornar2(){
            // limpa todos os campos do formulário
            submitCadastro.disabled ="";
            submitCadastro.style.background ="lightgreen";
            submitCadastro.style.color ="#000";
            submitCadastro.style.borderColor ="#999";
            submitCadastro.style.cursor ="pointer";
            form_cadastro.reset();
            div_formulario.style.display="none";
            tabela_exibicao.style.display="block";
            verifica.style.visibility="hidden";
            return false;
        };

        function desabilitaCampos(){
            ordemServico.disabled = 'true';
            nome.disabled = 'true';
            dtNascimento.disabled = 'true';
            dtCadCliente.disabled = 'true';
            dtEntrada.disabled = 'true';
            defeito.disabled = 'true';
            acessorio.disabled = 'true';
            select_aparelho.disabled = 'true';
            select_marca.disabled = 'true';
            novoAparelho.disabled = 'true';
            novaMarca.disabled = 'true';
        };

        function desabilitaExistente(){
            if(cpf2.value!=""){
                cpf2.disabled = 'true';
            };
            cpf.disabled = 'true';
            nome.disabled = 'true';
            dtNascimento.disabled = 'true';
            dtCadCliente.disabled = 'true';
        };

        function reabilitaCampos(){
            ordemServico.disabled = '';
            cpf2.disabled = '';
            cpf.disabled = '';
            cpf.value='';
            cpf.style.background = "#fff";
            cpf.style.color = "#000";
            cpf2.style.background = "#fff";
            cpf2.style.color = "#000";
            nome.disabled = '';
            dtNascimento.disabled = '';
            dtCadCliente.disabled = '';
            dtEntrada.disabled = '';
            defeito.disabled = '';
            acessorio.disabled = '';
            buscaCad.value='';
            id_aparelho.value='';
            id_aparelho.text='';
            id_marca.value='';
            id_marca.text='';
            id_estado.value='';
            id_estado.text='';
            select_aparelho.disabled = '';
            select_marca.disabled = '';
            novoAparelho.disabled = '';
            novaMarca.disabled = '';
        };

        function buscar(){
            // retira os espaços da string com a função trim(), e conta os caracteres que sobrarem
            var buscar =  document.getElementById('cpf').value.trim();
            if(buscar.length < 3){
                cpf.value = buscar; 
                cpf.focus();
                alert("Digite pelo menos três caracteres para pesquisar");
                return false;
            };
                buscaNoBanco();
                return false;
        };

        // mascar de telefone 
        /* Máscaras ER */
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mtel(v){
            v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
            //v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos e um espaço
            v=v.replace(/^(\d{2})(\d)/g,"($1)$2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('telefone').onkeyup = function(){
                mascara( this, mtel );
            }
            id('telefone2').onkeyup = function(){
                mascara( this, mtel );
            }
        }

        // função que valida o formulário
        function validaForm(){
            if(ordemServico.value==""){
                alert("campo O.S. em branco");
                return false;
            };
            if(nome.value==""){
                alert("campo Nome em branco");
                return false;
            };
            if(defeito.value==""){
                alert("campo Defeito em branco");
                return false;
            };
            if(select_aparelho.value=="" && novoAparelho.value==""){
                alert("campos Aparelho e Novo Aparelho em branco");
                return false;
            };

            if(select_marca.value=="" && novaMarca.value==""){
                alert("campos Marca e Nova Marca em branco");
                return false;
            };
            if(select_estado.value==""){
                alert("campo Estado em branco");
                return false;
            };
        };  

        </script>