<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}


	public function get($tableName)
	{
		$query = $this->db->get($tableName);
		return $query->result_array();
	}


	// Count all record of table "contact_info" in database.
	public function record_count($tableName) {
		return $this->db->count_all($tableName);
	}

	// Fetch data according to per_page limit.
	public function fetch_data($limit, $page) {
		$offset = ($page-1)*$limit;
		$this->db->limit($limit, $offset);
		$query = $this->db->get("blog");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) 
			{
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	


	public function checkLogin($username, $password)
	{
		$this -> db -> select('*');
	    $this -> db -> from('users');
	    $this -> db -> where('username = ' . "'" . $username . "'");
	    $this -> db -> where('password = ' . "'" . md5($password) . "'");
	    $this -> db -> limit(1);
	    $query = $this -> db -> get();


	    if($query->num_rows() > 0)
	    {
	        foreach($query->result() as $rows)
	        {
	            //add all data to session
	            $data = array(
	                'id'       =>  $rows->id,
	                'username' =>  $rows->username,
	                'name'     =>  $rows->first_name,
	                'loggedIn' =>  TRUE
	            );
	            $this->session->set_userdata($data);
	            return true;
	        }
	    }
	    return false;
	}


	public function getWhere($tableName, $id)
    {
        $query = $this->db->get_where($tableName, array('id' => $id), 1);
        return $query->result_array();
    }

    public function update($tableName, $data, $id)
    {
    	$this->db->where('id', $id);
		$this->db->update($tableName, $data);
    }




}

