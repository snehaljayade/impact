<?php
	class C_designation_detail extends CI_Controller{
		
		function __construct(){
			parent::__construct();
		}
		 
		function add($aid=-1){
			$this->load->model('alumni_info','ev');
			$data['alumni_info'] = $this->ev->find_by_id($aid);
			
			if(!$data['alumni_info'])
				redirect('core/c_alumni_info/viewall');
				$this->load->model('designation_detail','mb');
			
			$this->form_validation->set_rules('organization_name', 'Organization Name', 'required|alpha|trim[designation_detail.organization_name]');
			$this->form_validation->set_rules('organization_address', 'Organization Address', 'required[designation_detail.organization_address]');
			$this->form_validation->set_rules('organization_city', 'Organization City', 'required|alpha|trim[designation_detail.organization_city]');
			$this->form_validation->set_rules('organization_contact', 'Organization Contact', 'numeric[designation_detail.organization_contact]');
			$this->form_validation->set_rules('website', 'Website', 'required|valid_url[designation_detail.website]');
			$this->form_validation->set_rules('organization_department', 'Organization Department', 'alpha|trim[designation_detail.organization_department]');
			$this->form_validation->set_rules('position', 'Position', 'required[designation_detail.position]');
			$this->form_validation->set_rules('from_year', 'From Year', 'numeric[designation_detail.from_year]');
			$this->form_validation->set_rules('to_year', 'To Year', 'numeric[designation_detail.to_year]');


			$data['message'] = '';
			
			if ($this->form_validation->run() == TRUE){
				$this->mb->alumni_id = $aid;
				$this->mb->organization_name = $_POST['organization_name'];
				$this->mb->organization_address = $_POST['organization_address'];
				$this->mb->organization_city = $_POST['organization_city'];
				$this->mb->organization_contact = $_POST['organization_contact'];
				$this->mb->website = $_POST['website'];
				$this->mb->organization_department = $_POST['organization_department'];
				$this->mb->position = $_POST['position'];
				$this->mb->from_year = $_POST['from_year'];
				$this->mb->to_year = $_POST['to_year'];


				$this->mb->save();
				
				$data['message'] = 'Detail sumbit successfully';
			}
			
			$this->load->view('core/designation_detail/add',$data);
			
		}
		
		function edit($id){
			$this->load->model('designation_detail','mb');
			
			$data['message'] = '';
			
			$data['object'] = $this->mb->find_by_id($id);
			
			if($data['object']){
				
				$this->form_validation->set_rules('organization_name', 'Organization Name', 'required|alpha|trim[designation_detail.organization_name]');
				$this->form_validation->set_rules('organization_address', 'Organization Address', 'required| [designation_detail.organization_address]');
				$this->form_validation->set_rules('organization_city', 'Organization City', 'required|alpha[designation_detail.organization_city]');
				$this->form_validation->set_rules('organization_contact', 'Organization Contact', 'numeric[designation_detail.organization_contact]');
				$this->form_validation->set_rules('website', 'Website', 'required|valid_url[designation_detail.website]');
				$this->form_validation->set_rules('organization_department', 'Organization Department', 'alpha|trim[designation_detail.organization_department]');
				$this->form_validation->set_rules('position', 'Position', 'required|alpha[designation_detail.position]');
				$this->form_validation->set_rules('from_year', 'From Year', 'numeric[designation_detail.from_year]');
				$this->form_validation->set_rules('to_year', 'To Year', 'numeric[designation_detail.to_year]');

				if ($this->form_validation->run() == TRUE){
					$this->mb->desig_id = $id;
					$this->mb->alumni_id = $data['object']->alumni_id;
					$this->mb->organization_name = $_POST['organization_name'];
					$this->mb->organization_address = $_POST['organization_address'];
					$this->mb->organization_city = $_POST['organization_city'];
					$this->mb->organization_contact = $_POST['organization_contact'];
					$this->mb->website = $_POST['website'];
					$this->mb->organization_department = $_POST['organization_department'];
					$this->mb->position = $_POST['position'];
					$this->mb->from_year = $_POST['from_year'];
					$this->mb->to_year = $_POST['to_year'];


					$this->mb->save();
					
					$data['message'] = 'Detail updated successfully';
					
					$data['object'] = $this->mb;
				}
				
				$this->load->view('core/designation_detail/edit',$data);
			}
			else{
				$data['message'] = 'No record exists. Create it!';	
				$this->load->view('core/designation_detail/add',$data);
			}
			
		}
		
		function viewall(){
			$this->load->model('designation_detail','mb');
			$data['objects'] = $this->mb->find_all();
			if(!empty($data['objects']))
			{
				$this->load->view('core/designation_detail/viewall',$data);
			}
			else{
				$data['message'] = 'No record exists. Create one!';	
				$this->load->view('core/designation_detail/add',$data);
			}
		}
function view($id){
			$this->load->model('designation_detail','mb');
				
			$data['message'] = '';
			
			$data['object'] = $this->mb->find_by_id($id);
			
			

					$this->mb->desig_id = $id;
					$this->mb->alumni_id = $data['object']->alumni_id;
					$this->mb->desig_id=$data['object']->desig_id;
					$this->mb->organization_name = $data['object']->organization_name;
					$this->mb->organization_address = $data['object']->organization_address;
					$this->mb->organization_city = $data['object']->organization_city;
					$this->mb->organization_contact = $data['object']->organization_contact;					
					$this->mb->website = $data['object']->website;
					$this->mb->organization_department = $data['object']->organization_department;
					$this->mb->position = $data['object']->position;
					$this->mb->from_year = $data['object']->from_year;
					$this->mb->to_year = $data['object']->to_year;

					
					//$data['message'] = 'updated successfully';
					
					$data['object'] = $this->mb;
						
				$this->load->view('core/designation_detail/view',$data);
			
			
			
		}







		



















		function delete($id){
			$this->load->model('designation_detail','mb');
			$this->mb = $this->mb->find_by_id($id);
			if($this->mb){
				$this->mb->delete();
			}
			redirect('core/c_designation_detail/viewall');
		}
		
	}
