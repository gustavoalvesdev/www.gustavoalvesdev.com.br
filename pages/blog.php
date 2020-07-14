<?php 
	$url = explode('/', $_GET['url']);
	if (!isset($url[2])) :
		@$categoria = Blog::getCategoriaBySlug($url[1]);		
?>	
<section class="header-noticias">
	<div class="center">
		<h2><i class="fa fa-bell-o" aria-hidden="true"></i></h2>
		<h2>Acompanhe os últimos <b>posts do blog</b></h2>
	</div>
	<!-- center -->
</section>
<!-- header-noticias -->
<section class="container-portal">
	<div class="container">
		<div class="sidebar">
			<div class="box-content-sidebar">
				<h3><i class="fa fa-search" aria-hidden="true"></i> Realizar uma busca</h3>
				<form method="POST">
					<input type="text" name="parametro" placeholder="O que deseja procurar?" required />
					<input type="submit" name="buscar" value="Pesquisar!" />
				</form>
			</div>
			<!-- box-content-sidebar -->
			<div class="box-content-sidebar">
				<h3><i class="fa fa-list-ul" aria-hidden="true"></i> Selecione a categoria</h3>
				<form>
					<select name="categoria">
						<option value="">Todas as categorias</option>
						<?php 
							$categorias = Blog::getAllCategories();
							
							foreach($categorias as $key => $value) :
						?>
							<option <?php if (isset($url[1]) && $value['slug'] == $url[1]) echo 'selected'; ?> value="<?= $value['slug']; ?>"><?= $value['nome']; ?></option>
						<?php endforeach; ?>
					</select>
				</form>
			</div>
			<!-- box-content-sidebar -->
			<div class="box-content-sidebar">
				<h3><i class="fa fa-user" aria-hidden="true"></i> Sobre o autor</h3>
				<div class="autor-box-portal">
					<div class="box-img-autor"></div>
					<!-- box-img-autor -->
					<div class="texto-autor-portal text-center">
						<?php 
							$infoSite = MySql::conectar()->prepare('SELECT * FROM `tb_site.config`');
							$infoSite->execute();
							$infoSite = $infoSite->fetch();
						?>
						<h3><?= $infoSite['nome_autor']; ?></h3>
						<p><?= substr($infoSite['descricao'], 0, 400).'...' ?><a href="<?= INCLUDE_PATH; ?>sobre-equipe">Saiba Mais</a></p>
					</div>
					<!-- texto-autor-portal -->
				</div>
				<!-- autor-box-portal -->
			</div>
			<!-- box-content-sidebar -->
		</div>
		<!-- sidebar -->

		<div class="conteudo-portal">
			<div class="header-conteudo-portal">
				<?php 
					if (!isset($categoria['nome'])) :

				?>
					<h2>Visualizando todos os Posts</h2>
				<?php else: ?>
					<h2>Visualizando posts em <span><?= $categoria['nome']; ?></span></h2>
				<?php endif; ?>

				<?php 
					$porPagina = 10;
					$query = 'SELECT * FROM `tb_site.noticias`';

					if(isset($categoria['nome'])) {
						$query .= ' WHERE categoria_id = '.$categoria['id'];
					}

					if (isset($_POST['parametro'])) {
						$busca = $_POST['parametro'];
						if (strstr($query, 'WHERE')) {
							$query .= ' AND titulo LIKE "%'.$busca.'%"';
						} else {
							$query .= ' WHERE titulo LIKE "%'.$busca.'%"';
						}
					}

					if (isset($_GET['pagina'])) {
						
						$pagina = (int)$_GET['pagina'];
						$queryPg = ($pagina - 1) * $porPagina;
						$query .= ' ORDER BY id DESC LIMIT '.$queryPg.','.$porPagina;	
					} else {
						$pagina = 1;
						$query .= ' ORDER BY id DESC LIMIT 0, '.$porPagina;
					}

					$sql = MySql::conectar()->prepare($query);
					$sql->execute();
					$noticias = $sql->fetchAll();
				?>
			</div>
			<!-- header-conteudo-portal -->
			<?php 
				foreach($noticias as $key => $value) :
					$sql = MySql::conectar()->prepare('SELECT nome, slug FROM `tb_site.categorias` WHERE id = ?');
					$sql->execute(array($value['categoria_id']));
					$categoriaFetch = $sql->fetch();

					$categoriaNome = $categoriaFetch['nome'];
					$categoriaSlug = $categoriaFetch['slug'];
			?>
			<div class="box-single-conteudo">
				<h2><?= date('d/m/Y', strtotime($value['data'])); ?> - <?= $value['titulo']; ?></h2>
				<p>
					<?= strip_tags(substr($value['conteudo'], 0, 300)).'...'; ?>
				</p>
				<a href="<?= INCLUDE_PATH; ?>blog/<?= $categoriaSlug; ?>/<?= $value['slug']; ?>">Leia mais</a>
			</div>
			<!-- box-single-conteudo -->
			<?php 
				endforeach;
			?>

			<?php 
				$query = 'SELECT * FROM `tb_site.noticias` ';
				if(isset($categoria['nome'])) {
						$categoriaId = (int)$categoria['id'];
						$query .= ' WHERE categoria_id = '.$categoriaId;
					}
				$totalPaginas = MySql::conectar()->prepare($query);
				$totalPaginas->execute();
				$totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
			?>	

			<div class="paginator">
				<?php 
					for ($i = 1; $i <= $totalPaginas; $i++) {
						//$catStr = (isset($categoria['nome'])) ? $categoriaSlug : '';
						if (isset($categoria['nome']) && !empty($categoria['nome'])) {
							if (isset($categoriaSlug)) {
								$catStr = '/'.$categoriaSlug;
							} else {
								$catStr = '';
							}
						} else {
							$catStr = '';
						}
						if ((int)$pagina == $i)
							echo '<a class="active-page" href="'.INCLUDE_PATH.'blog'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
						else 
							echo '<a href="'.INCLUDE_PATH.'blog'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
						// 15:40 - PHP portal 3/5
					}
				?>
			</div>
			<!-- paginator -->
		</div>
		<!-- conteudo-portal -->

		<div class="clear"></div>
		<!-- clear -->
	</div>
	<!-- container -->
</section>
<!-- container-portal -->
<?php
	else:
		require_once 'post.php';
	endif;
?>