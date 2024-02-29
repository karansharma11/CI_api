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
    public function login()
    {
        if ($this->request->getMethod() == 'post') {
            try {
//                  $password = password_hash("karan11", PASSWORD_BCRYPT); 
// print_r($password);
// die();

                $phone_no = $this->request->getVar("phone_no");
                $password = $this->request->getVar("password");
                $selectData = $this->model->selectRow("users", ["phone_no" => $phone_no]);
                if (!empty($selectData)) {
                    if (password_verify($password, $selectData->password)) {
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

                        unset($selectData->password);
    
                        $result = [
                            "status" => 200,
                            'message' => 'Login Successful',
                            'token' => $token,
                            'data' => $selectData
                        ];
                        return $this->respond($result, 200);
                    } else {
                        $result = [
                            "status" => 404,
                            "data" => "Incorrect Password",
                        ];
                        return $this->respond($result, 404);
                    }
                } else {
                    $result = [
                        "status" => 404,
                        "data" => "User Not Found",
                    ];
                    return $this->respond($result, 404);
                }
            } catch (\Exception $e) {
                // Handle the exception
                $errorMessage = $e->getMessage();
                $result = [
                    "status" => 500,
                    "data" => $errorMessage,
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
    
//           public function uploadImage()
//             {
//         try {
//         // Load Cloudinary configuration
//         $cloudName = getenv('CLOUDINARY_CLOUD_NAME');
//         $apiKey = getenv('CLOUDINARY_API_KEY');
//         $apiSecret = getenv('CLOUDINARY_API_SECRET');

//         // Initialize Cloudinary
    
//         \Cloudinary::config([
//             'cloud' => [
//                 'cloud_name' => $cloudName,
//                 'api_key' => $apiKey,
//                 'api_secret' => $apiSecret,
//             ]
//         ]);
//         $file = $this->request->getFile("file");

//         // Check if file was uploaded successfully
//         if ($file->isValid() && $file->getSize() > 0) {
//             // Upload image to Cloudinary
//             $result = \Cloudinary\Uploader::upload($file->getTempName());

//             // Check if upload was successful
//             if (isset($result['secure_url'])) {
//                 return [
//                     'status' => 'success',
//                     'url' => $result['secure_url']
//                 ];
//             } else {
//                 return [
//                     'status' => 'error',
//                     'message' => 'Failed to upload image to Cloudinary'
//                 ];
//             }
//         } else {
//             return [
//                 'status' => 'error',
//                 'message' => 'Invalid file or file not found'
//             ];
//         }
//     } catch (\Exception $e) {
//         return [
//             'status' => 'error',
//             'message' => $e->getMessage()
//         ];
//     }
// }

public function uploadImage()
{
    try {
        $file = $this->request->getFile("file");

        // Check if file was uploaded successfully
        if ($file->isValid() && $file->getSize() > 0) {
            // Define the directory where you want to store the uploaded images
            $uploadDirectory = 'uploads/';

            // Generate a unique filename to avoid conflicts
            $filename = uniqid() . '_' . $file->getName();

            // Move the uploaded file to the upload directory
            $file->move($uploadDirectory, $filename);

            // Construct the URL of the uploaded image
            $imageUrl = base_url() . $uploadDirectory . $filename;

            return [
                'status' => 'success',
                'url' => $imageUrl
            ];
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

          

public function create()
{
    if ($this->request->getMethod() == 'post') {
        try {
            $name = $this->request->getVar("name");
            $phone_no = $this->request->getVar("phone_no");
            $role = $this->request->getVar("role");
            $address = $this->request->getVar("address");
            $city = $this->request->getVar("city");
            $near_by = $this->request->getVar("near_by");
            $nagar = $this->request->getVar("nagar");
            $age = $this->request->getVar("age");
            $accupation = $this->request->getVar("accupation");
            $shaka_nagar = $this->request->getVar("shaka_nagar");
            $basti = $this->request->getVar("basti");
            $shaka = $this->request->getVar("shaka");
            $vibhag = $this->request->getVar("vibhag");
            $daitva = $this->request->getVar("daitva");
            $shikshan = $this->request->getVar("shikshan");

            $date = date("y-m-d H:i:s");

            $imageResult = $this->uploadImage();

            $data = [
                "name" => $name,
                "phone_no" => $phone_no,
                "role" => $role,
                "profile_photo" => $imageResult['url'],
                "city" => $city,
                "address" => $address,
                "near_by" => $near_by,
                "nagar" => $nagar,
                "age" => $age,
                "accupation" => $accupation,
                "shaka_nagar" => $shaka_nagar,
                "basti" => $basti,
                "shaka" => $shaka,
                "vibhag" => $vibhag,
                "daitva" => $daitva,
                "shikshan" => $shikshan,
                "created_at" => $date,
            ];

            $insert = $this->model->insertValue("users", $data);
            if ($insert) {
                $result = [
                    "status" => 200,
                    "data" => "Registration successful",
                ];
                return $this->respond($result, 202);
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
            "data" => "Record Not Found",
        ];
        return $this->respond($result, 404);
    }
}

}
