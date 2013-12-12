<div class="span12">
	<h3><?php echo __d('advertising','Advertisements'); ?></h3>
	<?php
		$this->Paginator->options(array(
			'update' => '#advertisements',
			'evalScripts' => true,
			//'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
			//'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
		));		
	?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?>		</th>
				<th><?php echo $this->Paginator->sort('name'); ?>	</th>
				<th><?php echo $this->Paginator->sort('url'); ?>	</th>
				<th><?php echo $this->Paginator->sort('target'); ?>	</th>				
				<th><?php echo $this->Paginator->sort('height',  __d('advertising', 'Height')); ?></th>
				<th><?php echo $this->Paginator->sort('width',  __d('advertising', 'Width')); ?></th>
				<th><?php echo $this->Paginator->sort('published',  __d('advertising', 'Published')); ?></th>
				<th><?php echo __d('advertising','Clicks'); ?></th>
				<th><?php echo __d('advertising','Impressions'); ?></th>
				<th class="actions"><?php echo __d('advertising','Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($advertisements as $advertisement): ?>
				<tr>
					<td><?php echo h($advertisement['Advertisement']['id']); ?>&nbsp;</td>
					<td><?php echo h($advertisement['Advertisement']['name']); ?>&nbsp;</td>
					<td title="<?php echo h($advertisement['Advertisement']['url']); ?>">
						<?php echo $this->Html->link('<i class="icon-share-alt"></i> '.__d('advertising','View'),$advertisement['Advertisement']['url'],array('escape'=>false,'target'=>'_blank')); ?>
						<?php // echo h($advertisement['Advertisement']['url']); ?>&nbsp;
					</td>
					<td><?php echo h($advertisement['Advertisement']['target']); ?>&nbsp;</td>
					<td><?php echo h($advertisement['Advertisement']['height']); ?>&nbsp;</td>
					<td><?php echo h($advertisement['Advertisement']['width']); ?>&nbsp;</td>
					<td><i class="<?php echo ($advertisement['Advertisement']['published'] > '1970-01-01 00:00:00')? 'icon-ok' : 'icon-remove' ?>"></i></td>
					<td><?php echo (int) count($advertisement['Click'])?></td>
					<td><?php echo (int) count($advertisement['Impression'])?></td>
					<td>
						<div class="btn-group">
							<?php echo $this->Tools->link_button('<i class="icon-hand-up"></i>', array('controller'=>'BlocksAdvertisements','action' => 'clicks', $advertisement['BlocksAdvertisement']['id'], 'admin' => true), '#detail-ba', array('class' => 'btn','title'=>__d('advertising','Details Clicks'))); ?>
							<?php echo $this->Tools->link_button('<i class="icon-print"></i> ', array('controller'=>'BlocksAdvertisements','action' => 'impressions', $advertisement['BlocksAdvertisement']['id'], 'admin' => true), '#detail-ba', array('class' => 'btn','title'=>__d('advertising','Details Impressions'))); ?>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $this->Tools->Paginator();?>
	</div>
	<?php // debug($advertisements)?>
	<div id="detail-ba"></div>
</div>