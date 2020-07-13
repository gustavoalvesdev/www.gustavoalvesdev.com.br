<?php 
	require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title>Sistema GED - Login</title>
		<meta name="viewport" content="width=device-width=initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" /> 
		<link rel="stylesheet" href="css/login.css" />
	</head>
	<body>

		<div class="area">
			<a href="<?= $base; ?>"><img class="logo" src="<?= $base; ?>/images/logo.png" alt="logo da rc sinalização" /></a>
			<!-- logo -->
			<h1>Entrar no Sistema</h1>
			<form method="POST" action="<?= $base; ?>/login-action.php">
				<?php if (!empty($_SESSION['flash-danger'])): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong><?= $_SESSION['flash-danger']; ?></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<!-- close -->
					</div>
					<!-- alert -->
					<?php unset($_SESSION['flash-danger']); ?>
				<?php endif; ?>
				<?php if (!empty($_SESSION['flash-success'])): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong><?= $_SESSION['flash-success']; ?></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<!-- close -->
					</div>
					<!-- alert -->
					<?php unset($_SESSION['flash-success']); ?>
				<?php endif; ?>
				<input type="email" name="email" placeholder="Digite seu e-mail" class="form-control" />
				<input type="password" name="senha" placeholder="Digite sua senha" class="form-control" />
				<div class="row">
					<div class="col-6">
						<label>
							<input type="checkbox" name="lembrar" />
							Lembrar senha
						</label>
					</div>
					<!-- col-6 -->
					<div class="col-6">
						<input type="submit" class="btn btn-primary btn-lg" name="acao" value="Entrar" />
					</div>
					<!-- col-6 -->
				</div>
				
			</form> 
		</div>
		<!-- area -->

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>