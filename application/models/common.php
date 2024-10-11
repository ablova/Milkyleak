<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	

class Common extends Model {

		public function __construct(){

			parent::Model();

		}
		
		public function getAllEntity($table, $limit=null, $offset=null, $order=null, $condition=array(), $fields=null, $group=null)
		{
			$offset = $offset -1;
			if($fields){
				$this->db->select($fields);
			}	
			if($order)
			{
				$this->db->order_by($order[0],$order[1]);
			}
			if($group){
				$this->db->group_by($group);
			}		
			return $res = $this->db->get_where($table,$condition,$limit,$offset);
		}
		
		public function getEntity($table, $condition=array(),$order=null,$fields=null,$group=null)
		{	
			if($fields){
				$this->db->select($fields);
			}
			if($order)
			{
				$this->db->order_by($order[0],$order[1]);
			}
			if($group){
				$this->db->group_by($group);
			}
			return $res = $this->db->get_where($table,$condition);
		}
		
		
		
		public function getCount($table, $condition=array(),$group=null)
		{
			if($group){
				$this->db->group_by($group);
			}
			return $res = $this->db->get_where($table,$condition)->num_rows();
		}
		
		public function getFromQuery($query)
		{
			return $res = $this->db->query($query);
		}
		
		public function newEntity($table, $data)
		{
			$res = $this->db->insert($table,$data);
			return mysql_insert_id();
		}
		
		public function updateEntity($table, $data, $condition=array())
		{
			return $res = $this->db->update($table,$data, $condition);
		}
		
		public function deleteEntity($table, $condition=array())
		{
			return $res = $this->db->delete($table,$condition);
		}
		
		
		
		
}