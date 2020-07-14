<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
	$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	$infoSite->execute();
	$infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    
<title><?= (isset($_GET['url']) && $_GET['url'] == 'blog') ? 'Gustavo Alves - Artigos do Blog' : $infoSite['titulo']; ?></title>
<meta property="og:title" content="<?= (isset($_GET['url']) && $_GET['url'] == 'blog') ? 'Gustavo Alves - Artigos do Blog' : $infoSite['titulo']; ?>" />
<meta property="og:url" content="<?= (isset($_GET['url']) && $_GET['url'] == 'blog') ? 'https://www.gustavoalvesdev.com.br/blog' : 'https://www.gustavoalvesdev.com.br' ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?= (isset($_GET['url']) && $_GET['url'] == 'blog') ? 'https://www.gustavoalvesdev.com.br/images/blog.jpg' : 'https://www.gustavoalvesdev.com.br/painel/uploads/5ee1992742994.jpg' ?>" />
<meta name="description" content="<?= (isset($_GET['url']) && $_GET['url'] == 'blog') ? 'Blog com conteúdo gratuito sobre marketing digital, analytics, SEO, dicas de negócio, empreendedorismo, desenvolvimento web e mobile e muito mais!' : 'Gustavo Alves, Desenvolvedor Web. Desenvolvimento de Sites, Sistemas e Aplicativos em São Paulo. Whatsapp: (11) 99653-1308 / E-mail: contato@gustavoalvesdev.com.br' ?>" />
<meta property="og:title" content="<?php echo $infoSite['titulo']; ?>" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link href="<?php echo INCLUDE_PATH; ?>estilo/style.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/animate.css" />
<link rel="stylesheet" href="<?= ICONS_URL; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="desenvolvimento,sites,aplicativos,web,sao paulo,ferraz,desenvolver app" />


    
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.png" type="image/png" />
	<meta charset="utf-8" />
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
		$url[0] = isset($_GET['url']) ? strtolower($_GET['url']) : 'home';
		switch ($url[0]) {
			case 'servicos':
				echo '<target target="servicos" />';
				break;

			case 'sobre-equipe':
				echo '<target target="sobre-equipe" />';
				break;
		}
	?>
	<header>
		<div class="container">
			<a href="<?= INCLUDE_PATH; ?>"><div class="logo left"><?= $infoSite['titulo']; ?></div><!--logo--></a>
			<nav class="desktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre-equipe">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>blog">Blog</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
			 <nav class="mobile right">
			 	<div class="botao-menu-mobile">
			 		<i class="fa fa-bars" aria-hidden="true"></i>
			 	</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre-equipe">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>Blog">Blog</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
		<div class="clear"></div><!--clear-->
		</div>
		<!-- container -->
	</header>

	<div class="container-principal">
	<?php

		if(file_exists('pages/'.strtolower($url[0]).'.php')){
			include('pages/'.strtolower($url[0]).'.php');
		}else{
			//Podemos fazer o que quiser, pois a página não existe.
			if(strtolower($url[0]) != 'servicos' && strtolower($url[0]) != 'sobre-equipe'){
				$urlPar = explode('/', $url[0])[0];
				if (strtolower($urlPar != 'blog')) {
					$pagina404 = true;
					require_once 'pages/404.php';
				} else {
					require_once 'pages/blog.php';
				}
				
			}else{
				require_once 'pages/home.php';
			}
		}

	?>

	</div><!--container-principal-->

	<footer class="footer">
        <section class="footer-links">
            <div class="container">
                <div class="endereco">
                    <h5>Aonde Estamos</h5>
                    <p>Rua dos Goivos, 19 - CEP: 08544-100</p>
                    <p>(11) 99653-1308</p>
                </div>
                <!-- endereco -->
                <div class="links">
                    <h5>Links Úteis</h5>
                    <p><a href="https://api.whatsapp.com/send?phone=5511996531308" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></p>
                </div>
                <!-- links -->
                <div class="redes">
                    <h5>Conecte-se Conosco</h5>
                    <p><a href="https://www.facebook.com/gustavoalvesdasilva2509" target="_blank"><i class="fab fa-facebook-square"></i></a><a href="https://www.instagram.com/gugaalves2509" target="_blank"><i class="fab fa-instagram"></i></a></p>
                </div>
                <!-- redes -->
            </div>
            <!-- container -->
        </section>
        <!-- footer-links -->
        <section class="footer-direitos">
            <div class="container">
                <p>Todos os direitos reservados</p>
            </div>
            <!-- container -->
        </section>
        <!-- footer-direitos -->
    </footer>
    <!-- footer -->

	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/wow.min.js"></script>
	<script type="text/javascript">
		wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 100
        });

        wow.init();
	</script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>

	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

	<?php if (strstr($url[0], 'blog')) : ?>
		<script>
			$(function(){
				$('select').change(function(){
					location.href = include_path + 'blog/' + $(this).val();
				});
			});
		</script>
	<?php endif; ?>
	<?php
		if($url[0] == 'contato'){
	?>
	<?php } ?>
	<!--<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>-->
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
</body>
</html>