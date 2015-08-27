<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this -> output -> enable_profiler();
		$this->load->model('user');
	}
	public function index()
	{
		$this->load->view('main');
	}
	public function register()
	{
		$result = $this->user->add_user($this->input->post());
		if($result[0] === TRUE)
		{
			$insert_id = $result[1];
			$this->session->set_userdata('user_data', $insert_id);
			$user_id = array('id' => $this->session->userdata('user_data'));
			$user_inputs = $this->input->post();
			$user_data = array_merge($user_id, $user_inputs);  // merge two associate array together;
			$this->session->set_userdata('user_data', $user_data );
			redirect('/users/home');
		}
		else
		{
			$this->session->set_flashdata('reg_errors', validation_errors());
			redirect('/');
		}
	}
	public function log_off()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
	public function log_in()
	{
			$infos = $this->user->get_email($this->input->post());

			if($infos[0] === TRUE)
			{
				$friends = $this->user->get_friends($infos[1]['id']);
				$defriends = $this->user->get_defriends($infos[1]['id']);
				$this->session->set_userdata('user_data', $infos[1]);
				$this->load->view('home', array('fri_data' => $friends, 'defri_data' => $defriends));
			}
			else
			{
				$this->session->set_flashdata('errors', "email and/or password are/is not valid!");
				redirect('/');
			}
	}
	public function add_friend($user_id, $friend_id)
	{
		$this->user->add_friend($user_id, $friend_id);
		$this->user->add_friend($friend_id, $user_id);
		redirect('/users/home');
	}	
	public function delete_friend($user_id, $friend_id)
	{
		$this->user->delete_friend($user_id, $friend_id);
		$this->user->delete_friend($friend_id, $user_id);
		redirect('/users/home');
	}
	public function home()
	{

		$id = $this->session->userdata('user_data')['id'];
		$friends = $this->user->get_friends($id);
		$defriends = $this->user->get_defriends($id);
		$user_data = $this->session->userdata('user_data');
		$this->load->view('home', array('fri_data' => $friends, 'defri_data' => $defriends, 'user_data' => $user_data));
	}	
	public function profile($id)
	{
		$user_data = $this->user->get_user($id);
		$this->load->view('profile', array('user_data' => $user_data));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */