<?php

namespace App\Controllers;
use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    private $model;
    function __construct(){
        $this->model = new CommonModel();
    }

    public function index($id=null)
    {
        $result = [
            "status"=> 200,
            "data"=>"Welcome To CI APIs!",
             ];
             return $this->respond($result , 200);
    
    }
    public function getusers($id = null)
    {
        try {
// print_r("hello");
// // die();
            $fetchRecord = $this->model->getUsersWithDetails($id);
            return $this->respond($fetchRecord, $fetchRecord['status']);

            // if ($id == null) {
            //     $fetchRecord = $this->model->selectRecord("users");
            //     $result = [
            //         "status" => 200,
            //         "data" => $fetchRecord,
            //     ];
            //     return $this->respond($result, 200);
            // } else {
            //     $fetchRecord = $this->model->selectRow("users", ["id" => $id]);
            //     if (!empty($fetchRecord)) {
            //         $result = [
            //             "status" => 200,
            //             "data" => $fetchRecord,
            //         ];
            //         return $this->respond($result, 200);
            //     } else {
            //         $result = [
            //             "status" => 404,
            //             "data" => "Record Not Found",
            //         ];
            //         return $this->respond($result, 404);
            //     }
            // }
        } catch (\Exception $e) {
            $result = [
                "status" => 500,
                "data" => "Internal Server Error: " . $e->getMessage(),
            ];
            return $this->respond($result, 500);
        }
    }



    public function delete($id){
        try {
            $selectData = $this->model->selectRow("users", ["id" => $id]);     
            
            if (!empty($selectData)) {
                $delete = $this->model->deleteValue("users", ["id" => $id]);
                if ($delete) {
                    $result = [
                        "status" => 201,
                        "data" => "Delete Successfully",
                    ];
                    return $this->respond($result, 200);
                } else {
                    $result = [
                        "status" => 404,
                        "data" => "Some Error Found",
                    ];
                    return $this->respond($result, 404);
                }
            } else {
                $result = [
                    "status" => 404,
                    "data" => "Record Not Found",
                ];
                return $this->respond($result, 404);
            }
        } catch (\Exception $e) {
            $result = [
                "status" => 500,
                "data" => "Internal Server Error: " . $e->getMessage(),
            ];
            return $this->respond($result, 500);
        }  
    }
    



       



}
