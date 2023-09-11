<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public $apiURL = "https://kkisan.karnataka.gov.in/KKISANQRAPI/api/";
  public $userName = "sadukthi@gmail.com";
  public $password = '$Adukthi@432!';
  public $accessToken = 'suHI5iP42Gjo32_1tiQ8MBivDudAQkNXb_sp-JWH1qn6x4QjD3Ps-VOchwszqboJTV6FGi4af5UoJLvg75gm2ZJqxUVajblgDTdITm53aPydxYJK9eHyZEVg_WMK7Poix_X5ZLrEjPVewNmmoS6KuD_mXCy-ADe_kkudyh8VjD8YeDbRRebH3icrh3m_4vBFlDHqBX8gro6Etjy7tDGuzZ9DrdPWktVrZvru4O9pt0DvWcsmCREITonJ7FYXMCE0fx_mxxC9uZ2uDcYfsdj6yU4Mbt7XhkAdBIyHTpEPZVy2820knBq3Q16K9EG9rO7cmRGUKgsRUDJoOKhbpnUZTDmjTdJvI1ZcGjZ0fbrNMChW1c5NV-6ykoDxQ4mz8gDk1EHhyCIEFLlLSOqC5ngQoVXgsTdCzodxsLhnYsKZIaG3kVes8btWW35K6CSCAyvcdzLirr-ZDjMn44jn5ctH43xnCX-X92r1LpxZm9FS88TVxBqGi6gZVjq_NPiLroWsbK911Nit4pBT0U82OcuuyQ';

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
    // $this->pr($post);
    $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $contents = curl_exec($ch); // Execute the cURL statement
    if ($contents === false) {
      echo 'Curl error: ' . curl_error($ch);
    } else {
      $data = array("success"=>true, "Message"=>"Successfull");
    }
    // echo 'came here'.$data = json_decode($contents);
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
