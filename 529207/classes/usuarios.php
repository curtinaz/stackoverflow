<?php 

class Usuario 
{
    private $pdo;
    public $msgErro = ""; // tudo ok

    public function conectar($nome = null, $host = null, $email = null, $senha = null)
    {
        global $pdo;
        global $msgErro;
        try 
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$email,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome = null, $telefone = null, $email = null, $senha = null)
    {
        global $pdo;
        global $msgErro;
        //verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_usuarios FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; //já está cadastado
        }
        else
        {
        //caso não esteja
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;//cadastrado com sucesso

        }

    }

    public function logar($email = null, $senha = null)
    {
        global $pdo;
        global $msgErro;
        //verificar o email e a senha estão cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuarios FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e,",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute(array(':e' => $email, ':s' => $senha));
        if($sql->rowCount() > 0)
        {
            //entrar no sistema (sessão)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuarios'] = $dado['id_usuarios'];
            return true; //logado com sucesso

        }
        else
        {
            return false; //não foi possivel logar
        }
    }

}

?>