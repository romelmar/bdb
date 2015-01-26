<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  =======================================
 *  Author     : Romelmar Alejandrino
 *  License    : Protected
 *  Email      : romelmar.alejandrino@gmail.com
 *

 *  =======================================
 */
require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}