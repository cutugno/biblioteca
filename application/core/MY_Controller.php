<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

        public function __construct() {
			
			parent::__construct();
			
			$this->output->enable_profiler(FALSE);	
        }
        
        protected function checkLevel($liv=0) {
				
			return (@$this->session->utente->livello > $liv);
			
		}
                
}

?>
