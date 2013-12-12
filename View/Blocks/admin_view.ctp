<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('advertising', 'Actions'); ?></li>
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('advertising','List Blocks'), array('action' => 'index'), array('escape' => FALSE)); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
<h2><?php  echo __d('advertising','Block'); ?></h2>
	<dl>
		<dt><?php echo __d('advertising','Id'); ?></dt>
		<dd>
			<?php echo h($block['Block']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Name'); ?></dt>
		<dd>
			<?php echo h($block['Block']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Alias'); ?></dt>
		<dd>
			<?php echo h($block['Block']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Multiple'); ?></dt>
		<dd>
			<?php echo h($block['Block']['multiple']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Height'); ?></dt>
		<dd>
			<?php echo h($block['Block']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Width'); ?></dt>
		<dd>
			<?php echo h($block['Block']['width']); ?>
			&nbsp;
		</dd>		
	</dl>
</div>