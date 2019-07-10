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
			// Section Info
			$this->set_section_title( __('Footer Credits', 'sv100_companion' ) )
				 ->set_section_desc( __( 'Adjust Footer Credit Settings', 'sv100_companion' ) )
				 ->set_section_type( 'settings' );
			
			$this->get_root()->add_section( $this );
			
			$this->load_settings()->run();
		}
		
		protected function load_settings(): sv_footer_credits {
			$this->s['disable'] =
				$this->get_setting()
					 ->set_ID( 'disable' )
					 ->set_title( __( 'Disable credits footer at all.', 'sv100_companion' ) )
					 ->set_default_value( 0 )
					 ->load_type( 'checkbox' );
			
			$this->s['text'] =
				$this->get_setting()
					 ->set_ID( 'text' )
					 ->set_title( __( 'Set your own text for credits.', 'sv100_companion' ) )
					 ->load_type( 'text' );
			
			return $this;
		}
		public function run(){
			if($this->get_setting('disable')->run_type()->get_data()){
				add_filter('sv100_sv_footer_credits', __return_false);
			}
			if($this->get_setting('text')->run_type()->get_data() && strlen(trim($this->get_setting('text')->run_type()->get_data())) > 0){
				add_filter('sv100_sv_footer_credits_text', function(){ return $this->get_setting('text')->run_type()->get_data(); });
			}
		}
	}