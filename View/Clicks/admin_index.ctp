<div class="span3">
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('resources','Actions'); ?></li>
			<li><?php echo $this->Html->link(__d('advertising','New Click'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
	<h2><?php echo __d('advertising','Clicks'); ?></h2>
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
				<th><?php echo $this->Paginator->sort('ip'); ?></th>
				<th><?php echo $this->Paginator->sort('user_agent'); ?></th>				
				<th class="actions"><?php echo __d('advertising','Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($clicks as $click): ?>
				<tr>
					<td><?php echo h($click['Click']['id']); ?>&nbsp;</td>
					<td><?php echo h($click['Click']['ip']); ?>&nbsp;</td>
					<td><?php echo h($click['Click']['user_agent']); ?>&nbsp;</td>					
					<td class="actions">						
						<div class="btn-group">
							<?php // echo $this->Html->link('<i class="icon-eye-open"></i>', array('action' => 'view', $click['Click']['id']),array('class'=>'btn','escape'=>false));?>
							<?php echo $this->Html->link('<i class="icon-edit"></i>', array('action' => 'edit', $click['Click']['id']),array('class'=>'btn','escape'=>false)); ?>
							<?php // echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $click['Click']['id']),array('class'=>'btn btn-danger','escape'=>false), __d('advertising','Are you sure you want to delete # %s?', $click['Click']['id'])); ?>
						</div>						
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $this->Tools->Paginator();?>
	</div>
</div>
