<?php 
	$url = explode('/', $_GET['url']);
	$categoriaExiste = Blog::categoriaExiste($url[1]);
	$categoriaId = Blog::getCategoriaId($url[1]);
	$postExiste = Blog::postExiste($url[2], $categoriaId);

	if (!$categoriaExiste)
		Painel::redirect(INCLUDE_PATH.'blog');
	else {
		if (!$postExiste)
			Painel::redirect(INCLUDE_PATH.'blog');
		else
			$post = Blog::getPost($url[2], $categoriaId);
	}

?>
<section class="noticia-single">
	<div class="container">
		<header>
			<h1><i class="fa fa-calendar" style="font-size: 22px;"></i> <span style="font-size: 26px;"><?= date('d/m/Y', strtotime($post['data'])); ?></span> - <?= $post['titulo']; ?></h1>
		</header>
		
		<h4>Compartilhe:</h4>
		
		<ul class="sociais">
			<li><a style="color:black" href="https://www.facebook.com/sharer/sharer.php?u=<?= INCLUDE_PATH.$url[1].'/'.$url[2]; ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
			<li><a style="color:black" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= INCLUDE_PATH.$url[1].'/'.$url[2]; ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
			<li><a style="color:black" href="https://api.whatsapp.com/send?text=<?= INCLUDE_PATH.$url[1].'/'.$url[2]; ?>" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
			<div class="clear"></div>
			<!-- clear -->
		</ul>
		<!-- sociais -->
		
		<article>

			<?= $post['conteudo']; ?>

		</article>
	</div>
	<!-- container -->
	
</section>
<!-- noticia-single -->

<div class="container">
    <div id="disqus_thread"></div>
        <script>
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://https-www-gustavoalvesdev-com-br.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
<!-- container -->
