<?php

namespace App\Core;

use App\Core\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Sitefunction;
use DateTime;
use Exception;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class MyController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->utc_time = date('Y-m-d H:i:s');
        $this->utc_date = date('Y-m-d');

        $this->statuscodes = array(
            300 => "Invalid Credentials",
            301 => "Account Deactivated",
            302 => "Authorization Failed",
            303 => "Data Missing",
            304 => "Email id and contact already exists",
            305 => "Admin Not Registered",
            306 => "Invalid URL Format",
            307 => "Contact already exists",
            308 => "Email or contact already exists",
            309 => "Details not updated",
            310 => "New password and confirm password does'nt match",
            311 => "Error while adding the data",
            312 => 'OTP is Invalid',
            313 => 'Subadmin ID doesnt exists',
            314 => 'Survey ID doesnt exists',
            315 => 'Voter enrollment details already exists',
            316 => 'Project code already exists',
            317 =>  'Unit name already exists',
            318 =>  'Parameter name already exists',
            319 =>  'Tool Code already exists',
            320 =>  'Tool is already added in the inventory',
            404 => 'Invalid Api Call',
            334 => 'Operation code already exists',
            335 =>  'This operation is already been allocated to tool',
            340 => 'Machine code already exists',
            341 => 'This Project is already been allocated to company',
            344 => 'This Company is already been allocated to Site Engineer',
            343 => 'This Company is already been allocated to Procurement Member',
            342 => 'This Tool is already been allocated to parameter',
            350 => 'Component code already exists',
            351 => 'This machine is already been allocated to operation',
            352 => 'Shift name already exists',
            360 => 'This tool is already been allocated to company',
        );
        $model = new Sitefunction();
        $this->dataModule = array();
    }

    public function checkLogin()
    {
        $adminID = $this->session->get('admin_id');
        if (empty($adminID)) {
            return "-1";
        } else {
            $adminName = $this->session->get('admin_name');
            return $adminName;
        }
    }

    public function getDateFormat($date)
    {
        $date1 = new DateTime($date);
        $date2 = new DateTime("now");
        $interval = $date1->diff($date2);
        $finaldate = "";
        if ($interval->y != 0) {
            $finaldate = $interval->y . " years ago";
        } else if ($interval->m != 0) {
            $finaldate = $interval->m . " months ago";
        } else if ($interval->d != 0) {
            $finaldate = $interval->d . " days ago";
        } else if ($interval->h != 0) {
            $finaldate = $interval->h . " hours ago";
        } else if ($interval->i != 0) {
            $finaldate = $interval->i . " minutes ago";
        } else if ($interval->s != 0) {
            $finaldate = $interval->s . " seconds ago";
        }

        return $finaldate;
    }

    public function getKey()
    {
        return "my_application_secret";
    }

    public function getCipher()
    {
        $ciphering = 'AES-128-CTR';
        return $ciphering;
    }

    public function getEncryptioniv()
    {
        $encryption_iv = '1234567891011121';
        return $encryption_iv;
    }

    public function encryptdata($encryptData)
    {
        $encrypteddata = openssl_encrypt($encryptData, $this->getCipher(), $this->getKey(), 0, $this->getEncryptioniv());
        return $encrypteddata;
    }

    public function decryptdata($decryptData)
    {
        $decryptedData = openssl_decrypt($decryptData,  $this->getCipher(), $this->getKey(), 0, $this->getEncryptioniv());
        return $decryptedData;
    }

    function success($json)
    {
        $jsonData = array(
            "success" => true,
            "payload" => $json,
            "error" => array(
                "code" => 0,
                "message" => "",
            ),
        );

        return $jsonData;
    }

    function failure($error_code, $message = "")
    {
        $jsonData = array(
            "success" => false,
            "payload" => (object)array(),
            "error" => array(
                "code" => $error_code,
                "message" => $message == "" ? $this->statuscodes[$error_code] : $message,
            ),
        );

        return $jsonData;
    }

    function verify()
    {
        $key = $this->getKey();
        $authHeader = $this->request->header("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        $userId = -1;
        try {
            $decoded = JWT::decode($token, new Key($key, "HS256"));
            $userId = $decoded->data;
        } catch (Exception $ex) {
            return $userId;
        }
        return $userId;
    }

    public function sendMail($to, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('sukruthindlekar39@gmail.com', 'Tools and Management Sevices');

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return 1;
        } else {

            return 0;
        }
    }

    public function sendTestMail($to, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('mail_id', 'Project_name');

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return "IF : " . $email->printDebugger(['headers']);
        } else {
            return "Else : " . $email->printDebugger(['headers']);
        }
    }

    public function generateOTP()
    {

        $generator = "1357902468";
        $n = 4;
        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        return $result;
    }

    public function generateOTPSixDigit()
    {

        $generator = "1357902468";
        $n = 6;
        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        return $result;
    }

    public function randomReferralcode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomstr = '';
        for ($i = 0; $i < random_int(6, 6); $i++) {
            $randomstr .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomstr;
    }

    public function fetchProjectDetails()
    {
        $model = new Sitefunction();
        $result = $model->get_single_row(TBL_MASTER_SETTINGS, '*');
        return $result;
    }
}
