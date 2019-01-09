<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('AppModel');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

	}

	public function index()
	{

		$config = array();
		$config["base_url"] = base_url() . 'index.php/welcome/index/';
		$total_row = $this->AppModel->record_count('blog');
		$config["total_rows"] = $total_row;
		$config["per_page"] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close'] 	= '</ul></nav></div>';
		$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] 	= '</span></li>';
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] 	= '</span></li>';
		$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] 	= '</span></li>';

		$this->pagination->initialize($config);
		if($this->uri->segment(3))
		{
			$page = ($this->uri->segment(3)) ;
		}
		else
		{
			$page = 1;
		}
		$data["posts"] = $this->AppModel->fetch_data($config["per_page"], $page);
		$str_links = $this->pagination->create_links();
		$data["links"] = $str_links;
		
		$this->load->view('head', $data);
		$this->load->view('welcome_message');
		$this->load->view('foot');
	}


	public function admin()
	{
		if ($this->session->userdata('loggedIn')) {
			redirect('home');
		}
		else
		{
			$data['flashData'] = $this->session->flashdata('message');
			$this->load->view('head', $data);
			$this->load->view('adminLogin');
			$this->load->view('foot');
		}
	}


	public function checkLogin()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'You must provide a %s.')
        );
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->admin();
        }
        else
        {
        	$username = $this->input->post('username');
        	$password = $this->input->post('password');
           	if ($this->AppModel->checkLogin($username, $password)) {
           		redirect('home');
           	}

           	$this->session->set_flashdata('message', 'Invalid Login');
           	$this->admin();
        }
	}


	public function home()
	{
		if ($this->session->userdata('loggedIn')) {



			$config = array();
			$config["base_url"] = base_url() . 'index.php/welcome/home/';
			$total_row = $this->AppModel->record_count('blog');
			$config["total_rows"] = $total_row;
			$config["per_page"] = 5;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] 	= '</ul></nav></div>';
			$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] 	= '</span></li>';
			$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] 	= '</span></li>';
			$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] 	= '</span></li>';

			$this->pagination->initialize($config);
			if($this->uri->segment(3))
			{
				$page = ($this->uri->segment(3)) ;
			}
			else
			{
				$page = 1;
			}
			$data["posts"] = $this->AppModel->fetch_data($config["per_page"], $page);
			$str_links = $this->pagination->create_links();
			$data["links"] = $str_links;
			$data['flashData'] = $this->session->flashdata('message');
			$this->load->view('head', $data);
			$this->load->view('home');
			$this->load->view('foot');
		}
	}


	public function addPostPage()
	{
		if ($this->session->userdata('loggedIn')) {
			$this->load->view('head');
			$this->load->view('addPostPage');
			$this->load->view('foot');
		}
		else
		{
			redirect('/');
		}
		
	}


	public function addPost()
	{
		if ($this->session->userdata('loggedIn')) {
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[5]',
	                array(
	                	'required' 	 => 'You must provide a %s.',
	                	'min_length' => '%s must at least 5 Characters'
	               	)
	        );

	        $this->form_validation->set_rules('description', 'Description', 'required|min_length[20]',
	                array(
	                	'required' 	 => 'You must provide a %s.',
	                	'min_length' => '%s must at least 20 Characters.'
	               	)
	        );


	        if ($this->form_validation->run() == FALSE)
	        {
	            $this->addPostPage();
	        }
	        else
	        {
	        	
	        	$data  = array('title' => $this->input->post('title'), 'description' => $this->input->post('description'));
	        	$this->db->insert('blog', $data);
	        	$this->session->set_flashdata('message', 'Successfully saved!');
	           	redirect('home');
	        }
		}
		else
		{
			redirect('/');
		}
	}


	public function editPostPage($id)
	{
		if ($this->session->userdata('loggedIn')) {
			$data['post'] = $this->AppModel->getWhere('blog', $id);
			$this->load->view('head', $data);
			$this->load->view('editPostPage');
			$this->load->view('foot');
		}
		else
		{
			redirect('/');
		}
	}


	public function editPost()
	{
		if ($this->session->userdata('loggedIn')) {
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[5]',
	                array(
	                	'required' 	 => 'You must provide a %s.',
	                	'min_length' => '%s must at least 5 Characters'
	               	)
	        );

	        $this->form_validation->set_rules('description', 'Description', 'required|min_length[20]',
	                array(
	                	'required' 	 => 'You must provide a %s.',
	                	'min_length' => '%s must at least 20 Characters.'
	               	)
	        );


	        if ($this->form_validation->run() == FALSE)
	        {
	            $this->addPostPage();
	        }
	        else
	        {
	        	$id = $this->input->post('id');
	        	$data  = array('title' => $this->input->post('title'), 'description' => $this->input->post('description'));
	        	$this->AppModel->update('blog', $data, $id);
	        	$this->session->set_flashdata('message', 'Successfully updated!');
	           	redirect('home');
	        }
		}
		else
		{
			redirect('/');
		}
	}

	public function deletePost($id)
	{
		if ($this->session->userdata('loggedIn')) {
			
			$this->db->delete('blog', array('id' => $id));
			$this->session->set_flashdata('message', 'Successfully deleted!');
			redirect('home');
		}
		else
		{
			redirect('/');
		}
	}
}
