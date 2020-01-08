
<div class="container">

	<div class="row" style="margin-top: 5%">
  		<div class="col s12 m12 l12">
				
				<?php echo $this->session->userdata('nome'); ?>
   	
				<div class="progress">
      				<div class="indeterminate"></div>
  				</div>

  				<script> 
				window.setTimeout("location.href='<?php echo base_url('painel'); ?>'",4000)

				</script>

		</div>
	</div>
	
</div>