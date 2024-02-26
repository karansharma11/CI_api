<?php

namespace App\Controllers;

use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
// use Cloudinary;

class User extends BaseController
{
    use ResponseTrait;
    private $model;
    function __construct(){
        $this->model = new CommonModel();
    }

          public function login(){
            if($this->request->getMethod()=='post'){
            //    echo password_hash("karan11" , PASSWORD_DEFAULT);
            //  die();
             $phone_no = $this->request->getVar("phone_no");
             $password=$this->request->getVar("password");
             $selectData =  $this->model->selectRow("users" , ["phone_no"=>$phone_no]);
             if(!empty($selectData)){
               if(password_verify($password , $selectData->password )){
                $key = getenv('JWT_SECRET');
                $iat = time(); // current timestamp value
                $exp = $iat + 3600;
         
                $payload = array(
                    "iss" => "Issuer of the JWT",
                    "aud" => "Audience that the JWT",
                    "sub" => "Subject of the JWT",
                    "iat" => $iat,
                    "exp" => $exp, 
                    "phone_no" => $selectData->phone_no,
                );
                 
                $token = JWT::encode($payload, $key, 'HS256');
         
                $result = [
                    "status"=>200,
                    'message' => 'Login Succesfull',
                    'token' => $token,
                    'data'=>$selectData
                ];
                return $this->respond($result, 200);
                }else{
                    $result = [
                    "status"=>404,
                        "data"=>"Incorrect Password ",
                    ];
                return $this->respond($result, 404);

                }
             }else{
                $result = [
                    "status"=>404,
                    "data"=>"User Not Found",
                ];
                return $this->respond($result, 404);

             }                
            }else{
                $result = [
                    "status"=>404,
                    "data"=>"Method Not Found",
                ];
                return $this->respond($result, 404);

            }
          }

          public function uploadImage()
            {
        try {
        // Load Cloudinary configuration
        $cloudName = getenv('CLOUDINARY_CLOUD_NAME');
        $apiKey = getenv('CLOUDINARY_API_KEY');
        $apiSecret = getenv('CLOUDINARY_API_SECRET');

        // Initialize Cloudinary
    
        \Cloudinary::config([
            'cloud' => [
                'cloud_name' => $cloudName,
                'api_key' => $apiKey,
                'api_secret' => $apiSecret,
            ]
        ]);
        $file = $this->request->getFile("file");

        // Check if file was uploaded successfully
        if ($file->isValid() && $file->getSize() > 0) {
            // Upload image to Cloudinary
            $result = \Cloudinary\Uploader::upload($file->getTempName());

            // Check if upload was successful
            if (isset($result['secure_url'])) {
                return [
                    'status' => 'success',
                    'url' => $result['secure_url']
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Failed to upload image to Cloudinary'
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Invalid file or file not found'
            ];
        }
    } catch (\Exception $e) {
        return [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
}

          

          public function create(){
            if($this->request->getMethod()=='post'){
            
            //  $file = $this->request->getFile("file");
             $name = $this->request->getVar("name");
             $phone_no=$this->request->getVar("phone_no");
             $role = $this->request->getVar("role");
             $address = $this->request->getVar("address");
             $city = $this->request->getVar("city");
             $near_by=$this->request->getVar("near_by");
             $nagar = $this->request->getVar("nagar");
             $age = $this->request->getVar("age");
             $accupation = $this->request->getVar("accupation");
             $shaka_nagar=$this->request->getVar("shaka_nagar");
             $basti = $this->request->getVar("basti");
             $shakha=$this->request->getVar("shakha");
             $vibhag=$this->request->getVar("vibhag");
             $daitva=$this->request->getVar("daitva");
             $date = date("y-m-d H:i:s");

            // $imageResult = $this->uploadImage();
            // print_r("Hello");
            // echo $name;
            // die();

             $data = [
             "name"=>$name,
             "phone_no"=>$phone_no,
             "role"=>$role,
             "city"=>$city,
             "address"=>$address,
             "near_by"=>$near_by,
             "nagar"=>$nagar,
             "age"=>$age,
             "accupation"=>$accupation,
             "shaka_nagar"=>$shaka_nagar,
             "basti"=>$basti,
             "shakha"=>$shakha,
             "vibhag"=>$vibhag,
             "daitva"=>$basti,
             "created_at"=>$date,
               ];
               $insert =$this->model->insertValue("users" , $data); 
               if($insert){
                $result = [
                    "status"=>200,
                    "data"=>"Registration successfull",
                ];
                $this->respondCreated($result);
               }else{
                $result = [
                    "status"=>404,
                    "data"=>"Some Error Occured",
                ];
                return $this->respond($result, 404);
               }
            }else{
                $result = [
                    "status"=>404,
                    "data"=>"Record Not Found",
                ];
                return $this->respond($result, 404);
            }
          }
}
