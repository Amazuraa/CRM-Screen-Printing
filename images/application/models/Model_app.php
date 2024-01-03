<?php 
class Model_app extends CI_model{
    public function get($table=null, $id= null){
        if($id==null){
            return $this->db->get($table);
        }else{
            return $this->db->get_where($table, $id);
        }
    }

    function AddData($tabel, $data=array())
    {
        $this->db->insert($tabel,$data);
        $this->db->insert_id();
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }

    public function update($table,$data,$where){
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

     function DeleteData($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }


     function UpdateData($tabel,$fieldid,$fieldvalue,$data=array())
    {
        $this->db->where($fieldid,$fieldvalue)->update($tabel,$data);
    }

    
    function AddDataBatch($tabel, $data=array())
    {
        $this->db->insert_batch($tabel,$data);
    }
    


    function GetDataWhere($tabel,$id,$nilai)
    {
        $this->db->where($id,$nilai);
        $query= $this->db->get($tabel);
        return $query;
    }

    
    function GetDataWhere1($tabel,$id,$nilai)
    {
        $this->db->select('biaya');
        $this->db->where($id,$nilai);
        $query= $this->db->get($tabel);
        return $query;
    }

   
}