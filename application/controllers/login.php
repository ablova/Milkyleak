<?php 
class Login extends Controller 
{
	private $_data= array();
	public function __construct(){

		parent::Controller();
		$this->_data['title']      = PRO_NAME." - Login";
		if($this->session->userdata('admin_id')){
			
				redirect('profile');
			
			}

	}

	public function index(){
		
		$this->load->library("validation");

		if($_POST['submit']!=""){
								
			$rules['username']   	= "trim|required|xss_clean";
			$rules['password']  	= "required|callback_admin_check";
			$this->validation->set_rules($rules);

			$fields['username']   	= "username";
			$fields['password']  	= "password";
			$this->validation->set_fields($fields);

			if ($this->validation->run() == TRUE){
			
				$admin_details   = $this->common->getEntity("admin",array("hm_name" => $_POST['username'],"hm_password" => md5($_POST['password'])))->row_array();
				if($admin_details == 0)
				{
					$this->_data['error'] = "<font style='color:#FF0000; font-weight:bold; font-size:14px;'>Invalid username or password.</font>";
				}
				else{
					$this->session->set_userdata($admin_details);
					$this->common->newEntity('admin_logs',array('logged_ip' => $this->session->userdata("ip_address"),'admin_id' => $admin_details['admin_id']));
					redirect("profile");
				}
			}
		}	   
		$this->load->view('admin_login',$this->_data);
	}

	public function admin_check(){

		$exist_admin = $this->common->getEntity("admin",array("hm_name" => $_POST['username'],"hm_password" => md5($_POST['password'])))->row_array();
		
		if ($exist_admin['hm_status'])

		{   if($exist_admin['hm_status']=="Deactive"){

				$this->validation->set_message('admin_check', 'Your account is not active.');

			    return FALSE;

		    }
			elseif($exist_admin['hm_status']=="Suspend"){

				$this->validation->set_message('admin_check', 'Your account has been suspended.');

			    return FALSE;

		    }else{

				return TRUE;

			}

		}

		else

		{

			$this->validation->set_message('admin_check', 'Invalid Username or Password');

			return FALSE;

		}

	}

}