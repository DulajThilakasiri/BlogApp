<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

	//This is the view blog controller 
	public function viewblog()
	{
		$query = $this->db->query('SELECT * FROM `article` ORDER BY blogID');
		$data['result'] = $query->result_array();

		$this->load->view('admin/Viewblogview', $data);
	}

	//This is the Add blog controller 
	public function addBlog()
	{
		$this->load->view('admin/Addblogview');
	}


	//This is the add blog post controller 
	public function addblog_post()
	{
		print_r($_POST);
		print_r($_FILES);

		if ($_FILES) {
			$config['upload_path']          = './assets/uploads/blogimg/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			


			$this->load->library('upload', $config);

			if (! $this->upload->do_upload('blog_file')) {
				$error = array('error' => $this->upload->display_errors());


				die("Error");
			} else {
				$data = array('upload_data' => $this->upload->data());


				$file_url = "/assets/uploads/blogimg/" . $data['upload_data']['file_name'];
				$blog_title = $_POST['blog_title'];
				$blog_desc = $_POST['blog_desc'];

				$query = $this->db->query("INSERT INTO `article` (`blogTitle`, `blogDescription`, `blogImage`) VALUES ('$blog_title', '$blog_desc', '$file_url')");

				if ($query) {
					$this->session->set_flashdata('inserted', 'yes');

					redirect('admin/Blog/viewblog');
				}
			}
		} else {
		}
	}

	//This is the edit blog controller 
	public function editBlog($blog_id)
	{
		// print_r($blog_id);
		$query = $this->db->query("SELECT `blogTitle`, `blogDescription`, `blogImage` FROM `article` WHERE `blogID` = ?", array($blog_id));

		
		$data['result'] = $query->result_array();
		$data['blog_id'] = $blog_id;
		$this->load->view('admin/EditBlogView',$data);
	}

	public function editblog_post(){
		print_r($_POST);
		print_r( $_FILES);

		if($_FILES['blog_file']['name']){
			// die("Update File");
			$config['upload_path']          = './assets/uploads/blogimg/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			


			$this->load->library('upload', $config);

			if (! $this->upload->do_upload('blog_file')) {
				$error = array('error' => $this->upload->display_errors());


				die("Error");
			} else {
				$data = array('upload_data' => $this->upload->data());
				// echo "<pre>";
				// print_r($data ['upload_data']['file_name']);

				$filename_loacation = "assets/uploads/blogimg/ ".$data ['upload_data']['file_name'];

				$blog_title = $_POST ['blog_title'];
				$desc = $_POST['blog_desc'];
				$blog_id = $_POST['blog_id'];

				$query = $this->db->query("UPDATE `article` SET `blogTitle`='$blog_title',`blogDescription`='$desc' WHERE `blogID` = '$blog_id'");

				if($query){
					$this->session->set_flashdata('updated', 'yes');
					redirect('admin/Blog/viewblog');
				}
				else{
					$this->session->set_flashdata('updated', 'no');
					redirect('admin/Blog/viewblog');
				}


						

		}
			} else
		{
			die("Update without file");
		}
	}


	
	//This is the delete blog controller 
	public function deleteBlog()
	{
		print_r($_POST);
		$delete_id = $_POST['delete_id'];

		$query = $this->db->query("DELETE FROM `article` WHERE `blogID` = '$delete_id' ");

		if ($query) {
			echo "deleted";
			redirect('admin/Blog/viewblog');

		} else {
			echo "notDeleted";
		}
	}
}
