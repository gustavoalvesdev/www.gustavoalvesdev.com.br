<?php
	if(isset($_GET['excluir'])){
		$serviceId = intval($_GET['excluir']);
		Servico::deleteService($serviceId);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.servicos',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 4;
	
	$servicos = Painel::selectAll('tb_site.servicos',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Serviços Cadastrados</h2>

	<?php $services = Servico::getAllServices(); ?>

	<div class="wraper-table">
	<table>
		<tr>
			<td>Título</td>
			<td>Descrição</td>
			<td>Ícone</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
		</tr>

		<?php
			foreach ($services as $key => $service) {
		?>
		<tr>
			<td><?php echo $service['titulo_servico']; ?></td>

			<td><?php echo $service['descricao_servico']; ?></td>

			<td><?php echo $service['icone_servico']; ?></td>

			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servico?id=<?php echo $service['id']; ?>"><i class="far fa-edit"></i> Editar</a></td>

			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $service['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>

			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $service['id'] ?>"><i class="fa fa-angle-up"></i></a></td>

			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $service['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
		</tr>

		<?php } ?>

	</table>
	</div>

	<!-- <div class="paginacao">
		<?php
			//$totalPaginas = ceil(count(Painel::selectAll('tb_site.servicos')) / $porPagina);

			//for($i = 1; $i <= $totalPaginas; $i++){
				//if($i == $paginaAtual)
					//echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
				//else
					//echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
			//}

		?>
	</div> -->


</div><!--box-content-->