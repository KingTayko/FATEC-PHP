<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="(img)ZTenis.png" type="image/x-icon">
    <title>Login</title>
</head>
<body>

    <header>
        <div class = "header">
            <img src="(img)ZTenis.png" alt="Logo Tênis" width="60px" height="60px">
            <h1>Área do Administrador</h1>
            <h1>Login</h1>
        </div>
    </header>

    <div class = "containerMain">
        <div class = "main">
            <form action="#" method="POST">

                <div class="icon">
                    <img src="(img)ZTenis.png" alt="Logo Tênis" width="60px" height="60px">
                    <br>
                </div>

                <label id="nw_label">Nome:</label>
                <!--Required value (preenchendo o valor do input) está obtendo o valor do cookie (caso ele exista)-->
                <!--Se o cookie não existir, o operador ternário não retorna nenhum dado-->
                <input id="nw_input" type="text" name="nm_adm" required value="<?php echo isset($_COOKIE['adm_cookie']) ? $_COOKIE['adm_cookie'] : '';?>">

                <label id="nw_label">Senha:</label>
                <input id="nw_input" type="password" name="adm_pass"><br>

                <input type="checkbox" name ="remember_me">
                <label id="nw_label">Lembrar de mim</label><br>

                <input type="submit" value="Entrar" name="btnL" id="nw_btn">

                <p style="color: #008000">Nome: adm1 </p>
                <p style="color: #008000">Senha: 123 </p>

                <?php
                    if(isset($_COOKIE['forbidden']) && $_COOKIE['forbidden'] == TRUE){
                        echo "<p align='center' style='color: #f00;'>Administrador não autorizado</p>";
                    }
                    setcookie('forbidden', 'false', time()-3600);
                ?>

            </form> 
        </div>
    </div>

    <footer class="footerIndex">
        <div class="footer">
            <h1>DSM - 2° Ciclo</h1>
            <p>Site desenvolvido por Pedro Henrique Bomfim Wolski e Thiago Pereira de Jesus Souza</p>
        </div>
    </footer>

</body>
</html>


<?php   
    #If: verificando a existência de um cookie booleano (criado no arquivo areaProdutos.php) e o seu valor
    if(isset($_COOKIE['sesh_off']) && $_COOKIE['sesh_off'] == TRUE){
        #Caso as condições sejam satisfeitas, um alerta é impresso e o cookie é destruído
        echo "<script> alert('O seu tempo de sessão expirou. Realize o login novamente!')</script>";
        setcookie('sesh_off', '', time()-1800);
    }

    if(!empty($_POST['btnL'])){

        #If: verificando a existência de um cookie para evitar a repetição contínua da função
        if(empty($_COOKIE['executou_script'])){
            #Esse sc ript serve para darreload na página a cada 250 milissegundos
            #Obs: o reload serve para que (mesmo que o admin não esteja permitido a acessar o CRUD e ele tenha marcado a caixa de lembrar) o seu nome seja substituido no input
            echo'<script>
                setTimeout(function(){
                    location.reload(); 
                }, 250);
            </script>';
        }
        setcookie('executou_script', 'true', time() - 3600);
        #Criação do cookie que indica a pausa da execução do script
        setcookie('executou_script', 'true', time() + 3600);
        


        $user = $_POST["nm_adm"];
        $passW = $_POST["adm_pass"];

        try{
            include '(L)config.php';
            include '(L)defaultDBA.php';

            #If: Caso o usuário marque a Checkbox de lembrar seu nome, cria-se o cookie que armazenará o usuário
            if(!empty($_POST['remember_me'])){
                #If: caso o cookie já tenha sido criado, o antigo é excluído e inicializa-se um novo para poder atualizar o nome do usuário 
                #Obs: o required value só será atualizado caso a página receba um reload
                if(isset($_COOKIE['adm_cookie'])){
                    setcookie('adm_cookie', '', time()-3600);
                }
                setcookie('adm_cookie', $user, time()+3600);
            } else{
                #Else: Caso não marque, o cookie será destruido (para evitar que o required value seja preenchido indevidamente nos reloads da página)
                setcookie('adm_cookie', '', time()-3600);
            }

            #Comando SQL para verificar se as informações de login foram digitadas corretamente
            #Nesse caso, é necessário fazer a comparação das variáveis (que são passadas como parâmetros) da consulta através da notação abaixo
            $consulta = "SELECT user, passW FROM administrador WHERE user=:user AND passW=:passW";
            $res = $conn->prepare($consulta);
            #Aqui, identificamos os parâmetros e indicamos a que variáveis eles se referem
            $res->bindParam(":user", $user);
            $res->bindParam(":passW", $passW);            
            $res->execute(); 

            if($res->rowCount() > 0){
                echo "Administrador conectado";
                #Início de sessão
                session_start();
                #Criação de variável de sessão booleana
                $_SESSION["Logado"] = TRUE;
                #Criação de variável de sessão que contém o horário em que a sessão foi iniciada
                $_SESSION["hora_acesso"] = time();
                #Criação de variável de sessão para garantir o cookie que vai substituir o required value
                $_SESSION["user_cookie"] = $user;
                header ("Location: areaProdutos.php");
                #Encerramento do bloco de código php
                exit;
            } 
            #Caso o comando SQL não seja devidamente sucedido (as informações estejam incorretas), o administrador não está autorizado!
            else{
                if(!empty($_POST['remember_me'])){
                    setcookie('forbidden', 'true', time()+3600);
                }
            }

        } catch (PDOException $e) {
            echo "<br>" . $e->getMessage();
        }        
        $conn = null;
    }

?>




