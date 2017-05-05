<?php
/**
 * Product model contain product related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */

class product_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /*
    * function name :record_count
    *  To get no. of rows in category
    *
    * @author	Antony
    * @access	public
    * @param : 
    * @return : array
    */
    public function get_dropdown()
    {
        $this->db->select('name,id');
        $query = $this->db->get('category');
        return $query;

    }
    
    /*
    * function name :insert_product
    *  To insert category
    *
    * @author	Antony
    * @access	public
    * @param : character
    * @return : none
    */
    public function insert_product($data)
    {
        $this->db->insert('product', $data);
        
    }
    
    /*
     * function name :record_count
     *  To get no. of rows in product
     *
     * @author	Antony
     * @access	public
     * @param : 
     * @return : number
     */
    public function record_count() {
        return $this->db->count_all("product");
    }
    
    /*
   * function name :list_product
   *  To get all data in product
   *
   * @author	Antony
   * @access	public
   * @param :  number
   * @return : array
   */
    public function list_product($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->select('product.name AS productname,product.id,price,image,category.name');
        $this->db->from('product');
        $this->db->join('category', 'category.id = product.category');
        $query = $this->db->get();
      //  echo $this->db->last_query();die;
        return $query;
    }
    /*
    * function name :get_product
    * To get data at id passed
    *
    * @author	Antony
    * @access	public
    * @param : number
    * @return : array
    */
    public function get_product($id){

        $this->db->select('product.name AS productname, product.id,price,image,category.name');
        $this->db->from('product');
        $this->db->join('category', 'category.id = product.category');
        $this->db->where('product.id', $id);
        $query = $this->db->get()->row();
      //  echo $this->db->last_query();die;
        return $query;
    }

    /*
    * function name :update_product
    * To update data at id passed
    *
    * @author	Antony
    * @access	public
    * @param : number
    * @return : array
    */
    public function update_product($data,$id){

        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }
    
    /*
  * function name :delete_product
  * To delete data at id passed
  *
  * @author   Antony
  * @access   public
  * @param : number
  * @return : boolean
  */
    public function delete_product($data)
    {

        $this->db->where('id', $data);
        $this->db->delete('product');
        return true;
    }
    
      /*
       * function name : delete_category_multiple
       * To delete bulk data at id passed
       *
       * @author   Antony
       * @access   public
       * @param : array
       * @return : boolean
       */
   public function delete_product_multiple($data)
    {
        foreach($data as $value) {
            $this->db->where('id', $value);
            $this->db->delete('product');
        }
        return true;
    }
}

/* End of file Product_model.php */
/* Location: ./CI/index.php/Product_model.php */
?>
