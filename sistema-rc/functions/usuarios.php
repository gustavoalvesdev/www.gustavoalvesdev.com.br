<?php 

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
		$sql = 'SELECT email, senha FROM usuarios WHERE email = :email LIMIT 1';
	}
}
