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
		$query = "INSERT INTO users (name, alias, email, password, date_of_birth)
				VALUES(?, ?, ?, ?, ?)";
		$values = array($post['name'], $post['alias'], $post['email'], $post['password'], $post['dob']);
		$this->db->query($query, $values);
		return $insert_id = $this->db->insert_id();

	}
	function get_email($post)
	{
		$query = "SELECT * FROM users WHERE email=? AND password=?";
		$value = array($post['email'], $post['password']);
		return $this->db->query($query, $value)->row_array();
	}
	// function check_email($post)
	// {
	// 	$query = "SELECT * FROM users WHERE email=?";
	// 	return $this->db->query($query, array($post['email']))->row_array();
	// }
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