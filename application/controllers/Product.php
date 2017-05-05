<?php
/**
 * Product controller contain product related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */
class Product extends CI_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('product_model');
    }
    /*
      * function name :index
      *  To list product
      *
      * @author	Antony
      * @access	public
      * @param :
      * @return : none
      */
    public function index()
    {   // pagination array declared
        $config = array();
        $config["total_rows"] = $this->product_model->record_count();  //getting total no. of rows in database
        $config["per_page"] = 10;  //maximum data allowed per page
        //initialize config data
        $this->pagination->initialize($config);
        if (isset($_GET["page"]))  //getting page no.
        {
            $page  = $_GET["page"];
        }
        else{
            $page=1;
        }

        $start_from = ($page-1) * $config["per_page"]; //start of data to be displayed in listing page
        $data['total_pages']= ceil($config["total_rows"] / $config["per_page"]); //total no. of pages required to display list
        //fetching data from database depending on start and limit
        $data['list'] = $this->product_model->list_product($config["per_page"], $start_from);


         $this->load->view('templateproduct_list', $data ); // displaying view page of category list
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
    public function add()
    {
        $data = array();
        $picture = "";
        $data['dropdown'] = $this->product_model->get_dropdown();
        $data['content'] = 'product/add';

        $this->form_validation->set_rules('product', 'Product', 'trim|required|alpha');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('category_select', 'Category', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('template', $data);
        }else 
        {
            if (!empty($_FILES)){
                
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png';
                //initialize upload config data
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('uploadedimage'))
                {
                    $data['error'] = array('error' => $this->upload->display_errors());
                    $this->load->view('template', $data);
                }else{
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }
            }

            $product = $this->input->post('product');
            $price = $this->input->post('price');
            $category = $this->input->post('category_select');

            $data = array(
                'name' => $product,
                'price' => $price,
                'category' => $category,
                'image' => $picture,
            );
            $this->db->set('created_at', 'NOW()', FALSE);
            $this->product_model->insert_product($data);
            $this->session->set_flashdata('success', 'Product added successfully');
            redirect('product/add');
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
    public function edit($id = 0)
    {
        $data = array();
        $picture = "";
        $data['dropdown'] = $this->product_model->get_dropdown();
        $data['content'] = 'product/edit';
        $data['id'] =   $id;

        $this->form_validation->set_rules('product', 'Product', 'trim|required|alpha');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('category_select', 'Category', 'required');

        if ($this->form_validation->run() == FALSE)
        {

            $data['product_data'] = $this->product_model->get_product($id);
           // print_r($data['product_data']);die();
            $this->load->view('template', $data);
        }else
        {
            if (!empty($_FILES)){

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png';
                //initialize upload config data
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

            if(! $this->upload->do_upload('uploadedimage'))
            {
                $data['error'] = array('error' => $this->upload->display_errors());
                $this->load->view('template', $data);

            }else{
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            }
            }

            $product = $this->input->post('product');
            $price = $this->input->post('price');
            $category = $this->input->post('category_select');

            $data = array(
                'name' => $product,
                'price' => $price,
                'category' => $category,
                'image' => $picture,
            );
            $this->db->set('updated_at', 'NOW()', FALSE);
            $this->product_model->update_product($data,$id);
            $this->session->set_flashdata('success', 'Product updated successfully');
            redirect('product');
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
        $id= $this->input->get('id', TRUE);  //getting id from url
        $data=$id;
        $this->product_model->delete_product($data);
        redirect('product');
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
        $id= $this->input->get('id'); //getting id from url
        $data = explode(",",$id); //converting sting of id into array
        $this->product_model->delete_product_multiple($data);
        redirect('product');
    }
   
}
/* End of file Product.php */
/* Location: ./CI/index.php/Product.php */
?>
