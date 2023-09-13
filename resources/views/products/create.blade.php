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
    <div class="page-header">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"> Information </li>
      </ol>
      <div class="ml-auto">
        <div class="input-group">
          <a href="{{ route('products.excelView') }}" type="button" class="btn btn-primary">Import From Excel</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="e-panel card">
          <div class="card-header">{{ __('Add Product') }} <a href="{{ url('/products') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="fa-brands fa-product-hunt"> </i>Product List</a></div>
          <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
              @csrf      
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 form-group">
                    <label for="exampleInputEmail1">Is Secondary Label Needed</label>
                    <select name="is_secondary" class="form-control">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for=""> Application Id</label>
                    <select class="form-control" name="ApplicationID" id="jsApplicationID">
                      @if ($applications)
                      <option value="">Choose Application</option>
                      @foreach ($applications as $application)
                      <option value="{{ $application->ApplicationID }}">{{ $application->ApplicationName }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" id="company_name"
                        placeholder="Enter Company Name" name="company_name" value="">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Manufacturer Name</label>
                    <input type="text" class="form-control" id="ManufacturerName"
                        placeholder="Enter Manufacturer Name" name="ManufacturerName" value="">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Supplier/RC Holder Name</label>
                    <input type="text" class="form-control" id=""
                        placeholder="Enter Supplier/RC Holder Name" name="SupplierName" value="">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Marketed By</label>
                    <input type="text" class="form-control" id="MarketedBy"
                        placeholder="Enter Marketed By" name="MarketedBy">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" id="ProductName"
                        placeholder="Enter Product Name" name="ProductName">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Category Name</label>
                    <div id='jsCatContainer'>
                      <select name="ItemCategoryID" class="form-control" id="ItemCategoryID">
                        @if ($categories)
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->ItemCategoryID }}">{{ $category->ItemCategoryName }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="SubCategoryID">Choose Subcategory</label>
                    <div id='jsSubCatContainer'>
                      <select name="SubCategoryID" id="SubCategoryID" class="form-control">
                        <option value="">Choose SubCategory</option>
                        @if ($subcategories)
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->SubCategoryID }}">{{ $subcategory->SubCategoryName }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Item Name</label>
                    <div id='jsItemContainer'>
                      <select name="ItemID" class="form-control" id="ItemID">
                        <option value="">Choose Item</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Brand Name</label>
                    <input type="text" class="form-control" id="BrandName"
                        placeholder="Enter Brand Name" name="BrandName">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for="">Net Weight</label>
                    <input type="number" class="form-control" id="Weight" step=".001"
                        placeholder="Enter Weight" name="Weight">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label for=""> Unit of Measurement</label>
                    <select class="form-control" name="UomID" id="UomID">
                      <option value="">Choose Unit of Measurement</option>
                      @if ($guoms)
                      @foreach ($guoms as $guom)
                      <option value="{{ $guom->UomID }}">{{ $guom->UomName }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>   
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#jsApplicationID').change(function() {
      var applicationID = $(this).val();
      $.ajax({
        url: '/get-product-category',
        type: "GET",
        data: {
         applicationID : applicationID,
        },
        success: function(data, textStatus, jqXHR) {
          $('#jsCatContainer').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
    })

    $('#jsApplicationID').change(function() {
      var applicationID = $(this).val();
      $.ajax({
        url: '/get-product-subcategory',
        type: "GET",
        data: {
          applicationID: applicationID,
        },
        success: function(data, textStatus, jqXHR) {
          $('#jsSubCatContainer').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
    })
    $('#jsApplicationID').change(function() {
      var applicationID = $(this).val();
      $.ajax({
        url: '/get-product-items',
        type: "GET",
        data: {
          applicationID: applicationID,
        },
        success: function(data, textStatus, jqXHR) {
          $('#jsItemContainer').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
    })
  })
</script>
@endsection