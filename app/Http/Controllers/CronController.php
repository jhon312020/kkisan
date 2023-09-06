<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\UnitOfMeasurement;
use App\Models\Category;
use Carbon\Carbon;

class CronController extends Controller {
  public $now = null;
  public function __construct() {
    $this->now = Carbon::now('utc')->toDateTimeString();
  }
  public function getApplications() {
    $newApplications = null;
    $applications = $this->fetchAPIData('Master/GetKKISANApplications');
    if ($applications) {
      $modelObj = new Application();
      $this->recordInsert($modelObj, 'Application', $applications);
    }
  }

  public function getUnitOfMeasurements() {
    // $subcategories = $this->fetchAPIData('Master/GetItemSubCategory?ApplicationID=FL');
    // $item = $this->fetchAPIData('Master/GetItemDetail?ApplicationID=FL');
    $newUoms = null;
    $uoms = $this->fetchAPIData('GetUnitOfMeasurements');
    if ($uoms) {
      $modelObj = new UnitOfMeasurement();
      $this->recordInsert($modelObj, 'UnitOfMeasurement', $uoms);
    }
  }

  public function getCategories() {
    $newCategories = null;
    $categories = $this->fetchAPIData('Master/GetItemCategory?ApplicationID=FL');
    if ($categories) {
      $modelObj = new Category();
      $this->recordInsert($modelObj, 'Category', $categories);
    }
  }

  function recordInsert($modelObj, $model, $apiRecords) {
    $newRecords = null;
    foreach ($apiRecords as $apiRecord) {
      switch($model) {
        case 'Application':
          $conditions = ['ApplicationID'=>$apiRecord->ApplicationID];
          $existingRecords[] = $apiRecord->ApplicationID;
        break; 
        case 'Category':
          $conditions = ['ItemCategoryID'=>$apiRecord->ItemCategoryID];
          $existingRecords[] = $apiRecord->ItemCategoryID;
        break; 
        case 'UnitOfMeasurement':
          $conditions = ['UomID'=>$apiRecord->UomID];
          $existingRecords[] = $apiRecord->UomID;
        break;
      }
      $modelRecord = $modelObj::where($conditions)->first();
      if (!$modelRecord) {
        $apiRecordArr = (array) $apiRecord;
        $newRecord = array();
        foreach($apiRecordArr as $fieldName=>$value) {
          $newRecord["$fieldName"] = $value;
        }
        $newRecord['local_status'] = 1;
        $newRecord['created_at'] = $this->now;
        $newRecord['updated_at'] = $this->now;
        $newRecords[] = $newRecord;
      }
      // $this->pr($newRecords);
    }
    if ($newRecords) {
      $modelObj::insert($newRecords);
    }
  }

  public function getApplicationsBackup() {
    $newApplications = null;
    $applications = $this->fetchAPIData('Master/GetKKISANApplications');
    if ($applications) {
      // foreach ($applications as $application) {
      //   $applicationRecord = Application::where('application_id', $application->ApplicationID)->first();
      //   if (!$applicationRecord) {
      //     $newApplications[] = array(
      //       'application_id' => $application->ApplicationID, 
      //       'application_name' => $application->ApplicationName,
      //       'status' => 1,
      //       'created_at' => $this->now,
      //       'updated_at' => $this->now,
      //     );
      //   } 
      //   $existingApplications[] = $application->ApplicationID;
      // }
      // // $this->pr($existingApplications);
      // if ($newApplications) {
      //   Application::insert($newApplications);
      // }
      $modelObj = new Application();
      $this->recordInsert($modelObj, 'Application', $applications);
    }
  }
    
}
