<?php

namespace App\Models;

use CodeIgniter\Model; // Import the Model class

class CommonModel extends Model // Extend the Model class
{
    public function insertValue($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->insert($data);
        return true;
    }

    public function updateValue($table, $where, $data)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteValue($table, $where)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->delete();
        return true;
    }

    public function selectRecord($table, $where = array())
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $result = $builder->get()->getResult(); // Correct method name
        return $result;
    }

    public function selectRow($table, $where = array())
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $result = $builder->get()->getRow(); // Correct method name
        return $result;
    }
}
