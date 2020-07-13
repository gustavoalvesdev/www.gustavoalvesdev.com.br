<?php 

require_once 'functions/usuarios.php';

if (isset($_POST['acao'])) {
	if (!empty($_POST['email']) && !empty($_POST['senha'])) {
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

		if (emailExiste($email)) {
			echo 'Funcionou! O e-mail existe!';
		} else {
			echo 'Algo deu errado!';
		}

		exit;

		$senha = filter_input(INPUT_POST, $_POST['senha']);
		$senha = password_hash($senha, PASSWORD_DEFAULT);
		$testeSenha = 'admin';
		
		$hashSenha = '$2y$10$uVkz0KJgBe0kCA80y3DRReE.KLFVTEkr69maSovVGRm0h34vs/WJO';

		if (password_verify($testeSenha, $hashSenha)) {
			echo 'OK! Criptografia de senhas funcionando!';
		} else {
			echo 'Erro ao criptografar senhas!';
		}


	}
}
