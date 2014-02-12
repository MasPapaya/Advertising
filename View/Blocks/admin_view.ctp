<div class="cru">
	<div class="btn-options">
		<?php echo $this->Html->link('<i class="icon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>	
	</div>
	<h2><?php echo __d('advertising', 'Block'); ?></h2>
	<dl>
		<dt><?php echo __d('advertising', 'Id'); ?></dt>
		<dd>
			<?php echo h($block['Block']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Name'); ?></dt>
		<dd>
			<?php echo h($block['Block']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Alias'); ?></dt>
		<dd>
			<?php echo h($block['Block']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Multiple'); ?></dt>
		<dd>
			<?php echo h($block['Block']['multiple']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Is User'); ?></dt>
		<dd>
			<?php echo h($block['Block']['is_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Height'); ?></dt>
		<dd>
			<?php echo h($block['Block']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Width'); ?></dt>
		<dd>
			<?php echo h($block['Block']['width']); ?>
			&nbsp;
		</dd>		
	</dl>
</div>