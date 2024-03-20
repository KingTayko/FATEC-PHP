<?php
    #If: verificando se o botão contém um valor diferente de vazio (se foi clicado ou não)
    if(!empty($_POST['btnC'])){
        #Capturando informações do form e passando para às variáveis
        $nome_produto = $_POST["nm_produto"];
        $vl_produto = $_POST["vl_produto"];
        $qt_produto = $_POST["qt_produto"];
        $img_produto = $_POST["img_produto"];

        try {
            #Incluindo as linhas de código que estão no config.php (principalmente, para utilizarmos as caracterticas do PDO e a variável de conexão ($conn))
            include '(L)config.php';
            #Atribuindo o comando SQL de inserção a uma variável ($sql)
            $sql = "INSERT INTO produto (nm_produto, vl_produto, qt_produto, img_produto) VALUES ('$nome_produto', '$vl_produto', '$qt_produto', '$img_produto')";
            #Utilizando a conexão para executar a query
            $res = $conn->query($sql);

            $rows_c = $res -> rowCount();   

            if($rows_c > 0){
            
                echo '<script> 
                    alert("Produto inserido com sucesso!");
                    window.location.href = "areaProdutos.php";
                </script>';                      
            }

        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        #Encerrando conexão
        $conn = null;
    }

?>