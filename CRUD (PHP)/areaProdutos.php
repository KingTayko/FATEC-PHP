<?php
    #Iniciando a sessão criada no arquivo index
    session_start();
        #Variável com hora atual (momento em que o administrador acessa o arquivo areaProdutos.php)
        $hora_logado = time();

        #Calculando o tempo em que o administrador está logado (tempo desde que ele criou a sessão)
        $time = ($hora_logado - $_SESSION["hora_acesso"]); 

        #If: verificando se o usuário realmente criou a sessão através de uma variável booleana (evitar que o usuário tente entrar diretamente pela url)
        if ($_SESSION["Logado"] == FALSE){
            #Redirecionando ao index.php
            header("Location: index.php");
            #Encerrando bloco de código PHP
            exit;
        }
        #Else if: veficando se a sessão já atingiu o tempo limite de 30 minutos (1800 segundos)
        else if ($time > 1800){  
            #Esse cookie será utilizado para mostrar uma mensagem temporária no arquivo index.php, indicando que o tempo de sessão atingiu seu tempo máximo
            setcookie('sesh_off', 'TRUE', time()+1800);
            header("Location: index.php");
            exit;
        }
        ob_end_flush();
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="(img)ZTenis.png" type="image/x-icon">
        <title>CRUD</title>
    </head>
    <body>
        <header>
            <div class = "header">
                <img src="(img)ZTenis.png" alt="Logo Tênis" width="60px" height="60px">
                <h1>Área do Administrador</h1>
                <h1>CRUD</h1>
            </div>
        </header>
        
        <!--HTML referente a área de CRUD, os forms estão em modo POST e as informações capturadas estão sendo redirecionadas ao seu respectivo arquivo php-->
        <div class="containerMainA">
            <div class = "mainA">
                <h2>Criar Produtos</h2>
            </div>
        </div>
        
        <div class = "newProd">
            <form action="1.Create.php" method="POST">
    
                <label id="nw_labelA">Nome:</label>
                <input id="nw_inputA" type="text" name="nm_produto">

                <label id="nw_labelA">Preço:</label>
                <input id="nw_inputA" type="number" step="000.001" min="0" name="vl_produto">

                <label id="nw_labelA">Quantidade:</label>
                <input id="nw_inputA" type="number" name="qt_produto">

                <label id="nw_labelA">Imagem:</label>
                <input id="nw_inputA" type="text" name="img_produto">
                

                <input type="submit" value="Cadastrar" name="btnC" id="nw_btnA">

            </form>
        </div>


        <div class = "containerMainA">
            <div class="mainA">
                <h2>Listar Produtos</h2>
            </div>
        </div>

        <div class = "newProd">
            <form action="2.Read.php" method="POST">

                <p>Listar todos os produtos:</p>

                <input type="submit" value="Procurar" name="RbtnAll" id="nw_btnA"><br><br>
    
                <p>Listar por ID:</p>
                <input id="nw_inputA" type="text" name="FindId">

                <input type="submit" value="Procurar" name="RbtnId" id="nw_btnA">

            </form>
        </div>

        <div class = "containerMainA">
            <div class="mainA">
                <h2>Editar Produtos</h2>
            </div>
        </div>

        <div class = "newProd">
            <form action="3.Update.php" method="POST">

            <p>Digite os novos dados do produto (identifique-o por ID): </p><br>

                <label id="nw_labelA">ID: </label>
                <input id="nw_inputA" type="text" name="up_id">
            
                <label id="nw_labelA">Nome:</label>
                <input id="nw_inputA" type="text" name="up_nm">

                <label id="nw_labelA">Preço:</label>
                <input id="nw_inputA" type="number" step="0.01" min="0" name="up_vl">

                <label id="nw_labelA">Quantidade:</label>
                <input id="nw_inputA" type="number" name="up_qt">

                <label id="nw_labelA">Imagem:</label>
                <input id="nw_inputA" type="text" name="up_img">

                <input type="submit" value="Atualizar" name="UbtnId" id="nw_btnA">
 
            </form>
        </div>


        <div class = "containerMainA">
            <div class="mainA">
                <h2>Deletar Produtos</h2>
            </div>
        </div>

        <div class = "newProd">
            <form action="4.Delete.php" method="POST">

            <p>Digite o ID do produto a ser deletado: </p><br>
            
                <label id="nw_labelA">ID: </label>
                <input id="nw_inputA" type="text" name="Del_id">

                <input type="submit" value="Deletar" name="UbtnId" id="nw_btnA">
                
            </form>
        </div>


        <div class="containerVoltar">
            <form method="post" action="#">
                <input type="submit" name="voltar" value="Sair" id="nw_btnV">
            </form>
        </div>
        
        <?php
        #If: botão de voltar
            if (!empty($_POST['voltar'])){
                echo '<script>window.location.href = "index.php";</script>';
            }
        ?>

        <footer class="footerAreaProdutos">
            <div class="footer">
                <h1>DSM - 2° Ciclo</h1>
                <p>Site desenvolvido por Pedro Henrique Bomfim Wolski e Thiago Pereira de Jesus Souza</p>
            </div>
        </footer>


    </body>
</html>