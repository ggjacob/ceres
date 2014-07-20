<?php


class Activitylog_model extends CI_Model {
		
    var $activity_id="";
	var $user="";
	var $activity="";
	var $timestamp="";

 
    function __construct(){
        parent::__construct();
    }
	
	function getRecentLogs(){
		$sql = "SELECT user, activity, timestamp FROM activitylog
				WHERE DATE(timestamp) >= DATE_SUB(NOW(), INTERVAL 2 DAY) AND DATE(timestamp) <= NOW() ORDER BY timestamp DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getPeriodLogs($sdate, $edate){
		$sql = "SELECT user, activity, timestamp FROM activitylog
				WHERE DATE(timestamp) >= TIMESTAMP(?) AND DATE(timestamp) <= TIMESTAMP(?) ORDER BY timestamp DESC";	
		$query = $this->db->query($sql, array($sdate, $edate));
		return $query->result();					
	}
	function recordActivity($username, $activity){
		$data = array('user'=>$username, 'activity'=>$activity);
		$this->db->insert('activitylog', $data);
	}
}	