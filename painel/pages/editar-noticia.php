<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$noticia = Painel::select('tb_site.noticias','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Notícia</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				//Enviei o meu formulário.
				
				$titulo = $_POST['titulo'];
				$conteudo = $_POST['conteudo'];
				$capa = $_FILES['capa'];
				$capa_atual = $_POST['capa_atual'];
				$categoria_id = $_POST['categoria_id'];
				
				$verifica = MySql::conectar()->prepare('SELECT id FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?');
				$verifica->execute(array($titulo, $categoria_id, $id));

				if ($verifica->rowCount() == 0) {
					if($capa['name'] != ''){

						//Existe o upload de imagem.
						if(Painel::imagemValida($capa)){
							Painel::deleteFile($capa_atual);
							$capa = Painel::uploadFile($capa);
							$arr = ['titulo'=>$titulo, 'conteudo' => $conteudo, 'capa'=>$capa,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
							Painel::update($arr);
							$noticia = Painel::select('tb_site.noticias','id = ?',array($id));
							Painel::alert('sucesso','A notícia foi editada junto com a capa!');
						}else{
							Painel::alert('erro','O formato da imagem não é válido');
						}
					}else{
						$capa = $capa_atual;
						$arr = ['titulo'=>$titulo, 'data' => date('Y-m-d'), 'conteudo' => $conteudo, 'categoria_id' => $categoria_id,  'capa'=>$capa,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
						Painel::update($arr);
						$noticia = Painel::select('tb_site.noticias','id = ?',array($id));
						Painel::alert('sucesso','A notícia foi editada com sucesso!');
					}
				} else {
					Painel::alert('erro','Já existe uma notícia com este título!');
				}
				

			}
		?>

		<div class="form-group">
			<label>Título:</label>
			<input type="text" name="titulo" value="<?php echo $noticia['titulo']; ?>" required>
		</div><!--form-group-->

		<div class="form-group">
			<label>Conteúdo:</label>
			<textarea class="tinymce" name="conteudo" required><?php echo $noticia['conteudo']; ?></textarea>
			<!-- tinymce -->
		</div>
		<!--form-group-->

		<div class="form-group">
			<label>Categoria:</label>
			<select name="categoria_id">
				<?php 
					$categorias = Painel::selectAll('tb_site.categorias');
					foreach ($categorias as $key => $value) :
				?>
					<option <?php if($value['id'] == $noticia['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
				<?php 
					endforeach;
				?>
			</select>
		</div>
		<!-- form-group -->

		<div class="form-group">
			<label>Capa</label>
			<input type="file" name="capa"/>
			<input type="hidden" name="capa_atual" value="<?php echo $noticia['capa']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->