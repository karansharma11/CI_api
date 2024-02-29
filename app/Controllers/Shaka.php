<?php

namespace App\Controllers;
use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class Shaka extends BaseController
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



    // get shaka
    public function getshaka($id = null)
    {
        try {
            if ($id == null) {
                $fetchRecord = $this->model->selectRecord("shaka");
                $result = [
                    "status" => 200,
                    "data" => $fetchRecord,
                ];
                return $this->respond($result, 200);
            } else {
                $fetchRecord = $this->model->selectRow("shaka", ["id" => $id]);
                if (!empty($fetchRecord)) {
                    $result = [
                        "status" => 200,
                        "data" => $fetchRecord,
                    ];
                    return $this->respond($result, 200);
                } else {
                    $result = [
                        "status" => 404,
                        "data" => "Record Not Found",
                    ];
                    return $this->respond($result, 404);
                }
            }
        } catch (\Exception $e) {
            $result = [
                "status" => 500,
                "data" => "Internal Server Error: " . $e->getMessage(),
            ];
            return $this->respond($result, 500);
        }
    }
    



    public function create(){
        if($this->request->getMethod() == 'post'){
            try {
                $name = $this->request->getVar("name");
                $basti = $this->request->getVar("basti");
                $date = date("y-m-d H:i:s");
    
                $data = [
                    "name" => $name,
                    "basti" =>$basti,
                    "created_at" => $date,
                ];
    
                $insert = $this->model->insertValue("shaka", $data); 
    
                if($insert){
                    $result = [
                        "status" => 200,
                        "data" => "shaka Created successfully",
                    ];
                    return $this->respond($result, 200);
                } else {
                    $result = [
                        "status" => 404,
                        "data" => "Some Error Occurred",
                    ];
                    return $this->respond($result, 404);
                }
            } catch (\Exception $e) {
                // Handle the exception
                $result = [
                    "status" => 500,
                    "data" => "Internal Server Error: " . $e->getMessage(),
                ];
                return $this->respond($result, 500);
            }
        } else {
            $result = [
                "status" => 404,
                "data" => "Method Not Found",
            ];
            return $this->respond($result, 404);
        }
    }
    

    
    
    
    
     public function delete($id){
    try {
        $selectData = $this->model->selectRow("shaka", ["id" => $id]);     
        
        if (!empty($selectData)) {
            $delete = $this->model->deleteValue("shaka", ["id" => $id]);
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


// get all shaka by basti 
public function getshaka_by_basti($id=null)
{
    try {
        if ($id == null) {
            $fetchRecord = $this->model->selectRecord("shaka");
            $result = [
                "status" => 200,
                "data" => $fetchRecord,
            ];
            return $this->respond($result , 200);
        } else {
            $fetchRecord = $this->model->selectRows("shaka", ["basti" => $id]);
            // if (!empty($fetchRecord)) {
                $result = [
                    "status" => 200,
                    "data" => $fetchRecord,
                ];
                return $this->respond($result , 200);
            // } else {
            //     $result = [
            //         "status" => 404,
            //         "data" => "Record Not Found",
            //     ];
            //     return $this->respond($result , 404);
            // }
        }
    } catch (\Exception $e) {
        $result = [
            "status" => 500,
            "data" => "Internal Server Error: " . $e->getMessage(),
        ];
        return $this->respond($result , 500);
    }
}



   

       



}
