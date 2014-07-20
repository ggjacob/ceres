<?php


class Users_model extends CI_Model {
		
    var $u_id="";
	var $uname="";
	var $pword="";
	var $access_type="";
	var $pw_changed="";
 
    function __construct(){
        parent::__construct();
    }
	
	function checkUsername($username, $password){
		$this->db->select('u_id, uname, pword, access_type, pw_changed');
		$this->db->where('uname', $username);
		$this->db->where('pword', $password);
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function updatePword($session_user, $pword){
		$data = array("pword"=>$pword, "pw_changed"=>1);
		$this->db->where('uname', $session_user);
		$this->db->update('users', $data);
		$changed = $this->db->affected_rows();
		return $changed;
	}
	
	function getAllUsers(){
		$this->db->select('u_id, uname, pword, access_type, pw_changed');
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function saveUserChanges($uid, $access){
		$data = array('access_type'=>$access);
		$this->db->where('u_id', $uid);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}
	
	function deleteUser($uid){
			$this->db->where('u_id', $uid);
			$this->db->delete('users');		
			return $this->db->affected_rows();			
	}
	
	function addUser($uname, $pword, $access){
		$data = array('uname'=>$uname, 'pword'=>$pword, 'access_type'=>$access, 'pw_changed'=>0);
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
}	
