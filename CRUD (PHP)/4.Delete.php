<?php

        try {

            include '(L)config.php';

            $del_id = $_POST ['Del_id'];

            $delete = "DELETE FROM PRODUTO WHERE id=:Del_id";
            $sel = "SELECT * FROM PRODUTO WHERE id=:Del_id";
            
            $res_del = $conn->prepare($delete);
            $res_del->bindParam(":Del_id", $del_id);
            $res_del->execute();

            $res_sel = $conn->prepare($sel);
            $res_sel->bindParam(":Del_id", $del_id);
            $res_sel->execute();

            $rows_del = $res_del->rowCount();
            $rows_sel = $res_sel->rowCount();

            #If: verificando a execução do comando de delete SQL, caso tenha sido bem sucedido, um alert é emitido e o usuário é retornado à página de CRUD
            if($rows_del > 0){
                echo '<script>alert("O produto ' . $del_id . ' foi deletado com sucesso!");
                    window.location.href = "areaProdutos.php";
                    </script>';
            } 
            /*else if: verificando se o comando de select retornou algum registro, se não retornar nada, um alert é emitido 
            e o usuário permanece na mesma página com uma mensagem de erro, indicando que o produto que ele tentou excluir não estava cadastrado no banco de dados*/
            else if($rows_sel == 0){
                echo '<script>alert("Não foi possível deletar o produto ' . $del_id . '!")</script>';
                echo '<br><br><h2 align="center" style="color: #f00;">ID inválido: O produto ' . $del_id . ' não está cadastrado no banco de dados!</h2>';

                echo
                '<!DOCTYPE html>
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
                </html>';
        
                if (!empty($_POST['voltar'])){
                    header("Location: areaProdutos.php");
                }

            }
            else{
                echo '<script>alert("Não foi possível deletar o produto ' . $del_id . '!");
                window.location.href = "areaProdutos.php";</script>';
            } 

        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }

    $conn = null;
?>