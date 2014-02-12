<div class="advertising">
	<div>		
		<?php
		if (!empty($block_alias)) {
			echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign icon-white"></i>&nbsp;' . __d('advertising', 'New Advertisement'), array('action' => 'add', $block_alias, 'admin' => true), array('escape' => FALSE, 'class' => 'btn btn-primary'));
		} else {
			$block_alias = '';
			echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign icon-white"></i>&nbsp;' . __d('advertising', 'New Advertisement'), array('action' => 'add', 'admin' => true), array('escape' => FALSE, 'class' => 'btn btn-primary'));
		}
		?>

	</div>

	<div class="title_form">
		<h2><?php echo __d('advertising', 'Advertisements'); ?></h2>
		<?php
		echo $this->Form->create('Advertisement', array('action' => 'search', 'class' => 'form-inline'), array('method' => 'GET'));
		echo '<div class="form-group">';
		echo $this->Form->input('search', array('label' => false, 'div' => false, 'class' => 'search input-large', 'placeholder' => __('Search', true)));
		echo '</div>';
		echo $this->Form->button('<i class="glyphicon glyphicon-search"></i>', array('label' => false, 'div' => false, 'class' => 'btn btn-default'));
		echo $this->Form->end();
		?>
		<?php
		$this->Paginator->options(array(
			'update' => '#content_layout',
			'evalScripts' => true,
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
							<?php echo $this->Tools->link_button(($advertisement['Advertisement']['published'] == Configure::read('zero_datetime')) ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>', array('action' => 'published', $advertisement['Advertisement']['id'], 'admin' => true), '#primary-ajax', array('class' => 'btn btn-default')); ?>
						</td>
						<td class="actions">
							<div class="btn-group">		
								<?php if ($authuser['Group']['name'] == 'superadmin' || $authuser['Group']['name'] == 'admin'): ?>
									<?php echo $this->Tools->link_button('<i class="glyphicon glyphicon-th"></i>', array('controller' => 'BlocksAdvertisements', 'action' => 'blocks', $advertisement['Advertisement']['id'], $block_alias, 'admin' => true), '#blocks', array('class' => 'btn btn-default')); ?>
								<?php endif; ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>', array('action' => 'view', $advertisement['Advertisement']['id'], $block_alias), array('class' => 'btn btn-default', 'escape' => false)); ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $advertisement['Advertisement']['id'], $block_alias), array('class' => 'btn btn-default', 'escape' => false)); ?>
								<?php
								if (CakePlugin::loaded('Resources')) {
									if ($authuser['Group']['name'] == 'superadmin' || $authuser['Group']['name'] == 'admin') {
										echo $this->Frame->link('glyphicon glyphicon-film', 'frame', 'advertising', $advertisement['Advertisement']['id']);
									} else {
										echo $this->Frame->link_files('icon-film', 'frame', 3, $advertisement['Advertisement']['id']);
										//echo $this->Frame->link('icon-film', 'frame', 'advertising', $advertisement['Advertisement']['id']);										
									}
								}
								?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash icon-white"></i>', array('action' => 'delete', $advertisement['Advertisement']['id']), array('class' => 'btn btn-danger', 'escape' => false), __d('advertising', 'Are you sure you want to delete # %s?', $advertisement['Advertisement']['id'])); ?>
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
		<div class="pagination-centered">
			<ul  class="pagination ">
				<?php echo $this->Paginator->prev('<', array('tag' => 'li',), NULL, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')); ?>
				<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
				<?php echo $this->Paginator->next('>', array('tag' => 'li',), NULL, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')); ?>
			</ul>
		</div>
		<div id="blocks"></div>
	</div>
</div>
