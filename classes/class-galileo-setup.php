<?php
/**
 * Initial setup
 *
 * @author      Rens Manders en Jay van Galileo Academy
 * @since       23/05/2023 
 * @package
 *
 */

class GalileoSetup {

	protected $defaultSettings = [
		'woocommerce' => false,
		'dev' => false,
		'acf_option_page' => true,
		'acf_google_api' => '',
	];
	protected $settings;


	public function __construct($settings = []) {
		$this->boot($settings);
	}

	private function boot($settings) {
		$this->settings = $this->defaultSettings;
		
		add_action( 'wp_enqueue_scripts', [$this, 'enqueueDependencies'], 99 );
		add_action( 'init', [$this, 'registerNavigations'] );
		add_action( 'init', [$this, 'showAdminBar'] );

		if($settings['acf_google_api'] != '') {
			add_action('acf/init', [$this, 'addGoogleMaps']);
		}

		if($settings['dev']) {
			$this->enableDev();
		}

		if($settings['acf_option_page']) {
			$this->enableOptionPage();
		}

		if($settings['woocommerce']) {
			$this->enableWoocommerce();
		}

		// Remove Emojis for optimalisation
		remove_action('wp_head', 'wp_generator');
	    remove_action('wp_head', 'print_emoji_detection_script', 7);
	    remove_action('admin_print_scripts', 'print_emoji_detection_script');
	    remove_action('wp_print_styles', 'print_emoji_styles');
	    remove_action('admin_print_styles', 'print_emoji_styles');
	}

	public function enqueueDependencies() {
		// Styles
		wp_enqueue_style('galileo-css', get_template_directory_uri() .'/dist/output.css', array());

		// Scripts
    	wp_localize_script( 'child-theme-main', 'params', array( 'ajaxurl' => admin_url('admin-ajax.php')) );
		wp_enqueue_script('galileo-js', get_template_directory_uri() .'/js/main.js', array(), null, true);

		// Filters        
		add_filter('script_loader_tag', [$this, 'registerModules'], 10, 3);
	}

	public function registerNavigations() {
		register_nav_menus(
			array(
			  'primary' => __( 'Primary Menu' ),
			  'secondary' => __( 'Secondary Menu' ),
			  'third' => __( 'Third Menu' ),
			  'fourth' => __( 'Fourth Menu' ),
			  'fifth' => __( 'Fifth Menu' ),
			)
		);
	}

	public function enableOptionPage() {
		if (function_exists('acf_add_options_page')) {
		    acf_add_options_page(array(
		        'page_title' => 'Website opties',
		        'menu_title' => 'Website opties',
		        'menu_slug' => 'standaard-opties',
		        'capability' => 'edit_posts',
		        'redirect' => false
		    ));
		}
	}

	public function enableDev() {
		// Add options as you like
		add_filter( 'show_admin_bar', '__return_false' );
	}

	public function enableWoocommerce() {
		add_theme_support( 'woocommerce' );
	}

	public function addGoogleMaps() {
		acf_update_setting('google_api_key', $this->settings['acf_google_api']);
	}
	
	public function registerModules($tag, $handle, $src) {
		if( 'galileo-js' !== $handle ) {
			return $tag;
		}else{
			$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
			return $tag;
		}
	}

	public function showAdminBar() {

		if(is_user_logged_in()) {
			add_filter( 'show_admin_bar', '__return_true' , 1000 );
		}
		
	}
}
