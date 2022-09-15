<?php
include('conexao.php');

if(isset($_POST['uemail']) || isset($_POST['psw'])) {

    if(strlen($_POST['uemail']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['psw']) == 0) {
        echo "Preencha sua psw";
    } else {

        $uemail = $mysqli->real_escape_string($_POST['uemail']);
        $psw = $mysqli->real_escape_string($_POST['psw']);

        $sql_code = "SELECT * FROM usuarios WHERE uemail = '$uemail' AND psw = '$psw'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['uname'] = $usuario['uname'];

            header("Location: painel.php");

        } else {
            echo "Falha ao logar! E-mail ou psw incorretos";
        }

    }

}
?>
