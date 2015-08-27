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
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('alias', 'Alias', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|md5');
		$this->form_validation->set_rules('com_password', 'Comfirm Password', 'required|trim|matches[password]|md5');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');

		if($this->form_validation->run() == true)
		{	
				$insert_id = $this->user->add_user($this->input->post());
				$this->session->set_userdata('user_id', $insert_id);
				$this->session->set_userdata('user_data', $this->input->post());
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
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|vaild_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
		if($this->form_validation->run() ===true)
		{
			$infos = $this->user->get_email($this->input->post());
			$this->session->set_userdata('user_id', $infos['id']);
			$friends = $this->user->get_friends($infos['id']);
			$defriends = $this->user->get_defriends($infos['id']);
			if($infos)
			{	
				$this->session->set_userdata('user_data', $infos);
				$this->load->view('home', array('fri_data' => $friends, 'defri_data' => $defriends));
			}
			else
			{
				$this->session->set_flashdata('errors', "email and/or password is not match!");
				redirect('/');
			}
		}
		else
		{
			//****************just know this can done in form_validation---is_unique[users.email]**************
			$this->session->set_flashdata('errors', "email and/or password can not be empty!");
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
		// if($this->session->userdata('user_data')['id'])
		// {
		// }
		// else
		// {
			
		// }
		$id = $this->session->userdata('user_id');
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