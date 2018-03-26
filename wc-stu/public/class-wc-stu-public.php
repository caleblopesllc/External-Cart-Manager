<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.clopes.a2hosted.com/
 * @since      1.0.0
 *
 * @package    Wc_Stu
 * @subpackage Wc_Stu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Stu
 * @subpackage Wc_Stu/public
 * @author     Caleb Lopes <caleblopesllc@gmail.com>
 */
class Wc_Stu_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->wc_stu_options = get_option($this->plugin_name);
	}
	
	public function checkoutRedirectToExternalSource() {
		global $post;
		global $woocommerce;
		
		
		if ( ( $this->wc_stu_options['merchant_id'] ) && ( $this->wc_stu_options['cart_id'] ) ) {
			$merchant_id = $this->wc_stu_options['merchant_id'];
			$cart_id =  $this->wc_stu_options['cart_id'];
			$url = " https://safecart.com/" . $merchant_id . "/:" . $cart_id . "?"; 
			if ( isset( $post->ID ) && $post->ID == woocommerce_get_page_id( 'checkout' ) ) {
				if ( isset( $woocommerce->cart->cart_contents ) && count( $woocommerce->cart->cart_contents ) > 0) {
					foreach ($woocommerce->cart->cart_contents as $item) {
						$product = wc_get_product( $item[ 'product_id' ] );
						$sku = $product->get_sku();
						$qty = $item[ 'quantity' ];

						$url .= "sku[]=" . $sku . "&offer[" . $merchant_id . "/" . $sku . "]=" . $qty . "&";
					}

					header("Location: " . $url);
					die();
				}
			}
		} else {
			echo "<h1>ERROR-Merchant ID and Cart ID not set";
			die();
		}
	}
	
	function custom_woocommerce_button_proceed_to_checkout() {
		wc_get_template( 'custom-proceed-to-checkout-button.php' );
	}
	
	public function remove_buttons() {

		remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
	}
	
	public  function remove_mini(){
    // Removing Buttons
    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Stu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Stu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-stu-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Stu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Stu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-stu-public.js', array( 'jquery' ), $this->version, false );

	}
	


}
