<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('publicity', 'Actions'); ?></li>
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('publicity','List Blocks'), array('action' => 'index'), array('escape' => FALSE)); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
<h2><?php  echo __d('publicity','Block'); ?></h2>
	<dl>
		<dt><?php echo __d('publicity','Id'); ?></dt>
		<dd>
			<?php echo h($block['Block']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Name'); ?></dt>
		<dd>
			<?php echo h($block['Block']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Alias'); ?></dt>
		<dd>
			<?php echo h($block['Block']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Multiple'); ?></dt>
		<dd>
			<?php echo h($block['Block']['multiple']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Height'); ?></dt>
		<dd>
			<?php echo h($block['Block']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Width'); ?></dt>
		<dd>
			<?php echo h($block['Block']['width']); ?>
			&nbsp;
		</dd>		
	</dl>
</div>