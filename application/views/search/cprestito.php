<div class="container">
	<a href="<?php echo site_url('homepage'); ?>" class="btn btn-link pull-right">Nuova ricerca</a>
	<h1>Risultati ricerca</h1>
	<div class="row">
	<?php if (!empty($risultati)) : ?> 
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
		   <table class="table tablesorter hover-highlight" id="prestiti_table">
			  <thead>
					<tr>
						<th>Codice</th>
						<th>Inventario</th>
						<th>Titolo</th>
						<th>Utente</th>
						<th data-placeholder="Tutti"><span class="past">Data prestito</span></th>
						<th data-placeholder="Tutti"><span class="past">Data reso</span></th>						
						<th class="filter-false"><span class="noorder"></span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $risultati->codice; ?></td>
						<td><?php echo strtoupper($risultati->inventario); ?></td>
						<td><?php echo $risultati->titolo; ?></td>
						<td><?php echo $risultati->nome; ?></td>
						<td data-past="<?php echo $risultati->diff_prestito; ?>"><?php echo $risultati->data_prestito; ?></td>
						<td data-past="<?php echo isset($risultati->diff_reso) ? $risultati->diff_reso : "0"; ?>"><?php echo $risultati->data_reso; ?></td>						
						<td class="text-right"><a href="<?php echo site_url('prestiti/scheda/'.$risultati->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-eye"></i></a></td>
					</tr>
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
		<div class="col-xs-12">Nessun risultato</div>
	<?php endif ?>
	</div>	
</div>