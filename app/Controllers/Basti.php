<?php

namespace App\Controllers;
use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class Basti extends BaseController
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

  

    // get_basti
    public function getbasti($id = null)
    {
        try {
            if ($id == null) {
                $fetchRecord = $this->model->selectRecord("basti");
                $result = [
                    "status" => 200,
                    "data" => $fetchRecord,
                ];
                return $this->respond($result, 200);
            } else {
                $fetchRecord = $this->model->selectRow("basti", ["id" => $id]);
                if (!empty($fetchRecord)) {
                    $result = [
                        "status" => 200,
                        "data" => $fetchRecord,
                    ];
                    return $this->respond($result, 200);
                } else {
                    $result = [
                        "status" => 400,
                        "data" => "Record Not Found",
                    ];
                    return $this->respond($result, 400);
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


// need to change here 
// get all basti by shaka_nagar id 
public function getbasti_byshaka_nagar($id=null)
{
    try {
        if ($id == null) {
            $fetchRecord = $this->model->selectRecord("basti");
            $result = [
                "status" => 200,
                "data" => $fetchRecord,
            ];
            return $this->respond($result , 200);
        } else {
            $fetchRecord = $this->model->selectRows("basti", ["shaka_nagar" => $id]);
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


     // create basti
     public function create(){
        if($this->request->getMethod() == 'post'){
            try {
                $name = $this->request->getVar("name");
                $shaka_nagar = $this->request->getVar("shaka_nagar");
                $date = date("y-m-d H:i:s");
    
                $data = [
                    "name" => $name,
                    "shaka_nagar"=>$shaka_nagar,
                    "created_at" => $date,
                ];
    
                $insert = $this->model->insertValue("basti", $data); 
    
                if($insert){
                    $result = [
                        "status" => 200,
                        "data" => "basti Created successfully",
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


    //   delete basti 
    public function delete($id){
        try {
            $selectData = $this->model->selectRow("basti", ["id" => $id]);     
            
            if (!empty($selectData)) {
                $delete = $this->model->deleteValue("basti", ["id" => $id]);
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
