<?php

namespace App\Controllers;
use App\models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class MobileVerification extends BaseController
{
    use ResponseTrait;
    private $model;
    function __construct(){
        $this->model = new CommonModel();
    }

    public function index($id=null)
    {
        {
            switch ($_POST["action"]) {
                case "send_otp":
                    
                    $mobile_number = $_POST['mobile_number'];
                    
                    $apiKey = urlencode('YOUR_API_KEY');
                    $Textlocal = new Textlocal(false, false, $apiKey);
                    
                    $numbers = array(
                        $mobile_number
                    );
                    $sender = 'PHPPOT';
                    $otp = rand(100000, 999999);
                    $_SESSION['session_otp'] = $otp;
                    $message = "Your One Time Password is " . $otp;
                    
                    try{
                        $response = $Textlocal->sendSms($numbers, $message, $sender);
                        require_once ("verification-form.php");
                        exit();
                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    break;
                    
                case "verify_otp":
                    $otp = $_POST['otp'];
                    
                    if ($otp == $_SESSION['session_otp']) {
                        unset($_SESSION['session_otp']);
                        echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
                    } else {
                        echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));
                    }
                    break;
            }
        }
    }

    

       






        }
