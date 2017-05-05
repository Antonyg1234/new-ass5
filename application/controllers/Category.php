<?php
/**
 * Category controller contain category related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */

class Category extends CI_Controller{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('category_model');
    }

        /*
         * function name :index
         *  To list category
         *
         * @author	Antony
         * @access	public
         * @param :
         * @return : none
         */
    public function index()
    {
        // pagination array declared
        $config = array();
        $config["total_rows"] = $this->category_model->record_count(); //getting total no. of rows in database
        $config["per_page"] = 10; //maximum data allowed per page
        //initialize config data
        $this->pagination->initialize($config);
        if (isset($_GET["page"])) //getting page no.
        {
            $page  = $_GET["page"];
        }
        else{
            $page=1;
        }
        $start_from = ($page-1) * $config["per_page"]; //start of data to be displayed in listing page
        $data['total_pages']= ceil($config["total_rows"] / $config["per_page"]); //total no. of pages required to display list
        //fetching data from database depending on start and limit
        $data['list_name'] = $this->category_model->list_category($config["per_page"], $start_from);
        $this->load->view('template_list', $data ); // displaying view page of category list

    }

    /*
     * function name :add
     *  To add category
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    public function add(){
      //validation for input category field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|alpha');

        if ($this->form_validation->run() == FALSE)//if validation is false load the page and display error msg
        {
            $data['content'] = 'category/add';
            $this->load->view('template',$data);
        }
        else //validation true input data into database and display success msg
        {
            $category = $this->input->post('category');

            $data = array(
                'name' => $category,
            );
            $this->db->set('create_at', 'NOW()', FALSE);
            $this->category_model->insert_category($data);
            $this->session->set_flashdata('success', 'Category added successfully');
            redirect('category/add');
        }


    }

    /*
   * function name :edit
   *  To edit category
   *
   * @author	Antony
   * @access	public
   * @param :
   * @return : none
   */
         public function edit($id = 0){
           //$id= $this->input->get('id', TRUE);
             $this->form_validation->set_rules('edit_category', 'Category', 'trim|required|alpha');

             if ($this->form_validation->run() == FALSE) {
                 $data['test'] = $this->category_model->get_category($id);
                 $data['id'] =   $id;
                 $data['content'] = 'category/edit';
                 $this->load->view('template', $data);
             }
           
           else {
                   $category = $this->input->post('edit_category');
                   $data = array(
                       'name' => $category,
                   );

                   
                   $this->db->set('update_at', 'NOW()', FALSE);
                   $this->category_model->update_category($data,$id);
                   $this->session->set_flashdata('success', 'Category updated successfully');
                   redirect('category');
               }



        
    }

    /*
     * function name :delete
     *  To delete category
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */
    public function delete(){
        $id= $this->input->get('id', TRUE); //getting id from url
        $data=$id;
        $this->category_model->delete_category($data);
        redirect('category');
    }

     /*
      * function name :bulk_Delete
      *  To delete category in bulk
      *
      * @author	Antony
      * @access	public
      * @param :
      * @return : none
      */
    public function bulk_Delete(){

        $id= $this->input->get('id');  //getting id from url
       $data = explode(",",$id);  //converting sting of id into array
        $this->category_model->delete_category_multiple($data);
        redirect('category');
    }
}
/* End of file Category.php */
/* Location: ./CI/index.php/Category.php */
?>
