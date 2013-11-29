<div class="blocksAdvertisements view">
<h2><?php  echo __d('publicity','Blocks Advertisement'); ?></h2>
	<dl>
		<dt><?php echo __d('publicity','Id'); ?></dt>
		<dd>
			<?php echo h($blocksAdvertisement['BlocksAdvertisement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Block'); ?></dt>
		<dd>
			<?php echo $this->Html->link($blocksAdvertisement['Block']['name'], array('controller' => 'blocks', 'action' => 'view', $blocksAdvertisement['Block']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Advertisement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($blocksAdvertisement['Advertisement']['name'], array('controller' => 'advertisements', 'action' => 'view', $blocksAdvertisement['Advertisement']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __d('publicity','Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d('publicity','Edit Blocks Advertisement'), array('action' => 'edit', $blocksAdvertisement['BlocksAdvertisement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__d('publicity','Delete Blocks Advertisement'), array('action' => 'delete', $blocksAdvertisement['BlocksAdvertisement']['id']), null, __d('publicity','Are you sure you want to delete # %s?', $blocksAdvertisement['BlocksAdvertisement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Blocks Advertisements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Blocks Advertisement'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Advertisements'), array('controller' => 'advertisements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Advertisement'), array('controller' => 'advertisements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Clicks'), array('controller' => 'clicks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Click'), array('controller' => 'clicks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Impressions'), array('controller' => 'impressions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Impression'), array('controller' => 'impressions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __d('publicity','Related Clicks'); ?></h3>
	<?php if (!empty($blocksAdvertisement['Click'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __d('publicity','Id'); ?></th>
		<th><?php echo __d('publicity','Ip'); ?></th>
		<th><?php echo __d('publicity','User Agent'); ?></th>
		<th><?php echo __d('publicity','Create'); ?></th>
		<th><?php echo __d('publicity','Blocks Advertisement Id'); ?></th>
		<th class="actions"><?php echo __d('publicity','Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blocksAdvertisement['Click'] as $click): ?>
		<tr>
			<td><?php echo $click['id']; ?></td>
			<td><?php echo $click['ip']; ?></td>
			<td><?php echo $click['user_agent']; ?></td>
			<td><?php echo $click['create']; ?></td>
			<td><?php echo $click['blocks_advertisement_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__d('publicity','View'), array('controller' => 'clicks', 'action' => 'view', $click['id'])); ?>
				<?php echo $this->Html->link(__d('publicity','Edit'), array('controller' => 'clicks', 'action' => 'edit', $click['id'])); ?>
				<?php echo $this->Form->postLink(__d('publicity','Delete'), array('controller' => 'clicks', 'action' => 'delete', $click['id']), null, __d('publicity','Are you sure you want to delete # %s?', $click['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__d('publicity','New Click'), array('controller' => 'clicks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __d('publicity','Related Impressions'); ?></h3>
	<?php if (!empty($blocksAdvertisement['Impression'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __d('publicity','Id'); ?></th>
		<th><?php echo __d('publicity','Ip'); ?></th>
		<th><?php echo __d('publicity','User Agent'); ?></th>
		<th><?php echo __d('publicity','Create'); ?></th>
		<th><?php echo __d('publicity','Blocks Advertisement Id'); ?></th>
		<th class="actions"><?php echo __d('publicity','Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blocksAdvertisement['Impression'] as $impression): ?>
		<tr>
			<td><?php echo $impression['id']; ?></td>
			<td><?php echo $impression['ip']; ?></td>
			<td><?php echo $impression['user_agent']; ?></td>
			<td><?php echo $impression['create']; ?></td>
			<td><?php echo $impression['blocks_advertisement_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__d('publicity','View'), array('controller' => 'impressions', 'action' => 'view', $impression['id'])); ?>
				<?php echo $this->Html->link(__d('publicity','Edit'), array('controller' => 'impressions', 'action' => 'edit', $impression['id'])); ?>
				<?php echo $this->Form->postLink(__d('publicity','Delete'), array('controller' => 'impressions', 'action' => 'delete', $impression['id']), null, __d('publicity','Are you sure you want to delete # %s?', $impression['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__d('publicity','New Impression'), array('controller' => 'impressions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
