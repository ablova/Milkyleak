<?php 
class Schedule extends Controller {
	
	// Twitter API Information
	private $_consumer_key = CONSUMER_KEY;
    private $_consumer_secret = CONSUMER_SECRET;
	
	function Schedule()
	{
		parent::Controller();
		$this->load->library(array('twitter'));
	}


	public function index()
	{
		$messages = array();
		$profiles = array();
		$profile_ids = array();
		$gmt_time = strtotime(gmdate("Y-m-d H:i"));
		$messages = $this->db->query("SELECT * FROM message WHERE status = 'draft' AND schedule_time <= ".$gmt_time." AND schedule_time>0 LIMIT 500")->result();
		
		foreach($messages as $message){
			$posted = '';
			$message_profiles = array();
			$message_profiles = explode( ',', $message->profile_ids );
			
			foreach( $message_profiles as $message_profile ){
			 	
				if( !in_array( $message_profile, $profile_ids ) ){
					$profile_ids[] = $message_profile;
					$row = $this->db->get_where( 'account', array( 'id' => $message_profile ) )->row_array();
					if($row['id']){
						$profiles[$row['id']] = $row;
					}
				}
				
				if($profiles[$message_profile]['id']){
					
					$this->twitter->TwitterOAuth($this->_consumer_key, $this->_consumer_secret, $profiles[$message_profile]['autho_token'], $profiles[$message_profile]['autho_token_secret']);
					$tweet = $this->twitter->post("statuses/update", array("status" => $message->message));
					
					if(!$tweet->error)
						$posted = 'yes';
						
				}			
			}
			if($posted == 'yes')
			$this->db->update("message", array( "status" => 'posted' ), array("id" => $message->id ) ); 
			
		}
	}
}
?>