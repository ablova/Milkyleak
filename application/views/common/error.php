<?php if($this->session->userdata('type') && $this->session->userdata('message')){?>
	<link href="<?=base_url()?>asset/css/alert.css" rel="stylesheet" type="text/css">
	<script src="<?=base_url()?>asset/js/alert.js" type="text/javascript"></script>
	<div class="clear"></div>
	<div style="clear:both; width:100%; float:none; margin:auto; margin-bottom:10px;" class="notification <?=$this->session->userdata('type')?> png_bg">
		<a class="close" href="#"><img alt="close" title="Close this notification" src="<?=base_url()?>asset/images/icons/cross_grey_small.png"></a>
		<div align="center">
			<?php echo $this->session->userdata('message'); $this->session->unset_userdata('message');  $this->session->unset_userdata('type');?>
		</div>
	</div>
<?php }?>