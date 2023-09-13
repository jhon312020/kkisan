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
  public $accessToken = 'LtcWtTXgdWGggb8cXA4oSvM6nraC4Azh54BzlJ1IKow1AQebkZtmms7GDK16ULPib4Q9Ua8gcoeniBbW5BqWxMtA0Cih_dwZo067XWJ8FG3ilAEQBTaed4WdVMnvc1AXS1eAyDp6ivsor-lnNefhdplvyFAxs22F0TR4w5y-rcqA1LZE4qfNJjPQ8u-SUAk3ow2ANI_Pk_yTnW02JGDMg6cug18zumkF-INj2YXqvWf-RZVB5O091xxqerGFSyHMdTRi3zlLqZOrvRfNB84Mo3wHzEUslP-h2hFXkdxIi8bUAZc66XCOstWrVgH2M3T6rM1TtEHjgqYClN6JybA76UdmQV_vzi_ATr_D1gJi_ULdwceUsLAPY7HX1mnX275xvCS_5d_czyJ2h1vWWthlRtjKJlETgErXN8sUen7COyBNv3bxiTHXRHX2oyCD34mXWpsS8Zl_kk8mq5lsPSXlvc9Is0fAo9zevYu3kMyD0Aqz6SErZqhLb56pFEUjWtSWD0DzZPzVNVnt9r-3Ha30ZA';

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

  public function postDatatoAPI($endPoint, $postData, $token) {
    header('Content-Type: application/json'); // Specify the type of data
    $dataURL = $this->apiURL.$endPoint;
    $ch = curl_init($dataURL); // Initialise cURL
    $post = json_encode($postData); // Encode the data array into a JSON string
    $this->pr($post);
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
