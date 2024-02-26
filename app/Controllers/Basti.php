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
    public function getbasti($id=null)
    {
    if($id==null){
    $fetchRecord = $this->model->selectRecord("basti");
    $result = [
   "status"=> 200,
   "data"=>$fetchRecord,
    ];
    return $this->respond($result , 200);
    }else{
    $fetchRecord = $this->model->selectRow("basti", ["id" => $id]);
    if(!empty($fetchRecord)){
        $result = [
            "status"=> 200,
            "data"=>$fetchRecord,
             ];
            return $this->respond($result , 200);

    }else{
        $result = [
            "status"=> 404,
            "data"=>"Record Not Found",
             ];
            return $this->respond($result , 404);

    }
    }
    }



// get all basti by shaka id 
    public function getbasti_byshaka($id=null)
    {
    if($id==null){
    $fetchRecord = $this->model->selectRecord("basti");
    $result = [
   "status"=> 200,
   "data"=>$fetchRecord,
    ];
    return $this->respond($result , 200);
    }else{
    $fetchRecord = $this->model->selectRows("basti", ["shaka_nagar" => $id]);
    if(!empty($fetchRecord)){
        $result = [
            "status"=> 200,
            "data"=>$fetchRecord,
             ];
            return $this->respond($result , 200);

    }else{
        $result = [
            "status"=> 404,
            "data"=>"Record Not Found",
             ];
            return $this->respond($result , 404);

    }
    }
    }

   

       



}
