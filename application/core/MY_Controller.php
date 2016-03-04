<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	    public function __construct() {
			
			parent::__construct();
			
			$this->output->enable_profiler(TRUE);

        }
        
        protected function checkLevel($liv=0) {
				
			return (@$this->session->utente->livello > $liv);
			
		}
		
		protected function connesso() {
		
			return $connesso=@fsockopen("www.google.it", 80,$errno,$errstr,300); 
		
		}
		               
}

?>
