<div class="container margin-top padding-med-reset">

	<div class="row no-margin">
		<ol class="breadcrumb">
			<?php echo $info['migalhas']; ?>
			<li class="active">
				<a href="#" class="breadcump"><?php echo $produto; ?></a>
			</li>
		</ol>
	</div>

	<div class="row no-margin margin-top margin-left-reset margin-right-reset">
		<?php
			if( isset( $images ) && count( $images ) > 0 ) {
		?>
				<div class="col-lg-6 col-sm-7 no-padding">
					<div class="col-lg-12 no-padding produto-imagem">
						<img id="img_01" class="zoom-img" src="<?php echo $imageDefault; ?>" data-zoom-image="<?php echo $imageDefault; ?>"/> 
					</div>

					<div class="col-lg-12 no-padding">
						<div id="gallery_01"> 
						<?php
							foreach ( $images as $key => $value ) {
						?>
								<a href="#" data-image="<?php echo $value; ?>" data-zoom-image="<?php echo $value; ?>"> 
									<img width='100' id="img_01" class="produto-slide" src="<?php echo $value; ?>" /> 
								</a> 
						<?php
							}
						?>
						</div>
					</div>
				</div>
		<?php
			}
		?>
		<div class="col-lg-6 col-sm-5 no-padding">
			<div class="col-lg-12 padding-right-reset">
				<h1 class="color-black font-poppins-bold produto-titulo"><?php echo $produto; ?></h1>

				<hr />

			</div>

			<div class="col-lg-12 padding-right-reset">
				
				<div class="produto-container-desc">
					
					<!--<p class="font-poppins color-black produto-estoque">In stock</p>-->

					<p class="font-poppins color-black produto-desc">
						<?php echo $info['descricao']; ?>
					</p>

				</div>

				<div class="produto-container-preco">
					
					<h2 class="font-poppins-bold color-price produto-preco"> <?php echo $info['valor']; ?></h2>

					<hr />

				</div>

			</div>

			<div class="col-lg-12 padding-right-reset">
				

				<div class="container-quantidade pull-left" style="width:22%;">
					
				
					<div class="input-group">
						<span class="input-group-btn">
						<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
							<span class="glyphicon glyphicon-minus"></span>
						</button>
						</span>
						<input type="text" name="quant[1]" id="quantity" class="form-control input-number" value="1" min="1" max="999">
						<span class="input-group-btn">
						<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
						</span>
					</div>

				
						<!--<input type="number" size="4" max="10" class="control-form" title="Qty" value="1" name="quantity" id='quantity' min="1" step="1">-->
				</div>

				<div class="container-add-carrinho ">
					<button class="btn btn-carrinho" data-id="<?php echo $id; ?>"> Adicionar ao carrinho</button>
				</div>

				<hr />

			</div>

			<div class="col-lg-12 padding-right-reset">

				<div class="container-categoria">
					<p> <span class="font-poppins-bold font-big"> CATEGORIA: </span>  <span class="produto-categoria"> carro </span> </p>
				</div>

				<hr />
				
			</div>
		</div>
		
	</div>

	<div class="row no-margin margin-top margin-left-reset margin-right-reset">
		<div class="col-lg-12 no-padding produto-detalhes-container">
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#descricao" data-toggle="tab">Descrição</a></li>
					<!--<li><a href="#revisao" data-toggle="tab">Revisão</a></li>-->
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="descricao">
						<p class="font-poppins color-black produto-detalhes-desc">
							<?php echo html_entity_decode($info['descComp']); ?>
						</p>
					</div>
			        <!--
			         COMENTARIOS DO PRODUTO
			         <div class="tab-pane" id="revisao">
			         	<div class="revisao-container">
			         		<div class="comentarios">
			         			<h2> 1 REVISÃO PARA <?php echo mb_strtoupper( $produto, 'UTF-8' ); ?></h2>

			         			<ol class="comentarios-lista">
			         				<li class="comentario-linha">
			         					<div class="produto-container-avatar">
			         						<img src="{url}assets/images/small/image4.png" class="avatar">
			         					</div>
										<div class="comentario-linha-texto">
											<p class="font-poppins font-big color-black comentario-titulo"> <strong>ADMIN</strong> - <time datetime="2015-03-23T04:48:26+00:00">March 23, 2015</time> </p>

											<div class="comentario-texto">
												<p>Lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi.</p>
											</div>
										</div>			         					
			         				</li>
			         			</ol>
			         		</div>

			         		<div class="adicionar-comentario">
			         			<h2> COMENTAR </h2>

			         			<form>
			         				<div class="form-comentario-linha">
				         				<span class="font-poppins  color-black margin-top"> Nome: </span>
				         				<input type="text" class="form-control ">
			         				</div>

			         				<div class="form-comentario-linha">
				         				<span class="font-poppins color-black margin-top"> E-mail: </span>
				         				<input type="text" class="form-control ">
				         			</div>

				         			<div class="form-comentario-linha">
				         				<span class="font-poppins color-black margin-top"> Comentário: </span>
				         				<textarea class="form-control "> </textarea>
				         			</div>

			         				<input type="submit" class="btn btn-enviar-comentario margin-top" value="Enviar">
			         			</form>
			         		</div>
			         	</div>
			         </div>
			     -->
			 </div>
			</div>
		</div>
	</div>

	<?php 
		if( count( $info['relacionados'] ) > 0 ) {
	?>
	<div class="row no-margin margin-top margin-left-reset margin-right-reset">

		<div class="produtos-relativos pull-left">

			<span class="font-poppins-bold border-right-regular padding-padrao font-big titulo-produtos-relativos pull-left"> PRODUTOS RELACIONADOS </span>

			<span class="padding-padrao slick-arrows-relativos pull-right relative">  </span>  

		</div>

		<div class="slick-slider width clear border-reset">
			<?php

				$relacionados  =   $info['relacionados'];
				
				foreach ($relacionados as $key ) {
			?>
			<div class="slick-first-relativo">
				<div class="row padding-padrao padding-bottom-reset  min-margin-right-reset relative">
					<div class="col-lg-12 col-md-12 slick-product-image-relativos">
						<a href="<?php echo $key['link']; ?>"><img src="<?php echo $key['image']; ?>" class="img-responsive" /></a>
					</div>
					<div class="col-lg-12 col-md-12 text-produto-relativos">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> <?php echo $key['valor']; ?> </p>
						</div>
					</div>
					<div class="absolute color-black width slick-add-carrinho-relativos align-center ">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href="<?php echo $key['link']; ?>"> <?php echo $key['nome']; ?> </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> <?php echo $key['valor']; ?> </p>

							<div class="padding-right-reset row">

								<div class="container-quantidade" style="margin-left:12px;width:43%">

									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[2]">
												<span class="glyphicon glyphicon-minus"></span>
										</button>
										</span>
										<input size="20" type="text" name="quant[2]" id="quantity-relacionados" class="form-control input-number" value="1" min="1" max="999">
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[2]">
												<span class="glyphicon glyphicon-plus"></span>
										</button>
										</span>
									</div>

									<!--<input type="number" size="4" max="7" class="form-control" title="Qty" value="1" name="quantity" id="quantity-relacionados" min="1" step="1">-->
								</div>
								<br/>
								<br/>
									
								<div class="container-add-carrinho ">
									<button class="btn btn-carrinho-relacionados" data-id="<?php echo $key['value']; ?>"> Adicionar ao carrinho</button>
								</div>

								<br/>

							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
				}
			?>

			<!--
			<div class="slick-second-relativo">
				<div class="row padding-padrao padding-bottom-reset min-margin-right-reset relative">
					<div class="col-lg-12 col-md-12 slick-product-image-relativos">
						<a href=""><img src="{url}assets/images/product1.jpg" class="img-responsive" /></a>
					</div>
					<div class="col-lg-12 col-md-12 text-produto-relativos">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href=""> Notebook Ultra 1 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>
						</div>
					</div>

					<div class="absolute color-black width slick-add-carrinho-relativos align-center ">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href="{url}produtos"> Notebook Ultra 0 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>

							<div class="container-add-carrinho ">
								<button class="btn btn-carrinho"> Adicionar ao carrinho</button>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="slick-third-relativo">
				<div class="row padding-padrao padding-bottom-reset min-margin-right-reset relative">
					<div class="col-lg-12 col-md-12 slick-product-image-relativos">
						<a href=""><img src="{url}assets/images/product1.jpg" class="img-responsive" /></a>
					</div>
					<div class="col-lg-12 col-md-12 text-produto-relativos">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"> <a href=""> Notebook Ultra 2 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>
						</div>
					</div>

					<div class="absolute color-black width slick-add-carrinho-relativos align-center ">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href="{url}produtos"> Notebook Ultra 0 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>

							<div class="container-add-carrinho ">
								<button class="btn btn-carrinho"> Adicionar ao carrinho</button>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="slick-fourth-relativo">
				<div class="row padding-padrao padding-bottom-reset min-margin-right-reset relative">
					<div class="col-lg-12 col-md-12 slick-product-image-relativos">
						<a href=""><img src="{url}assets/images/product1.jpg" class="img-responsive" /></a>
					</div>
					<div class="col-lg-12 col-md-12 text-produto-relativos">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo">  <a href="">Notebook Ultra 3 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>
						</div>
					</div>

					<div class="absolute color-black width slick-add-carrinho-relativos align-center ">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href="{url}produtos"> Notebook Ultra 0 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>

							<div class="container-add-carrinho ">
								<button class="btn btn-carrinho"> Adicionar ao carrinho</button>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="slick-fifth-relativo">
				<div class="row padding-padrao padding-bottom-reset min-margin-right-reset relative">
					<div class="col-lg-12 col-md-12 slick-product-image-relativos">
						<a href=""><img src="{url}assets/images/product1.jpg" class="img-responsive" /></a>
					</div>
					<div class="col-lg-12 col-md-12 text-produto-relativos">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo">  <a href="">Notebook Ultra 4 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>
						</div>
					</div>

					<div class="absolute color-black width slick-add-carrinho-relativos align-center ">
						<div class="slick-container-texto-relativos">
							<p class="font-poppins align-center no-margin slick-titulo"><a href="{url}produtos"> Notebook Ultra 0 </a></p>

							<p class="font-poppins-bold-relativos color-price slick-preco align-center no-margin"> R$: 0.00 </p>

							<div class="container-add-carrinho ">
								<button class="btn btn-carrinho"> Adicionar ao carrinho</button>
							</div>
						</div>
					</div>

				</div>
			</div>
			-->

		</div>
	</div>
	<?php 
		}
	?>
</div>
<script type="text/javascript">
	var baseUrlAjaxCarrinho  =  '{url}' + 'ajax/carrinho/';
	var baseUrl  =  '{url}';
	var page = 'produto';
</script>






