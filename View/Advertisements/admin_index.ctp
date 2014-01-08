<div class="advertising">
	<div>		
		<?php
		if (!empty($block_alias)) {
			echo $this->Html->link('<i class="icon-plus-sign icon-white"></i>&nbsp;' . __('New Advertisement'), array('action' => 'add', $block_alias, 'admin' => true), array('escape' => FALSE, 'class' => 'btn btn-primary'));
		} else {
			$block_alias = '';
			echo $this->Html->link('<i class="icon-plus-sign icon-white"></i>&nbsp;' . __('New Advertisement'), array('action' => 'add', 'admin' => true), array('escape' => FALSE, 'class' => 'btn btn-primary'));
		}
		?>

	</div>

	<div>
		<h2><?php echo __d('advertising', 'Advertisements'); ?></h2>
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
					<th><?php echo $this->Paginator->sort('target'); ?></th>
					<th><?php echo $this->Paginator->sort('published', __d('advertising', 'Published')); ?></th>
					<th class="actions"><?php echo __d('advertising', 'Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($advertisements as $advertisement): ?>
					<tr>
						<td><?php echo h($advertisement['Advertisement']['id']); ?>&nbsp;</td>
						<td><?php echo h($advertisement['Advertisement']['name']); ?>&nbsp;</td>
						<td><?php echo h($advertisement['Advertisement']['target']); ?>&nbsp;</td>
						<td>						
							<?php echo $this->Tools->link_button(($advertisement['Advertisement']['published'] == Configure::read('zero_datetime')) ? '<i class=" icon-remove"></i>' : '<i class="icon-ok"></i>', array('action' => 'published', $advertisement['Advertisement']['id'], 'admin' => true), '#primary-ajax', array('class' => 'btn')); ?>
						</td>
						<td class="actions">
							<div class="btn-group">		
								<?php if ($authuser['Group']['name'] == 'superadmin' || $authuser['Group']['name'] == 'admin'): ?>
									<?php echo $this->Tools->link_button('<i class="icon-th"></i>', array('controller' => 'BlocksAdvertisements', 'action' => 'blocks', $advertisement['Advertisement']['id'], $block_alias, 'admin' => true), '#blocks', array('class' => 'btn')); ?>
								<?php endif; ?>
								<?php echo $this->Html->link('<i class="icon-eye-open"></i>', array('action' => 'view', $advertisement['Advertisement']['id'] . $block_alias), array('class' => 'btn', 'escape' => false)); ?>
								<?php echo $this->Html->link('<i class="icon-edit"></i>', array('action' => 'edit', $advertisement['Advertisement']['id'], $block_alias), array('class' => 'btn', 'escape' => false)); ?>
								<?php
								if (CakePlugin::loaded('Resources')) {
									echo $this->Frame->link('icon-film', 'frame', 'advertising', $advertisement['Advertisement']['id']);
								}
								?>
								<?php echo $this->Form->postLink('<i class="icon-trash icon-white"></i>', array('action' => 'delete', $advertisement['Advertisement']['id']), array('class' => 'btn btn-danger', 'escape' => false), __d('advertising', 'Are you sure you want to delete # %s?', $advertisement['Advertisement']['id'])); ?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php
		if (CakePlugin::loaded('Resources')) {
			echo $this->Frame->modal('frame', array('title' => __('Advertising')));
		}
		?>
		<div class="pagination pagination-centered">
			<?php echo $this->Tools->Paginator(); ?>
		</div>
		<div id="blocks"></div>
	</div>
</div>
