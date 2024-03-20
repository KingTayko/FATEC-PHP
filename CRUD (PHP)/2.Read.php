<?php

    if(!empty($_POST['RbtnAll'])){

        try {
            include_once '(L)config.php';
            #Comando SQL realizando busca por todos os dados da tabela PRODUTO
            $all = "SELECT * FROM PRODUTO";
            #Nesse caso, diferentemente do arquivo Create, foi necessário utilizar os comandos prepare e execute (pois a linha de comando SQL irá retornar informações)
            $res = $conn->prepare($all);  
            $res->execute();
            
            #PDO::FETCH_ASSOC, fetch e extract($row) fazem com que a utilização das variáveis criadas no 1.Create.php seja possível, facilitando o processo de impressão dos dados
            while($row = $res->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                echo "ID: $id <br>";     
                echo "Nome: $nm_produto <br>";     
                echo "Quantidade: $qt_produto <br>";      
                echo 'Imagem:<br><img src="' . $img_produto . '" width="150px" height="150px"><br>';    
                echo "<br><hr>";
            }


        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
    }

    if(!empty($_POST['RbtnId'])){

        $f_id = $_POST["FindId"]; 

        try {
            include '(L)config.php';
            #Comando SQL realizando busca por ID dos dados 
            $ById = "SELECT * FROM PRODUTO WHERE id = '$f_id'";
            $res = $conn->prepare($ById);  
            $res->execute();

            #Criação de uma variável para armazenar a quantidade de linhas retornadas pela query SQL
            $rows_read = $res -> RowCount();

            #If: verificando se a query foi bem sucedida (caso tenha sido executada com sucesso, retornará mais de 0 linhas)
            if($rows_read > 0){
                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    echo "<b>Produto encontrado:</b><br><br>";
                    echo "ID: $id <br>";     
                    echo "Nome: $nm_produto <br>";    
                    echo "Preço: $vl_produto <br>";   
                    echo "Quantidade: $qt_produto <br>";
                    #Inserindo variável, que contém a url do src, em uma tag img, fazendo com que a imagem seja impressa ao usuário      
                    echo 'Imagem:<br><img src="' . $img_produto . '" width="250px" height="250px"><br>';    
                    echo "<br><hr>";
                }
            }
            else {
                #Else: caso não tenha bem sucedida (não retornará linhas) exibirá um alerta e uma mensagem "Produto não encontrado"
                echo '<script>alert("Não foi possível exibir o produto ' . $f_id . '!")</script>';
                echo "<br><h2 style='color: #f00;' align='center'>ID inválido: O produto " .  $f_id . " não está cadastrado no banco de dados!</h2>";

            }
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="(img)ZTenis.png" type="image/x-icon">
    </head>
        <body>
            <div class="containerVoltar">
                <form method="post" action="#">
                    <input type="submit" name="voltar" value="voltar" id="nw_btnV">
                </form>
            </div>
        </body>
</html>

<?php 
    if (!empty($_POST['voltar'])){
        header("Location: areaProdutos.php");
    }
?>