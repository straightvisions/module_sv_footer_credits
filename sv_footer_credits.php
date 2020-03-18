<?php
	namespace sv100_companion;
	
	/**
	 * @version         4.000
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright		2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.000
	 * @license			See license.txt or https://straightvisions.com
	 */
	
	class sv_footer_credits extends modules {
		public function init() {
			add_action('init', array($this, 'wp_init'));
		}
		public function wp_init(){
			if($this->is_instance_active('sv100')) {
				// Section Info
				$this->set_section_title( __( 'Footer Credits', 'sv100_companion' ) )
					 ->set_section_desc( __( 'Adjust Footer Credit Settings for SV100 Theme', 'sv100_companion' ) )
					 ->set_section_type( 'settings' );
				
				$this->get_root()->add_section( $this );
				
				$this->load_settings()->run();
			}
		}
		
		protected function load_settings(): sv_footer_credits {
				$this->get_setting('disable')
					 ->set_title( __( 'Disable credits footer at all.', 'sv100_companion' ) )
					 ->set_default_value( 0 )
					 ->load_type( 'checkbox' );
				
				$this->get_setting('text')
					 ->set_title( __( 'Set your own text for credits.', 'sv100_companion' ) )
					 ->load_type( 'text' );
			
			return $this;
		}
		public function run(): sv_footer_credits {
			if($this->get_setting('disable')->get_data()){
				add_filter('sv100_sv_footer_credits', '__return_false');
			}
			if($this->get_setting('text')->get_data() && strlen(trim($this->get_setting('text')->get_data())) > 0){
				add_filter('sv100_sv_footer_credits_text', function(){ return $this->get_setting('text')->get_data(); });
			}
			
			return $this;
		}
	}