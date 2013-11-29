<?php if (isset($authuser['Group']['name']) && $authuser['Group']['name'] == 'superadmin'): ?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-star"></i>&nbsp;<?php echo __('Advertising') ?><b class="caret"></b></a>
		<ul class="dropdown-menu">	
			<li><?php echo $this->Html->link(__('Blocks'), array('plugin' => 'advertising', 'controller' => 'Blocks', 'action' => 'index', 'admin' => TRUE)); ?></li>	
			<li><?php echo $this->Html->link(__('Advertisements'), array('plugin' => 'advertising', 'controller' => 'Advertisements', 'action' => 'index', 'admin' => TRUE)); ?></li>	
			<!--<li><?php echo $this->Html->link(__('Blocks Advertisements'), array('plugin' => 'advertising', 'controller' => 'BlocksAdvertisements', 'action' => 'index', 'admin' => TRUE)); ?></li>-->	
						
		</ul>
	</li>
<?php endif; ?>