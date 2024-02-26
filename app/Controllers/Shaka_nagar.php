<?php

namespace App\Controllers;
use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class Shaka_nagar extends BaseController
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

    // get shaka_nagar 
    public function getshaka_nagar($id=null)
    {
    if($id==null){
    $fetchRecord = $this->model->selectRecord("shaka_nagar");
    $result = [
   "status"=> 200,
   "data"=>$fetchRecord,
    ];
    return $this->respond($result , 200);
    }else{
    $fetchRecord = $this->model->selectRow("shaka_nagar", ["id" => $id]);
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
