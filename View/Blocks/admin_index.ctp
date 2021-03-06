<div class="allowedR_Types">
	<?php echo $this->Html->link('<i class="icon-plus-sign icon-white"></i>&nbsp;' . __d('advertising', 'New Block'), array('action' => 'add', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
	<div>
		<h2><?php echo __d('advertising', 'Blocks'); ?></h2>
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
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('alias'); ?></th>
					<th><?php echo $this->Paginator->sort('multiple'); ?></th>
					<th><?php echo $this->Paginator->sort('published', __d('advertising', 'Published')); ?></th>
					<th class="actions"><?php echo __d('advertising', 'Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($blocks as $block): ?>
					<tr>
						<td><?php echo h($block['Block']['id']); ?>&nbsp;</td>
						<td><?php echo h($block['Block']['name']); ?>&nbsp;</td>
						<td><?php echo h($block['Block']['alias']); ?>&nbsp;</td>
						<td><i class="<?php echo ($block['Block']['multiple']) ? 'icon-ok' : 'icon-remove' ?>"></i></td>
						<td>
							<?php echo $this->Tools->link_button(($block['Block']['published'] == Configure::read('zero_datetime')) ? '<i class=" icon-remove"></i>' : '<i class="icon-ok"></i>', array('action' => 'published', $block['Block']['id'], 'admin' => true), '#primary-ajax', array('class' => 'btn')); ?>
						</td>
						<td class="actions">
							<div class="btn-group">
								<?php echo $this->Tools->link_button('<i class="icon-tags"></i>', array('action' => 'get_code', $block['Block']['id'], 'admin' => true), '#advertisements', array('class' => 'btn')); ?>
								<?php echo $this->Tools->link_button('<i class="icon-picture"></i>', array('controller' => 'BlocksAdvertisements', 'action' => 'advertisements', $block['Block']['id'], 'admin' => true), '#advertisements', array('class' => 'btn')); ?>
								<?php echo $this->Html->link('<i class="icon-eye-open"></i>', array('action' => 'view', $block['Block']['id']), array('class' => 'btn', 'escape' => false)); ?>
								<?php echo $this->Html->link('<i class="icon-edit"></i>', array('action' => 'edit', $block['Block']['id']), array('class' => 'btn', 'escape' => false)); ?>

								<?php echo $this->Form->postLink('<i class="icon-white icon-trash"></i>', array('action' => 'delete', $block['Block']['id']), array('class' => 'btn btn-danger', 'escape' => false), __d('advertising', 'Are you sure you want to delete # %s?', $block['Block']['id'])); ?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="pagination pagination-centered">
			<?php echo $this->Tools->Paginator(); ?>
		</div>
		<div id="advertisements"></div>
	</div>
</div>