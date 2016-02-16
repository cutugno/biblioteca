<div class="container">
	<a href="<?php echo site_url('homepage'); ?>" class="btn btn-link pull-right">Nuova ricerca</a>
	<h1>Risultati ricerca</h1>
	<strong>Ricerca avanzata</strong><br>
	<div class="spacer-10"></div>
	<div class="row">
		<div class="col-xs-12" id="criteri">
		<?php if (NULL != $this->session->search['autore']) : ?>
		<i>Autore: </i><?php echo $this->session->search['autore']; ?><br>
		<?php endif ?>
		<?php if (NULL != $this->session->search['titolo']) : ?>
		<i>Titolo: </i><?php echo $this->session->search['titolo']; ?><br>
		<?php endif ?>
		<?php if (NULL != $this->session->search['id_tipodoc']) : ?>
		<i>Tipo documento: </i><?php echo $tipodoc; ?><br>
		<?php endif ?>
		<?php if (NULL != $this->session->search['id_localizzazione']) : ?>
		<i>Localizzazione: </i><?php echo $local; ?><br>
		<?php endif ?>
		<?php if (NULL != $this->session->search['id_argomento']) : ?>
		<i>Argomento: </i><?php echo $argomento; ?>
		<?php endif ?>
		</div>
		<div class="col-xs-12 col-sm-10 col-md-7" id="criteriform" style="display:none">
			<?php 
			  $attr=array("class"=>"form-horizontal", "id"=>"newadvancedsearchlibro");
			  echo form_open("homepage",$attr);
			?>
			  <div class="form-group form-group-sm">
				  <label for="autore" class="col-xs-2 control-label">Autore</label>
				  <div class="col-xs-10">
				  <?php
					$attr=array("class"=>"form-control", "id"=>"autore", "name"=>"autore", "value"=>$this->session->search['autore']);
					echo form_input($attr);
				  ?>
				  </div>
			  </div>
			  <div class="form-group form-group-sm">
				  <label for="titolo" class="col-xs-2 control-label">Titolo</label>
				  <div class="col-xs-10">
				  <?php
					$attr=array("class"=>"form-control", "id"=>"titolo", "name"=>"titolo", "value"=>$this->session->search['titolo']);
					echo form_input($attr);
				  ?>
				  </div>
			  </div>
			  <div class="form-group form-group-sm">
				<label for="id_tipodoc" class="col-xs-2 control-label">Tipo Doc.to</label>
				<div class="col-xs-10">
				<?php
					$options=array(""=>"Seleziona un tipo documento");
					$attr="class=form-control id=id_tipodoc";
					foreach ($select_tipidoc as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_tipodoc', $options, $this->session->search['id_tipodoc'], $attr);
				?>
				</div>				  
			  </div>
			  <div class="form-group form-group-sm">
				<label for="id_localizzazione" class="col-xs-2 control-label">Localiz.ne</label>
				<div class="col-xs-10">
				<?php
					$options=array(""=>"Seleziona una localizzazione");
					$attr="class=form-control id=id_localizzazione";
					foreach ($select_local as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_localizzazione', $options, $this->session->search['id_localizzazione'], $attr);
				?>
				</div>				  
			  </div>
			  <div class="form-group form-group-sm">
				<label for="id_argomento" class="col-xs-2 control-label">Argomento</label>
				<div class="col-xs-10">
				<?php
					$options=array(""=>"Seleziona un argomento");
					$attr="class=form-control id=id_argomento";
					foreach ($select_argomenti as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_argomento', $options, $this->session->search['id_argomento'], $attr);
					echo form_hidden('type', 'cavanzata');
				?>
				</div>				  
			  </div>		  
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" id="modcrit">
			<a id="btn_modcrit" class="btn btn-primary btn-xs">MODIFICA CRITERI</a>
		</div>
		<div class="col-xs-12" id="modcrit2" style="display:none">
			<a id="btn_undocrit" class="btn btn-warning btn-xs">ANNULLA</a>
			<a id="btn_newsearch" class="btn btn-success btn-xs">NUOVA RICERCA</a>		
		</div>
	</div>
	<div class="spacer-25"></div>
	<div class="row">
	  <?php if (!empty($risultati)) : ?> 
	  <div class="col-xs-12 pagin text-left">
		<form>
			<img src="<?php echo site_url('images/icons/first.png'); ?>" class="first"/>
			<img src="<?php echo site_url('images/icons/prev.png'); ?>" class="prev"/>
			<input type="text" class="pagedisplay form-control input-sm" style="width:190px; display:inline;background: #fff" readonly />
			<img src="<?php echo site_url('images/icons/next.png'); ?>" class="next"/>
			<img src="<?php echo site_url('images/icons/last.png'); ?>" class="last"/>
			<select class="pagesize form-control input-sm" style="width:60px; display:inline">
				<option selected="selected"  value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
			</select>
		</form>
	  </div>
	  <div class="col-xs-12 table-responsive">
		  <table class="table tablesorter hover-highlight" id="libri_table">
			  <thead>
					<tr>
						<th>Inventario</th>
						<th>Titolo</th>
						<th>Autore</th>
						<th class="filter-select" data-placeholder="Tutte">Local.ne</th>
						<th class="filter-select" data-placeholder="Tutti">Argomento</th>
						<th>Editore</th>
						<th>ISBN</th>
						<th>CDD</th>
						<th data-placeholder="Tutti" class="text-center"><span class="disp">Disp.le</span></th>
						<th class="filter-false"><span class="noorder"></span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($risultati as $val): ?>
					<tr>
						<td><?php echo strtoupper($val->inventario); ?></td>
						<td><?php echo $val->titolo; ?></td>
						<td><?php echo $val->autore; ?></td>
						<td><?php echo $val->localizzazione; ?></td>
						<td><?php echo $val->argomento; ?></td>
						<td><?php echo $val->editore; ?></td>
						<td><?php echo $val->isbn; ?></td>
						<td><?php echo $val->cdd; ?></td>
						<td data-disp="<?php echo $val->disp; ?>" class="text-center"><?php $disp=$val->disp ? "success" : "danger" ; ?><i class='fa fa-circle fa-2x <?php echo $disp; ?>'></i></td>
						<td class="text-right">
							<a href="<?php echo site_url('libri/scheda/'.$val->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-eye"></i></a>							
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>			
	  </div>
	  <div class="col-xs-12 pagin text-left">
		<form>
			<img src="<?php echo site_url('images/icons/first.png'); ?>" class="first"/>
			<img src="<?php echo site_url('images/icons/prev.png'); ?>" class="prev"/>
			<input type="text" class="pagedisplay form-control input-sm" style="width:190px; display:inline;background: #fff" readonly />
			<img src="<?php echo site_url('images/icons/next.png'); ?>" class="next"/>
			<img src="<?php echo site_url('images/icons/last.png'); ?>" class="last"/>
			<select class="pagesize form-control input-sm" style="width:60px; display:inline">
				<option selected="selected"  value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
			</select>
		</form>
	  </div>
	  <?php else : ?>
	  <div class="col-xs-12">Nessun risultato</div>
	  <?php endif ?>
	</div>
</div>