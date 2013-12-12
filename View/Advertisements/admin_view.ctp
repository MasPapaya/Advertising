<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('resources', 'Actions'); ?></li>
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('advertising','List Advertisements'), array('action' => 'index'), array('escape' => FALSE)); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
<h2><?php  echo __d('advertising','Advertisement'); ?></h2>
	<dl>
		<dt><?php echo __d('advertising','Id'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Url'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Target'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Name'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Height'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Width'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['width']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>