 <?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class WebRegistrationModel extends CI_Model
{	
	
	//Generic update function
	public function getSingleData($select,$where,$table)
	{
		$this->db->select($select);	
		$this->db->from($table);	
		$this->db->where($where);		
		$query=$this->db->get();
		return $query->row(); 			
	}
	
	public function getSingleDataOr($select,$where,$table)
	{
		$this->db->select($select);	
		$this->db->from($table);	
		$this->db->or_where($where);		
		$query=$this->db->get();
		return $query->row(); 			
	}

        public function insertDb($table,$data){
		$this->db->insert($table, $data); 
	}

	public function updateDb($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table, $data); 
	}

        public function deleteDb($table,$where){
		$this->db->where($where);
		$this->db->delete($table); 
	}

	public function getdata($select,$where,$table)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();			
		return  $query->result();			
	}
	
	public function getdataOr($select,$where,$table)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->or_where($where);
		$query = $this->db->get();			
		return  $query->result();			
	}
	
	public function getdataOderBy($select,$where,$table,$order)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "asc");
		$query = $this->db->get();			
		return  $query->result();			
	}


}