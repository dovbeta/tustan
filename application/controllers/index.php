<?php
class Index extends CI_Controller{

            function __construct(){
                parent::__construct();
                $this->load->library("session");
				
            }
			
			function index($lang='ua'){
                header("Location:/lang/index/$lang");
            }

            function lang($lang='ua'){
                header("Location:/lang/index/$lang");
            }

        }
        ?>