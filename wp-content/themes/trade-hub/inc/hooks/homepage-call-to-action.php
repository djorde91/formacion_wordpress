<?php

if ( !function_exists('trade_hub_call_to_action') ) :
/**
	* trade-hub call-to-action section 
	* @since Trade Hub 1.0.0
	* @param null
 	* @return null
	*/
	function trade_hub_call_to_action()
	{
		global $trade_hub_customizer_all_values;
		$trade_hub_call_action_main_text = esc_html($trade_hub_customizer_all_values['trade-hub-call-action-main-text']);
		$trade_hub_call_action_button_text = esc_html($trade_hub_customizer_all_values['trade-hub-call-action-button-text']);
		$trade_hub_call_action_button_url = $trade_hub_customizer_all_values['trade-hub-call-action-link'];

		if ( !$trade_hub_customizer_all_values['trade-hub-call-action-enable-option'] ) {
			return null;
		}?>
		<?php if(!empty($trade_hub_call_action_main_text) || !empty($trade_hub_call_action_button_text) ) {  ?>
			<section class="callback-section section-wrapper" id="trade-hub-callback">
		        <div class="overlay-callback">
		        	<div class="container">
		        		<?php if(!empty($trade_hub_call_action_main_text) ) { ?>
			            	<div class="col-md-7 col-sm-7 col-xs-12 call-toaction-text">
			              		<h2><?php echo esc_html($trade_hub_call_action_main_text); ?></h2>
			            	</div><!-- title -->
		            	<?php } ?>
		            	<?php if(!empty($trade_hub_call_action_button_text)) { ?>
		            	<div class="col-md-5 col-sm-5 col-xs-12 call-to-action-btn">
		              		<a href="<?php echo esc_url($trade_hub_call_action_button_url);?>" class="border-btn" ><?php echo esc_html($trade_hub_call_action_button_text); ?></a>
		            	</div><!-- btn -->
		            	<?php } ?>
		            </div><!-- container -->
		       </div><!-- overlay -->
		    </section><!-- call back section end --> 
	    <?php } ?>
	<?php 
	}

endif;
add_action('trade_hub_homepage','trade_hub_call_to_action',60);