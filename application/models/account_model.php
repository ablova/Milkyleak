<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends Model {	

		public function __construct(){

			parent::Model();

		}
				
		public function getAllaccount($limit,$offset){

			$offset = $offset -1;
			$this->db->order_by("id", "desc");
			$res = $this->db->get_where('account',array(),$limit,$offset);
			
			return $res;	   

		}
		
		public function newAccount($data){
			
			
			$this->db->insert("account",$data);	
			return mysql_insert_id();
		}
		
		public function updateAccount($data,$id){

			return $this->db->update("account",$data,array("id" => $id));	  

		}
				
		public function deleteAccount($id){
			$this->db->delete("message_profile", array("profile_id" => $id));
			return $this->db->delete("account",array("id" => $id));			   
		}

		public function getAccountDetails($id){
		    return $query = $this->db->get_where('account',array('id' => $id));
	    }
		
		public function getUserDetailByTwitterId($id){
		    return $query = $this->db->get_where('account',array('twitter_id' => $id));
	    }
		
		public function getUserDetailByScreen($name){
		    return $query = $this->db->get_where('account',array('screen_name' => $name));
	    }
}