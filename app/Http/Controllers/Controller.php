<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Log;

class Controller extends BaseController {
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public $apiURL = "https://kkisan.karnataka.gov.in/KKISANQRAPI/api/";
  public $userName = "sadukthi@gmail.com";
  public $password = '$Adukthi@432!';
  public $accessToken = 'A88Rbf3ISucv_jaz2B8XUHklkc08nQBGyYZjZUKE2vsnucOOEd4Rhw3HqPmRX2vnmwSNy1D9XxyCkWYhJ52lm0E1x9KQCFFZh8--GQnO8su84inwvJTyaoPG8sJn0RQwzJRboFawNggPe5gdWHW_PX4aaCfOdxn3ydROJ6B2vtAzSQHsnd7dx6KXaudhoHRVx7smUa0OCYuC6AunZXCFX6UTLvmzMoo2sEebcmYCXAICCZ8blSN-hbOmnhzJz9yMDcF-L-cGjZE-dj3PT4lNz2efzatpCTUxcdWiXxocgonnMLKjzpH7LJPPkMO4Q_-1GVtmE5_Kt3Szaj2wvK8vbO2zha-0xSP0_1UZb5f-3Y9w-8f6cnu8TQET-DOh5cffNbkd_c0qkQ7um7_MBkpYwTW4WKXgFctydat0OI1blYkh1X4IeGRso-eavWAwWMMIBvxfoCvEQM3QxttBkJiWDoxQJnWrlAsyMWFeb0TI7DKmCe3dlXI6jchGKvAFT_RhicKVBVteQapvgHneQf0cqw';

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
    $portalID = config('constant.PORTAL_ID');
    $vendorID = Auth::user()->UserProfile->vendor_id;
    $prependCode = '';
    switch($codeType) {
      case 'product':
        $prependCode = $prependProCode;
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

}
