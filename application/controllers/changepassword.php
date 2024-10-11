<?php 

class Changepassword extends Controller 

{

	public function __construct(){

		parent::Controller();
		
		
		$this->load->library(array('validation'));
			if(!$this->session->userdata('admin_id')) redirect('login');
	}
	
	function index() 
	{
	
		$data['title'] = "Admin - Change Password";
		$data['menu'] = "admin_profile";
		
		$this->load->view("change_password",$data);
    }
	
	function updatepassword(){
	
	    $data['menu'] = "admin_profile";
	
		
			$rules['current_password']       = "required|xss_clean|callback_verify_currentpassword";
			$rules['new_password']           = "required|xss_clean";
			$rules['confirm_password']       = "required|matches[new_password]";
			$this->validation->set_rules($rules);
		
			$fields['current_password']      = 'Current Password';
			$fields['new_password']          = 'New Password';
			$fields['confirm_password']      = 'Confirm Password';
			$this->validation->set_fields($fields);
				
				
			if ($this->validation->run() == FALSE)
			{
				$data['title'] = 'Admin - Change Password';
				$data['current_password'] = $_REQUEST['current_password'];
				$data['success'] = "";
					
					
				$this->load->view("change_password", $data);
			}
			else
			{
				$condition['admin_id'] = $this->session->userdata('admin_id');
				$data = array('hm_password '  => md5($_REQUEST['new_password']) );
				$sus = $this->common->updateEntity("admin",$data,$condition);
					
				if($sus == 1)
				{
					$data['title'] = 'Admin - Change Password';
					$this->session->set_userdata(array("type" => "success", "message" => "Your information has been successfully updated"));
					$this->load->view("change_password", $data);
				}
			}

		
  }
  function verify_currentpassword($str){
	$email =  $this->common->getEntity('admin', array('hm_password' => md5($str)));
        if($email->num_rows() <= 0) {
			$this->validation->set_message('verify_currentpassword', 'Current password is not match.');
			return false;
        } else {
            return true;
        }
    }  
	

}