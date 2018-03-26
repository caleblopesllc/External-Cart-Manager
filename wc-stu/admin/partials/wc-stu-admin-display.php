<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.clopes.a2hosted.com/
 * @since      1.0.0
 *
 * @package    Wc_Stu
 * @subpackage Wc_Stu/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
	
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>


	
	<form method="post" action="options.php">
		
		<?php
			$options = get_option($this->plugin_name);
			$merchant_id = $options['merchant_id'];
			$cart_id = $options['cart_id'];
		?>
		
		
		<?php 
			settings_fields($this->plugin_name); 
			do_settings_sections($this->plugin_name);
		?>
		
		<fieldset>
			<legend class="screen-reader-text"><span>Enter Merchant ID</span></legend>
			<label for="<?php echo $this->plugin_name; ?>-merchant-id">
				<input type="text" id="<?php echo $this->plugin_name; ?>-merchant-id" name="<?php echo $this->plugin_name; ?>[merchant_id]" value="<?php if(!empty($merchant_id)) echo $merchant_id; ?>"/>
				<span><?php esc_attr_e('Enter Merchant ID', $this->plugin_name); ?></span>
			</label>
		</fieldset>
		
		<fieldset>
			<legend class="screen-reader-text"><span>Enter Cart ID</span></legend>
			<label for="<?php echo $this->plugin_name; ?>-cart-id">
				<input type="text" id="<?php echo $this->plugin_name; ?>-cart-id" name="<?php echo $this->plugin_name; ?>[cart_id]" value="<?php if(!empty($cart_id)) echo $cart_id; ?>"/>
				<span><?php esc_attr_e('Enter Cart ID', $this->plugin_name); ?></span>
			</label>
		</fieldset>
		
		 <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
		
	</form>
</div>