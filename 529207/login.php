<?php 
require_once 'classes/usuarios.php';
$u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Tela de login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="corpo-form">
    <h1>Entrar</h1>
    <form method="post">
        <input type="text" name="email" placeholder="Email" autocomplete="on">
        <input type="password" name="senha" placeholder="Senha" autocomplete="on">
        <input type="submit" name="enviar" value="Acessar">
        <a href="cadastro.php">Ainda não é inscrito? <strong>Cadastre-se</strong></a>
    </form>
    </div>
<?php
if(isset($_POST['email']))
{
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    //verificar se não está vazio
    if(!empty($email) && !empty($senha))
    {
        $u->conectar("stackoverflow", "localhost","root","");
        if($u->msgErro == "")
        {
            if($u->logar("$email, $senha"))
            {
                header("location:AreaPrivada.php");
            }
            else
            {
                ?>
                <div class="msg-erro">
                Email e/ou senha estão incorretos!
                </div>
                <?php
            }
        }
        else
        {
            echo "Erro: ".$u->msgErro;
        }
    }
    else
    {
            ?>
            <div class="msg-erro">
            Preencha todos os campos!
            </div>
            <?php
    }
}
?>
</body>
</html>