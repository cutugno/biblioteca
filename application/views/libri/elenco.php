<div class="container">
	<h1>Elenco libri</h1>
	<div class="row">
	  <div class="col-xs-12 pagin text-left">
		<form>
			<img src="<?php echo site_url('images/icons/first.png'); ?>" class="first"/>
			<img src="<?php echo site_url('images/icons/prev.png'); ?>" class="prev"/>
			<input type="text" class="pagedisplay" readonly />
			<img src="<?php echo site_url('images/icons/next.png'); ?>" class="next"/>
			<img src="<?php echo site_url('images/icons/last.png'); ?>" class="last"/>
			<select class="pagesize">
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
						<th class="filter-select" data-placeholder="Tutti">Genere</th>
						<th>Editore</th>
						<th>ISBN</th>
						<th>CDD</th>
						<th data-placeholder="Tutti" class="text-center"><span class="disp">Disp.le</span></th>
						<th class="filter-false"><span class="noorder"></span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($libri as $val): ?>
					<tr>
						<td><?php echo strtoupper($val->inventario); ?></td>
						<td><?php echo $val->titolo; ?></td>
						<td><?php echo $val->autore; ?></td>
						<td><?php echo $val->localizzazione; ?></td>
						<td><?php echo $val->genere; ?></td>
						<td><?php echo $val->editore; ?></td>
						<td><?php echo $val->isbn; ?></td>
						<td><?php echo $val->cdd; ?></td>
						<td data-disp="<?php echo $val->disp; ?>" class="text-center"><?php $disp=$val->disp ? "success" : "danger" ; ?><i class='fa fa-circle fa-2x <?php echo $disp; ?>'></i></td>
						<td class="text-right"><a href="<?php echo site_url('libri/scheda/'.$val->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-eye"></i></a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>			
	  </div>
	  <div class="col-xs-12 pagin text-left">
		<form>
			<img src="<?php echo site_url('images/icons/first.png'); ?>" class="first"/>
			<img src="<?php echo site_url('images/icons/prev.png'); ?>" class="prev"/>
			<input type="text" class="pagedisplay" readonly />
			<img src="<?php echo site_url('images/icons/next.png'); ?>" class="next"/>
			<img src="<?php echo site_url('images/icons/last.png'); ?>" class="last"/>
			<select class="pagesize">
				<option selected="selected"  value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
			</select>
		</form>
	  </div>
	</div>
</div>