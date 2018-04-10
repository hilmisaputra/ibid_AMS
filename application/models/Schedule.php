<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Model {

	var $table = 'schedules';
    var $column_order = array('id', 'date','place_id','interval','type','category_id','waktu'); //set column field database for datatable orderable
    var $column_search = array('id','date','place_id','interval','type','category_id','waktu'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc');

	function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function insertSchedule($post) {
        $this->db->insert("schedules", $post);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function updateSchedule($post) {
        $id = $post['id'];
        unset($post['id']);
        $this->db->update("schedules", $post,"id = ".$id);
        return true;
    }

    function getScheduleById($postId)
    {
        return $this->db->get_where($this->table, array('id'=>$postId))->row();
    }

    public function deleteSchedule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return true;
    }

}