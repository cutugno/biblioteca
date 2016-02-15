<div class="container">
	<h1>Elenco utenti</h1>
	<div class="row">
	  <?php if (!empty($utenti)) : ?> 	
	  <div class="col-xs-12 pagin text-left">
		<form>
			<img src="<?php echo site_url('images/icons/first.png'); ?>" class="first"/>
			<img src="<?php echo site_url('images/icons/prev.png'); ?>" class="prev"/>
			<input type="text" class="pagedisplay form-control input-sm" style="width:130px; display:inline;background: #fff" readonly />
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
		  <table class="table tablesorter hover-highlight" id="utenti_table">
			  <thead>
					<tr>
						<th>Nome</th>
						<th class="filter-select" data-placeholder="Tutte">Classe</th>
						<th>Email</th>
						<th>Telefono</th>
						<th class="filter-select" data-placeholder="Tutti">Livello</th>
						<th class="filter-false"><span class="noorder"></span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($utenti as $val): ?>
					<tr>
						<td><?php echo $val->nome; ?></td>
						<td><?php echo $val->classe; ?></td>
						<td><?php echo $val->email; ?></td>
						<td><?php echo $val->telefono; ?></td>
						<td><?php echo $val->livello; ?></td>					
						<td class="text-right">
							<a href="<?php echo site_url('utenti/scheda/'.$val->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-eye"></i></a>							
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
			<input type="text" class="pagedisplay form-control input-sm" style="width:130px; display:inline;background: #fff" readonly />
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
	  <div class="col-xs-12">Nessun utente presente</div>
	  <?php endif ?>
	</div>
</div>