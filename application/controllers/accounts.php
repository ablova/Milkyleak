<?php  
class Accounts extends Controller 
{

	private $_data = array();
	public function __construct(){

		parent::Controller();
		if(!$this->session->userdata('admin_id')) redirect('login');
		$this->load->model('account_model');
		$this->_data['menu'] = 'account';
		$this->_data['title'] = "Admin - Accounts";
	}

	public function index(){
			
			$page       = $this->uri->segment(3);
			$limit = 20;
			$total_result = $this->common->getCount('account');
			
			$total_page = ceil($total_result/$limit);
			if($page=='' || $page <= 1 ){
				$page = 1;
			}
			elseif($page > $total_page)
			{
				$page =  $total_page;
			}
			else
			{
				$page = $page;
			}
			
			$start_ret = ($page-1)*$limit+1;
			$end_ret   = $page*$limit;
			if($end_ret > $total_result){
				$end_ret = $total_result;
			}
				
			$this->_data['total_results'] = $total_result;
			$this->_data['limit']         = $limit;
			$this->_data['total_page']    = $total_page;
			$this->_data['start']         = $start_ret;
			$this->_data['end_result']    = $end_ret;
			$this->_data['current_page']  = $page;
			
			$this->_data['accounts_list'] = $this->common->getAllEntity('account',$limit,$start_ret);
			
			$this->load->view("account_list",$this->_data);	   

	}
		
	function delete() 
	{
			$page = $this->uri->segment(4); 
			
			$this->account_model->deleteAccount($this->uri->segment(3));
			
			redirect('accounts/'.$page);
    }
	
	function multiple()
	{
			$page = $this->uri->segment(3);
			$checkbox = $_REQUEST['checkbox'];
			$count = count($checkbox);
			
			if(strtolower($_REQUEST['action'])=='delete'){
				
				for($i=0; $i<$count; $i++)
				{
					$this->account_model->deleteAccount($checkbox[$i]);
				}
				
			}
			redirect("accounts/".$page);
    }
	
	function detail()
	{
		$this->_data['profile_id'] = $account_id = $this->uri->segment(3);
		$this->_data['page'] = $page = $this->uri->segment(4);
		$this->_data['account_info'] = $this->account_model->getAccountDetails($account_id);
		$this->_data['title'] 		= 'Account Detail';
		$this->load->view("account_detail",$this->_data);
	}		
}
?>