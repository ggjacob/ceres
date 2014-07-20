<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
		
		public function index(){
			
			$this->load->view('admin_panel');
		}
		
		public function users_list(){
			$this->load->model('log_in/Users_model');
			$data['all_users'] = $this->Users_model->getAllUsers();
			$this->load->view('users_list', $data);
		}
		
		public function recent_log(){
			$this->load->model('Activitylog_model');
			$data['recent_logs'] = $this->Activitylog_model->getRecentLogs();
			$this->load->view('activity_logview', $data);
		}
		
		public function period_log(){
			$sdate = $this->input->post('sdate', TRUE);
			$edate = $this->input->post('edate', TRUE);
			$this->load->model('Activitylog_model');
			$data['recent_logs'] = $this->Activitylog_model->getPeriodLogs($sdate, $edate);
			$this->load->view('activity_logview', $data);
		}

		public function editUser(){
			$uid = $this->input->post('uid', TRUE);
			$uname = $this->input->post('uname', TRUE);
			$access = $this->input->post('access', TRUE);
			$data['uid'] = $uid;
			$data['uname'] = $uname;
			$data['access'] = $access;
			$this->load->view('edit_user', $data);
		}
		
		public function changeUser(){	
			$uid = $this->input->post('uid', TRUE);
			$uname = $this->input->post('uname', TRUE);
			$access = $this->input->post('access', TRUE);		
			$this->load->model('log_in/Users_model');						
			$user_changed = $this->Users_model->saveUserChanges($uid, $access);
			if($user_changed){
				$activity = "Success: User access changed - ".$uname."/".$this->config->item($access, "access_type");
			}
			else{
				$activity = "Failed: User access unchanged - ".$uname;
			}
			$this->load->model('Activitylog_model');
			$this->Activitylog_model->recordActivity($this->session->userdata('session_user'), $activity);			
			$data['all_users'] = $this->Users_model->getAllUsers();
			$this->load->view('users_list', $data);			
		}

		public function deleteUser(){
			$this->load->model('log_in/Users_model');			
			$uid = $this->input->post('uid', TRUE);
			$uname = $this->input->post('uname', TRUE);
			if($this->Users_model->deleteUser($uid)){
				$activity = "Success: Deleted user - ID ".$uid."/Uname ".$uname;
			}
			else{
				$activity = "Failed: Delete user - ID ".$uid."/Uname ".$uname;
			}
			$this->load->model('Activitylog_model');
			$this->Activitylog_model->recordActivity($this->session->userdata('session_user'), $activity);
			$data['all_users'] = $this->Users_model->getAllUsers();
			$this->load->view('users_list', $data);			
			
		}
		
		public function addUser(){
			$this->load->model('log_in/Users_model');				
			$uname = $this->input->post('uname', TRUE);
			$pword = crypt($this->input->post('pword', TRUE), $this->config->item('encryption_key'));
			$access = $this->input->post('access', TRUE);
			$user_added = $this->Users_model->addUser($uname, $pword, $access);
			if($user_added){ 
				$activity = "Success: Added user ID ".$user_added."/Uname ".$uname;
			}
			else{
				$activity = "Failed: Add user Uname ".$uname;
			}
			$this->load->model('Activitylog_model');
			$this->Activitylog_model->recordActivity($this->session->userdata('session_user'), $activity);			
			$data['all_users'] = $this->Users_model->getAllUsers();
			$this->load->view('users_list', $data);						
			
		}
}		
	