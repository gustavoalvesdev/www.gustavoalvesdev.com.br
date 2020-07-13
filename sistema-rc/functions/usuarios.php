<?php 

require_once 'config.php';
require_once 'connection/DefaultConnection.php';

$pdo = DefaultConnection::getConnection();

function emailExiste($email) {
	global $pdo;
	$sql = 'SELECT email FROM usuarios WHERE email = :email LIMIT 1';
	$sql = $pdo->prepare($sql);
	$sql->bindValue(':email', $email);
	$sql->execute();

	if ($sql->rowCount() === 1) {
		return true;
	}
	return false;

}

function logarUsuario($email, $senha) {
	if(emailExiste($email)) {
		$sql = 'SELECT * FROM usuarios WHERE email = :email LIMIT 1';
		global $pdo;
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->execute();

		$sql = $sql->fetch(PDO::FETCH_ASSOC);

		$senha = password_verify($senha, $sql['senha']);
		if ($senha) {
			$_SESSION['loggedInUserId'] = $sql['id'];
			$_SESSION['loggedInUserName'] = $sql['nome'];
			return true;
		}
		return false;
	} 
	return false;
}
