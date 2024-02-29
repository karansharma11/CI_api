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

    public function selectRows($table, $where = array())
{
    $builder = $this->db->table($table);
    $builder->where($where);
    $result = $builder->get()->getResult(); // Use getResult() instead of getRow()
    return $result;
}

public function getUsersWithDetails($id = null)
{
    try {
        if ($id == null) {
            $builder = $this->db->table('users');
            $builder->select('users.id as user_id,users.name as user_name, users.accupation, users.age, users.address,users.nagar,users.phone_no,users.city ,shikshan.id as shikshan_id,shikshan.name as shikshan_name, shikshan.*,daitva.id as daitva_id,daitva.name as daitva_name, daitva.*, vibhag.id as vibhag_id,vibhag.name as vibhag_name, vibhag.*, shaka_nagar.id as shaka_nagar_id,shaka_nagar.name as shaka_nagar_name, shaka_nagar.*,shaka.id as shaka_id,shaka.name as shaka_name, shaka.*, basti.id as basti_id, basti.name as basti_name, basti.*');
            $builder->join('shaka', 'shaka.id = users.shaka', 'left');
            $builder->join('basti', 'basti.id = users.basti', 'left');
            $builder->join('shaka_nagar', 'shaka_nagar.id = users.shaka_nagar', 'left');
            $builder->join('vibhag', 'vibhag.id = users.vibhag', 'left');
            $builder->join('daitva', 'daitva.id = users.daitva', 'left');
            $builder->join('shikshan', 'shikshan.id = users.shikshan', 'left');
            $query = $builder->get();
            if ($query) {
                $results = $query->getResult();
              //  print_r($result);
                $result = [
                    "status" => 200,
                    "data" =>  $results,
                ];
                return $result;
            } else {
                echo "Error executing the query: " . $this->db->error();
            }

        } else {
            $builder = $this->db->table('users');
            $builder->select('users.id as user_id, users.name as user_name, shikshan.id as shikshan_id, shikshan.name as shikshan_name, shikshan.*, daitva.id as daitva_id, daitva.name as daitva_name, daitva.*, vibhag.id as vibhag_id, vibhag.name as vibhag_name, vibhag.*, shaka_nagar.id as shaka_nagar_id, shaka_nagar.name as shaka_nagar_name, shaka_nagar.*, shaka.id as shaka_id, shaka.name as shaka_name, shaka.*, basti.id as basti_id, basti.name as basti_name, basti.*');
            $builder->join('shaka', 'shaka.id = users.shaka', 'left');
            $builder->join('basti', 'basti.id = users.basti', 'left');
            $builder->join('shaka_nagar', 'shaka_nagar.id = users.shaka_nagar', 'left');
            $builder->join('vibhag', 'vibhag.id = users.vibhag', 'left');
            $builder->join('daitva', 'daitva.id = users.daitva', 'left');
            $builder->join('shikshan', 'shikshan.id = users.shikshan', 'left');
            $builder->where('users.id', $id);
            $query = $builder->get();

            if ($query) {
                $result = [
                    "status" => 200,
                    "data" => $query->getRow(),
                ];
                return $result;
            } else {
                echo "Error executing the query: " . $this->db->error();
            }
        }
        
    } catch (\Exception $e) {
        $result = [
            "status" => 500,
            "data" => "Internal Server Error: " . $e->getMessage(),
        ];
        return $result;
    }
}






}
