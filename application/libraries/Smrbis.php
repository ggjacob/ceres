<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Smrbis{
	
	
	public function getCurrentUser(){
		$CI =& get_instance();	
		$CI->load->library('session');		
		$session_user = $CI->session->userdata('session_user');
		return $session_user;
	}	
	

	
}




?>