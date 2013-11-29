<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('publicity', 'Actions'); ?></li>
			<li><?php echo $this->Html->link(__d('publicity','New Impression'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
	<h2><?php echo __d('publicity','Impressions'); ?></h2>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('ip'); ?></th>
				<th><?php echo $this->Paginator->sort('user_agent'); ?></th>
				
				<th class="actions"><?php echo __d('publicity','Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($impressions as $impression): ?>
				<tr>
					<td><?php echo h($impression['Impression']['id']); ?>&nbsp;</td>
					<td><?php echo h($impression['Impression']['ip']); ?>&nbsp;</td>
					<td><?php echo h($impression['Impression']['user_agent']); ?>&nbsp;</td>					
					<td class="actions">						
						<div class="btn-group">
							<?php // echo $this->Html->link('<i class="icon-eye-open"></i>', array('action' => 'view', $impression['Impression']['id']),array('class'=>'btn','escape'=>false));?>
							<?php echo $this->Html->link('<i class="icon-edit"></i>', array('action' => 'edit', $impression['Impression']['id']),array('class'=>'btn','escape'=>false)); ?>
							<?php // echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $impression['Impression']['id']),array('class'=>'btn btn-danger','escape'=>false), __d('publicity','Are you sure you want to delete # %s?', $impression['Impression']['id'])); ?>
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