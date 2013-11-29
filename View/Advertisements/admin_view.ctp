<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('resources', 'Actions'); ?></li>
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('publicity','List Advertisements'), array('action' => 'index'), array('escape' => FALSE)); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
<h2><?php  echo __d('publicity','Advertisement'); ?></h2>
	<dl>
		<dt><?php echo __d('publicity','Id'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Url'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Target'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Name'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Height'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Width'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['width']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>