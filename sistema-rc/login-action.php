<?php 

require_once 'functions/usuarios.php';

if (isset($_POST['acao'])) {
	if (!empty($_POST['email']) && !empty($_POST['senha'])) {
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

		if (!$email) {
			$_SESSION['flash-danger'] = 'Formato de e-mail inválido!';
			header('Location: login.php');
			exit;
		}
		$senha = filter_var($_POST['senha']);

		if(logarUsuario($email, $senha)) {
			header('Location: index.php');
			exit;
		} else {
			$_SESSION['flash-danger'] = 'Usuário e/ou senha inválido(s)!';
			header('Location: login.php');
			exit;
		}

	} else {
		$_SESSION['flash-danger'] = 'Todos os campos devem ser preenchidos!';
		header('Location: login.php');
		exit;
	}
}
