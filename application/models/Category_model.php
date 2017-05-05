<?php
/**
 * category model contain category related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */
class category_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * function name :insert_category
     *  To insert category
     *
     * @author	Antony
     * @access	public
     * @param : character
     * @return : none
     */
    public function insert_category($data){
        $this->db->insert('category',$data);

    }

    /*
     * function name :record_count
     *  To get no. of rows in category
     *
     * @author	Antony
     * @access	public
     * @param : 
     * @return : number
     */
    public function record_count() {
        return $this->db->count_all("category");
    }

    /*
    * function name :list_category
    *  To get all data in category
    *
    * @author	Antony
    * @access	public
    * @param : number
    * @return : array
    */
    public function list_category($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->select('name,id');
        $query = $this->db->get('category');
    return $query;

    }
    
    /*
    * function name :get_category
    * To get data at id passed
    *
    * @author	Antony
    * @access	public
    * @param : number
    * @return : array
    */
    public function get_category($id){
        $this->db->select('id,name');
        $this->db->where('id', $id);
        $query = $this->db->get('category')->row();
//        echo $this->db->last_query();

        return $query;
    }

    /*
    * function name :update_category
    * To update data at id passed
    *
    * @author	Antony
    * @access	public
    * @param : number
    * @return : array
    */
    public function update_category($data,$id){

        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }

    /*
   * function name :delete_category
   * To delete data at id passed
   *
   * @author   Antony
   * @access   public
   * @param : number
   * @return : boolean
   */
    public function delete_category($data)
    {

        $this->db->where('id', $data);
        $this->db->delete('category');
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
    public function delete_category_multiple($data)
    {
        foreach($data as $value) {
            $this->db->where('id', $value);
            $this->db->delete('category');
        }
        return true;
    }
}
/* End of file Category_model.php */
/* Location: ./CI/index.php/Category_model.php */
?>
