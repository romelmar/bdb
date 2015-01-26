<?php

    if(!isset($header))  $header  = 'header';
    if(!isset($sidebar)) $sidebar = 'none';
    if(!isset($footer))  $footer  = 'footer';

   $this->load->view('includes/'.$header);
   $this->load->view('includes/'.$sidebar);
   $this->load->view($main_content);
   $this->load->view('includes/'.$footer);
?>