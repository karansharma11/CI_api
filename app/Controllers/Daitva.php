<?php

namespace App\Controllers;
use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class Daitva extends BaseController
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



    // get daitva

    public function getdaitva($id = null)
    {
        try {
            if ($id == null) {
                $fetchRecord = $this->model->selectRecord("daitva");
                $result = [
                    "status" => 200,
                    "data" => $fetchRecord,
                ];
                return $this->respond($result, 200);
            } else {
                $fetchRecord = $this->model->selectRow("daitva", ["id" => $id]);
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

        // create daitva 
        public function create(){
            if($this->request->getMethod() == 'post'){
                try {
                    $name = $this->request->getVar("name");
                    $date = date("y-m-d H:i:s");
        
                    $data = [
                        "name" => $name,
                        "created_at" => $date,
                    ];
        
                    $insert = $this->model->insertValue("daitva", $data); 
        
                    if($insert){
                        $result = [
                            "status" => 200,
                            "data" => "daitva Created successfully",
                        ];
                        return $this->respond($result, 200);
                    } else {
                        $result = [
                            "status" => 404,
                            "data" => "
                             Error Occurred",
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




        //   delete daitva 
        public function delete($id){
            try {
                $selectData = $this->model->selectRow("daitva", ["id" => $id]);     
                
                if (!empty($selectData)) {
                    $delete = $this->model->deleteValue("daitva", ["id" => $id]);
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
