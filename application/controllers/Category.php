<?php
class Category extends CI_Controller{

    public function index(){

        $this->load->helper('url');


        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'Category', 'trim|required|alpha');


        if ($this->form_validation->run() == FALSE)
        {
            $data['content'] = 'category/add';
            $this->load->view('template',$data);
        }

      else
        {

            $category = $this->input->post('category');


            $data = array(
                'name' => $category,
            );
            $this->db->set('create_at', 'NOW()', FALSE);
            $this->load->model('category_model');
            $this->category_model->insert_category($data);
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Category added successfully');
            redirect('category');
            }


        }

    public function category_list()
    {
        $this->load->helper('url');
        $this->load->model('category_model');
        $this->load->library("pagination");
        $config = array();
        //$config["base_url"] = base_url() . "template_list";
        $config["total_rows"] = $this->category_model->record_count();
        $config["per_page"] = 10;
        
        $this->pagination->initialize($config);
        if (isset($_GET["page"]))
        {
            $page  = $_GET["page"];
        }
        else{
            $page=1;
        }
        
        $start_from = ($page-1) * $config["per_page"];
        $data['total_pages']= ceil($config["total_rows"] / $config["per_page"]);
      

        $data['h'] = $this->category_model->list_category($config["per_page"], $start_from);

        $this->load->view('template_list', $data );

    }

       public function category_edit(){
            $this->load->helper('url');
          $id= $this->input->get('id', TRUE);
           $data = array(
               'name' => $this->input->get('name', TRUE),
           );


            $this->load->library('form_validation');
            $this->form_validation->set_rules('edit_category', 'Category', 'trim|required|alpha');

           if ($this->form_validation->run() == FALSE)
           {
               $data['content'] = 'category/edit';
               $this->load->view('template',$data);

           }

           else
           {

             $category = $this->input->post('edit_category');


               $data = array(
                   'name' => $category,
               );
               echo $category;
               $data['id']=$id;
               $this->db->set('update_at', 'NOW()', FALSE);
               $this->load->model('category_model');
               $this->category_model->update_category($data);
               $this->load->library('session');
               $this->session->set_flashdata('success', 'Category updated successfully');
               redirect('category/category_edit');
           }

        
    }
    public function category_delete(){
        $this->load->helper('url');
        $id= $this->input->get('id', TRUE);
        $data=$id;
        $this->load->model('category_model');
        $this->category_model->delete_category($data);

        redirect('category/category_list');
    }
   
    

}


