<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Log;
use Auth;
use App\Models\PrimaryLabel;
use App\Models\SecondaryLabel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class Controller extends BaseController {
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public $apiURL = "https://kkisan.karnataka.gov.in/KKISANQRAPI/api/";
  public $userName = "sadukthi@gmail.com";
  public $password = '$Adukthi@432!';
  public $accessToken = 'HHHi4kYIloGfQdw5MMtLTSfpuOZemgsOUlh9JEeISYkt60BtEr_xNuHBxT7ck6HoPS6Bjw7iTSMbZ7N_JmC3QbMOhoybjyxijI45_8nKNw3PWpWLO9DlKG0PY0JD5PPMh4xCRRhMHyt2_ec8lT4EWYKC5Hi5AlIDlFpJmbu8DdqdKxWy8QJ_W_9ccnxovvJRPNgpzMi6DCH66A9_H4p1ixQuZnnz5wtVWTz-3KXlKMRLmcUBcGPToV95Qfk8kXs5OqgVmeqHngU6wtA7ayKTV40l0SCcOwXRglCntt45b6gKk-ZYh6VKCJcn1ryKtLNp0VtdEyicw3rifQIsWyfSK-F1WtcIfzWHWlnzz-HGfytKs_-lYci91mMoyajOUOfcR1RlWzDnweZltn8D_MkP1sZQshDp9jgE_7MY6T_pWIB7OAwqdsgy5AIIcgd3bp0af1K8MEdhhFIRzgLMKjIaqTsinri6J0-l9EkCeUIfSibBXZbxZrUeBfxsgR0jdgQNDa4-nZrAfTHR-xfZ6HJg_w';

  public function fetchAPIData($endPoint) { 
    $dataURL = $this->apiURL.$endPoint;
    $ch = curl_init($dataURL);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($ch);
    if ($contents === false) {
      echo 'Curl error: ' . curl_error($ch);
    } 
    $data = json_decode($contents);
    curl_close($ch);
    return $data;
  }

  public function pr($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }

  public function getPrependCode($codeType='') {
    $prependProCode = config('constant.PREPEND_PRODUCT_CODE');
    $prependConCode = config('constant.PREPEND_CONTAINER_CODE');
    $portalID = config('constant.PORTAL_ID');
    $vendorID = Auth::user()->UserProfile->vendor_id;
    $prependCode = '';
    switch($codeType) {
      case 'product':
        $prependCode = $prependProCode;
      break;
      case 'container':
        $prependCode = $prependConCode;
      break;
    }
    $prependCode .= $portalID.$vendorID;
    return $prependCode;
  }

  public function postDatatoAPI($endPoint, $postData, $token) {
    header('Content-Type: application/json'); // Specify the type of data
    $dataURL = $this->apiURL.$endPoint;
    $ch = curl_init($dataURL); // Initialise cURL
    $post = json_encode($postData); // Encode the data array into a JSON string
    // $this->pr($post);
    $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $contents = curl_exec($ch); // Execute the cURL statement
    // exit;
    if ($contents === false) {
      $error = 'Curl error: ' . curl_error($ch);
      Log::error($error);
    } else { 
      if ($contents) {
        $info = curl_getinfo($ch);
        $data = json_decode(json_encode($contents), true);
        json_decode($contents);
        // $this->pr($data);
        if ($info && $info['http_code'] > 299) {
          $info = 'Api Returns Error'.serialize($contents);
          Log::info($info);
        }
        // $data = json_decode($contents);
      } else {
        $data = array("success"=>true, "Message"=>"Successfull");
      }
    }
    // echo 'came here'.$this->pr($data);
    // exit;
    curl_close($ch);
    return $data;
  }

  public function getAPIToken($endPoint="token") {
    $dataURL = $this->apiURL.$endPoint;
    $ch = curl_init($dataURL);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    $payload = http_build_query(array("username"=>$this->userName, "password"=>$this->password, "grant_type"=>"password"));
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    
    // curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($ch);
    if ($contents === false) {
      echo 'Curl error: ' . curl_error($ch);
    } 
    $data = json_decode($contents);
    curl_close($ch);
    return $data;
  }

  public function getLastRecordCounter() {
    $primaryRecord = PrimaryLabel::sum('quantity') ?? 0;  
    $primaryRecord = 700;
    $secondaryRecord = PrimaryLabel::sum('quantity') ?? 0; 
    // $secondaryRecord = SecondaryLabel::sum('primary_quantity') ?? 0;  
    // $secondaryRecord = 610;
    // $secondaryRecord = SecondaryLabel::get()->count() ?? 0;  
    return $lastRecord = $primaryRecord + $secondaryRecord;
  }

  public function generateQrCodes($qrCodes, $labelFrom, $labelTo, $type, $recordID) {
    $qrCodesArray = [];
    $counter = 0;
    $labelFrom--;
    // switch($type) {
    //   case 'primary':
    //     $prependCode = config('constant.PREPEND_PRIMARY_CODE');
    //   break;
    //   case 'secondary':
    //     $prependCode = config('constant.PREPEND_SECONDARY_CODE');
    //   break;
    // }
    $prependCode = $this->getPrependCode();
    $filePath = public_path("qrcodes".DIRECTORY_SEPARATOR."$type".DIRECTORY_SEPARATOR."$recordID");
    if (!file_exists("$filePath")) {
      mkdir("$filePath", 0777, true);
    }
    for ($counter = $labelFrom; $counter<$labelTo; $counter++) {
      $value = $qrCodes[$counter];
      // $qrCodeValue = $prependCode . str_pad($value, 10, '0', STR_PAD_LEFT);
      $dbQRCodeValue = str_pad($value, 10, '0', STR_PAD_LEFT);
      $imgQRCode = $prependCode.$dbQRCodeValue;
      // contiune;
      $fileName = "qrcode_$dbQRCodeValue.svg";
      $filefullPath = $filePath.DIRECTORY_SEPARATOR.$fileName;
      if (!file_exists("$filefullPath")) {
        $qrCode = QrCode::generate("$imgQRCode", $filefullPath);
      }
      // $qrCode = QrCode::format('png')->generate("$qrCodeValue", $filefullPath);
      $qrCodesArray[] = [
        'qrCode' => $filefullPath,
        'value' => $qrCodeValue,
      ];            
      // file_put_contents($filePath, $qrCode);
    }
    return $qrCodesArray;
  }
}