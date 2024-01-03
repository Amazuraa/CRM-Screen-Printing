<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSudi extends CI_Model
{
    function AddData($tabel, $data=array())
    {
		// Insert syntax
        $this->db->insert($tabel,$data);
    }

    function UpdateData($tabel,$fieldid,$fieldvalue,$data=array())
    {
		// Update syntax
        $this->db->where($fieldid,$fieldvalue)->update($tabel,$data);
    }

    function UpdateDataBatch($tabel, $data=array(), $fieldid)
    {
        $this->db->update_batch($tabel, $data, $fieldid);
    }

    function DeleteData($tabel,$fieldid,$fieldvalue)
    {
		// Delete syntax
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }

    function DeleteDataBatch($tabel, $data=array(), $fieldid)
    {
        $this->db->where_in($fieldid, $data);
        $this->db->delete($tabel);
    }

    function GetData($tabel)
    {
		// Get Table Data syntax
        $query= $this->db->get($tabel);
		
		// Show result
        return $query->result();
    }

    function GetDataWhere($tabel,$id,$nilai)
    {
        $this->db->where($id,$nilai);
        $query= $this->db->get($tabel);
        return $query;
    }

    function GetDataWhere2($tabel, $id, $nilai, $id2, $nilai2)
    {
        $this->db->where($id,$nilai);
        $this->db->where($id2,$nilai2);
        $query= $this->db->get($tabel);
        return $query;
    }

    function JoinData($table1, $table2, $joinfield)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $joinfield);
        $query = $this->db->get();
        return $query->result();
    }

    function SelectDataWhere($tabel, $field, $id, $nilai)
    {
        $this->db->select($field);
        $this->db->where($id,$nilai);
        $query = $this->db->get($tabel);

        return $query;
    }

    function SelectData($tabel, $field)
    {
        $this->db->select($field);
        $query = $this->db->get($tabel);

        return $query->result();
    }

    function SelectData2($tabel, $field1, $field2)
    {
        $this->db->select($field1);
        $this->db->select($field2);
        $query = $this->db->get($tabel);

        return $query->result();
    }

    function SelectDataWhere3($tabel, $field, $field2, $field3, $id, $nilai)
    {
        $this->db->select($field);
        $this->db->select($field2);
        $this->db->select($field3);
        $this->db->where($id,$nilai);
        $query = $this->db->get($tabel);

        return $query->result();
    }
}