<?php
class category_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    public function insert_category($data){
        $this->db->insert('category',$data);

    }

    public function record_count() {
        return $this->db->count_all("category");
    }

    public function list_category($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->select('name,id');
        $query = $this->db->get('category');
    return $query;

    }
    
    
    function update_category($data){

        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }

    function delete_category($data)
    {

        $this->db->where('id', $data);
        $this->db->delete('category');
        return true;
    }
}
