<div class="span3">
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('publicity', 'Actions'); ?></li>
			<li><?php echo $this->Html->link(__d('publicity','New Blocks Advertisement'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
	<h2><?php echo __d('publicity','Blocks Advertisements'); ?></h2>
	<?php
		$this->Paginator->options(array(
			'update' => '#content_layout',
			'evalScripts' => true,
			//'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
			//'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
		));		
	?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('block_id'); ?></th>
				<th><?php echo $this->Paginator->sort('advertisement_id'); ?></th>
				<th class="actions"><?php echo __d('publicity','Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($blocksAdvertisements as $blocksAdvertisement): ?>
				<tr>
					<td><?php echo h($blocksAdvertisement['BlocksAdvertisement']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($blocksAdvertisement['Block']['name'], array('controller' => 'blocks', 'action' => 'view', $blocksAdvertisement['Block']['id'])); ?>
					</td>
					<td>
						<?php echo $this->Html->link($blocksAdvertisement['Advertisement']['name'], array('controller' => 'advertisements', 'action' => 'view', $blocksAdvertisement['Advertisement']['id'])); ?>
					</td>
					<td class="actions">
						<?php echo $this->Html->link(__d('publicity','View'), array('action' => 'view', $blocksAdvertisement['BlocksAdvertisement']['id'])); ?>
						<?php echo $this->Html->link(__d('publicity','Edit'), array('action' => 'edit', $blocksAdvertisement['BlocksAdvertisement']['id'])); ?>
						<?php echo $this->Form->postLink(__d('publicity','Delete'), array('action' => 'delete', $blocksAdvertisement['BlocksAdvertisement']['id']), null, __d('publicity','Are you sure you want to delete # %s?', $blocksAdvertisement['BlocksAdvertisement']['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php
			echo $this->Tools->Paginator();
		?>
	</div>
</div>