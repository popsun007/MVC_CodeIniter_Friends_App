<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class user extends CI_Model
{
	function get_user($id)
	{
		$query = "SELECT * FROM users WHERE id=?";
		return $this->db->query($query, array($id))->row_array();
	}
	function add_user($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('alias', 'Alias', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|md5');
		$this->form_validation->set_rules('com_password', 'Comfirm Password', 'required|trim|matches[password]|md5');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
		$result = array();
		if($this->form_validation->run() === TRUE)
		{
			$result[] = true;
			$password = md5($post['password']);
			$query = "INSERT INTO users (name, alias, email, password, date_of_birth, created_at)
					VALUES(?, ?, ?, ?, ?, NOW())";
			$values = array($post['name'], $post['alias'], $post['email'], $password, $post['dob']);
			$this->db->query($query, $values);
			$result[] = $this->db->insert_id();
		}
		else
		{
			$result[] = false;
			$result[] = validation_errors();
		}
		return $result;
	}
	function get_email($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|vaild_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|md5');
		$result = array();
		if ($this->form_validation->run() === TRUE)
		{
			$password = md5($post['password']);
			$query = "SELECT * FROM users WHERE email=? AND password=?";
			$value = array($post['email'], $password);
			$check = $this->db->query($query, $value)->row_array();
			if($check)
			{
				$result[] = true;
				$result[] = $check;
			}
			else
			{
			$result[] = false;
			}
		}
		else
		{
			$result[] = false;
		}
		return $result;
	}
	function get_friends($id)
	{
		$query = "SELECT * FROM users WHERE users.id IN 
				( SELECT friend_id FROM friends WHERE user_id = ? )";
		return $this->db->query($query, array($id))->result_array();
	}	
	function get_defriends($id)
	{
		$query = "SELECT * FROM users WHERE users.id NOT IN 
				( SELECT friend_id FROM friends WHERE user_id = ? )
				AND id !=?;";
		return $this->db->query($query, array($id,$id))->result_array();
	}
	function add_friend($user_id, $friend_id)
	{
		$query = "INSERT INTO friends (user_id, friend_id)
				VALUES(?, ?)";
		 $this->db->query($query, array($user_id, $friend_id));
	}	
	function delete_friend($user_id, $friend_id)
	{
		$query = "DELETE FROM friends WHERE user_id=? AND friend_id=?";
		 $this->db->query($query, array($user_id, $friend_id));
	}

}