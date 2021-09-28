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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
</head>
<body>
    <div id="corpo-form-cad">
    <h1>Cadastro</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome completo" maxlength="30">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="email" name="email" placeholder="Email" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confSenha" placeholder="Confirmar senha">
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>
    </div>
<?php
//verificar se o botão foi apertado
if(isset($_POST['nome']))

{
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);
    //verificar se não está vazio
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
    {
        $u->conectar("stackoverflow", "localhost","root","");
        if($u->msgErro == "")//não teve nenhum erro
        {
            if ($senha == $confirmarSenha)
            {
                if($u->cadastrar($nome,$telefone,$email,$senha))
                {

                    ?>
                    <div id="msg-sucesso">
                        Cadastado com sucesso! 
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="msg-erro">
                        Email já cadastrado!
                    </div>
                    <?php
                }
            }
            else 
            {
                ?>
                <div class="msg-erro">
                    Senha e confirmar senha não correspondem!
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