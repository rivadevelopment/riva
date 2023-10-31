<?php
class System extends MX_Controller{

    public $data = array();
    private $license = false;
    function __construct() {
// Call the Model constructor
        parent :: __construct();
    }



    function checksystem()
    {
        return true;
    }

    function phptravels_check_license()
    {

    }

    function update_local_key($key) {
      
    }
}
