<?php
Class User extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('id, username, password');
		$this -> db -> from('users');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . md5($password) . "'"); 
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	function getLastLogin($id)
	{
		// get last login  
		$this->db->select('lastLogin');
		$result = $this->db->get_where('users', array('id' => $id));
		                 
		// and set new one
		$actualDate = date("Y-m-d H:i:s");
		$data = array('lastLogin' => $actualDate);

		$this->db->where('id', $id);
		$this->db->update('users', $data);  
		
		return $result->row();
	}
}
?>