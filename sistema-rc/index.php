<?php 
	require_once 'config.php';

	if (isset($_SESSION['loggedInUserId'])) :
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema GED - Página Inicial</title>
		<meta name="viewport" content="width=device-width=initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" /> 
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>

		<div class="container">
			<p><?= 'Bem-vindo(a), '.$_SESSION['loggedInUserName'].'!' ?></p>
			<p><a href="<?= $base; ?>/logout-action.php">Sair</a></p>
		</div>
		<!-- container -->
	</body>
</html>

<?php 
	else: 
		header('Location: login.php');
		exit;
	endif;	
?>