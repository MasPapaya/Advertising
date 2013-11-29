<div class="span12">
	<h3><?php echo __d('publicity','Clicks'); ?></h3>
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
			<?php foreach ($clicks as $click_day): ?>
				<tr>
					<td><?php echo h($click_day['ViewClick']['total']); ?>&nbsp;</td>
					<td><?php echo h($click_day['ViewClick']['creation_date']); ?>&nbsp;</td>					
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $this->Tools->Paginator();?>
	</div>
	<?php // debug($advertisements)?>
	
</div>