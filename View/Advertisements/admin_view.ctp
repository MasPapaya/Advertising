<div class="cru">
	<div class="btn-options">
		<?php
		if (!empty($block_alias)) {

			echo $this->Html->link('<i class="icon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', $block_alias, 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE));
		} else {
			echo $this->Html->link('<i class="icon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE));
		}
		?>
	</div>
	<h2><?php echo __d('advertising', 'Advertisement'); ?></h2>
	<dl>
		<dt><?php echo __d('advertising', 'Id'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Url'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Target'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Name'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Height'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising', 'Width'); ?></dt>
		<dd>
			<?php echo h($advertisement['Advertisement']['width']); ?>
			&nbsp;
		</dd>

	</dl>
</div>