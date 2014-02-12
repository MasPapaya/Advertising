<div class="span12">
	<h3><?php echo __d('advertising','Blocks'); ?></h3>
	<?php
		$this->Paginator->options(array(
			'update' => '#blocks',
			'evalScripts' => true,
			//'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
			//'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
		));		
	?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('alias'); ?></th>
				<th><?php echo $this->Paginator->sort('multiple'); ?></th>
				<th><?php echo $this->Paginator->sort('height',  __d('advertising', 'Height')); ?></th>
				<th><?php echo $this->Paginator->sort('width',  __d('advertising', 'Width')); ?></th>
				<th><?php echo $this->Paginator->sort('published',  __d('advertising', 'Published')); ?></th>
				<th><?php echo __d('advertising','Clicks'); ?></th>
				<th><?php echo __d('advertising','Impressions'); ?></th>
				<th class="actions"><?php echo __d('advertising','Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($blocks as $block): ?>
				<tr>
					<td><?php echo h($block['Block']['id']); ?>&nbsp;</td>
					<td><?php echo h($block['Block']['name']); ?>&nbsp;</td>
					<td><?php echo h($block['Block']['alias']); ?>&nbsp;</td>					
					<td><i class="<?php echo ($block['Block']['multiple'])? 'icon-ok' : 'icon-remove' ?>"></i></td>
					<td><?php echo h($block['Block']['height']); ?>&nbsp;</td>
					<td><?php echo h($block['Block']['width']); ?>&nbsp;</td>
					<td><i class="<?php echo ($block['Block']['published'] > '1970-01-01 00:00:00')? 'icon-ok' : 'icon-remove' ?>"></i></td>
					<td><?php echo (int) count($block['Click'])?></td>
					<td><?php echo (int) count($block['Impression'])?></td>
					<td>
						<div class="btn-group">
							<?php echo $this->Tools->link_button('<i class="icon-hand-up"></i>', array('controller'=>'BlocksAdvertisements','action' => 'clicks', $block['BlocksAdvertisement']['id'], 'admin' => true), '#detail-ba', array('class' => 'btn','title'=>__d('advertising','Details Clicks'))); ?>
							<?php echo $this->Tools->link_button('<i class="icon-print"></i> ', array('controller'=>'BlocksAdvertisements','action' => 'impressions', $block['BlocksAdvertisement']['id'], 'admin' => true), '#detail-ba', array('class' => 'btn','title'=>__d('advertising','Details Impressions'))); ?>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $this->Tools->Paginator(); ?>
	</div>	
	<?php // debug($blocks)?>
	<div id="detail-ba"></div>
</div>