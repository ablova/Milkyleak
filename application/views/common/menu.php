<div id="menu">
	<ul class="group" id="menu_group_main">
		<li class="item first" id="one"><a href="<?=site_url()?>profile" <?php if($menu=='admin_profile'){?> class="main current"<?php }else{?>class="main"<?php }?>><span class="outer"><span class="inner dashboard">Dashboard</span></span></a></li>
		<li class="item middle" id="two"><a href="<?php echo site_url('accounts');?>" <?php if($menu=='account'){?> class="main current"<?php }else{?>class="main"<?php }?>><span class="outer"><span class="inner users">Accounts</span></span></a></li>
		<li class="item middle" id="four"><a href="<?=site_url('pictures')?>" <?php if($menu=='image'){?> class="main current"<?php }else{?>class="main"<?php }?>><span class="outer"><span class="inner media_library">Images</span></span></a></li>
		<li class="item last" id="five"><a href="<?=site_url('message')?>" <?php if($menu=='message'){?> class="main current"<?php }else{?>class="main"<?php }?>><span class="outer"><span class="inner content">Messages</span></span></a></li>
	</ul>
</div>