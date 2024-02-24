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
    if($id==null){
    $fetchRecord = $this->model->selectRecord("users");
    $result = [
   "status"=> 201,
   "data"=>$fetchRecord,
    ];
    }else{
    $fetchRecord = $this->model->selectRow("users", ["id" => $id]);
    if(!empty($fetchRecord)){
        $result = [
            "status"=> 201,
            "data"=>$fetchRecord,
             ];
    }else{
        $result = [
            "status"=> 404,
            "data"=>"Record Not Found",
             ];
    }
    }
    return $this->respond($result);
    }

    public function delete($id){
    $selectData =  $this->model->selectRow("users" , ["id"=>$id]);     
    if(!empty($selectData)){
    $delete = $this->model->deleteValue("users" ,  ["id"=>$id]);
    if($delete){
    $result = [
        "status"=>201,
        "data"=>"Delete Successfully",
    ];
    }else{
    $result = [
        "status"=>404,
        "data"=>"Some Error Found",
    ];
    }
    }else{
    $result = [
        "status"=>404,
        "data"=>"Record Not Found",
    ];
    }   

    return $this->respond($result);
    }

    public function role($id , $role){
        $selectData =  $this->model->selectRow("users" , ["id"=>$id]);     
        if(!empty($selectData)){
       
         $data = [
            "role"=>$role
         ];

         $updateRole =  $this->model->updateValue("users" , ["id"=>$id] , $data);     
        if($updateRole){
         $result = [
        "status"=>201,
        "data"=>"Update data Successfully",
         ];
         }else{
         $result = [
        "status"=>404,
        "data"=>"Some Error Found",
         ];
         }
         }else{
          $result = [
              "status"=>404,
              "data"=>"Record Not Found",
          ];
        }   
         return $this->respond($result);
          }


       



}
