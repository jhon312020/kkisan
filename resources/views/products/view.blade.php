@extends('layouts.defaultAdmin')
@section('content')
<br>
<div class="container">
  <div class="row justify-content-center">
    @if (Session::has('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
    </div>
    @endif
    <br>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class=" mb-0">
            <div class="card-header d-sm-flex">
              <h5 class="card-title mb-0">Product Details</h5>
            </div>
            <!-- end row -->
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-md-12 m-5">
                  <div class="table-responsive m-t-5 m-b-5">
                    <table class="table table-bordered text-nowrap table-responsive">
                      <tbody>
                        <tr>
                          <td class="text-uppercase  font-weight-bold">Company Name</td>
                          <td>{{$product->company_name}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Product Code </td>
                          <td>{{$product->ProductCode}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Manufacturing Name </td>
                          <td>{{$product->ManufacturerName}}
                          </td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Supplier Name</td>
                          <td>{{$product->SupplierName}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Product Name</td>
                          <td>{{$product->ProductName}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Category Name</td>
                          <td>{{$product->Category->ItemCategoryName}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Subcategory Name</td>
                          <td>{{$product->SubCategory->SubCategoryName}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Brand Name</td>
                          <td>{{$product->BrandName}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Weight</td>
                          <td>{{$product->Weight}}</td>
                        </tr>
                        <tr>
                          <td class="text-uppercase  font-weight-bold"> Unit Of Measurement</td>
                          <td>{{$product->UnitOfMeasurement->UomName}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
@endsection
