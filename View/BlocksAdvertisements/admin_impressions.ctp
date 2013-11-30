<div class="span12">
	<h3><?php echo __d('publicity','Impressions'); ?></h3>
	<?php
		$this->Paginator->options(array(
			'update'		=> '#detail-ba',
			'evalScripts'	=> true,
			//'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
			//'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
		));		
	?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('total'); ?>		</th>
				<th><?php echo $this->Paginator->sort('creation_date'); ?>	</th>				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($impressions as $impression_day): ?>
				<tr>
					<td><?php echo h($impression_day['ViewImpression']['total']); ?>&nbsp;</td>
					<td><?php echo h($impression_day['ViewImpression']['creation_date']); ?>&nbsp;</td>					
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $this->Tools->Paginator();?>
	</div>
	<?php // debug($advertisements)?>
	
</div>