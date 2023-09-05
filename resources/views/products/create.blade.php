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
        <div class="col-lg-12">
          <div class="e-panel card">
            <div class="card-header">{{ __('Add Product') }} <a href="{{ url('/productHome') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="fa-brands fa-product-hunt"></i>Product</a></div>
            <div class="card-body">
              <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf      
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 form-group">
                      <label for="exampleInputEmail1">Is Secondary Label Needed</label>
                      <select name="secondary" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for=""> Application Id</label>
                      <select class="form-control" name="applicationid" id="applicationid">
                        @foreach ($applications as $application)
                        <option value="{{ $application->ApplicationID }}">{{ $application->ApplicationName }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Company Name</label>
                      <input type="text" class="form-control" id="company_name"
                          placeholder="Enter Company Name" name="company_name" value="sadukti">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Manufacturer Name</label>
                      <input type="text" class="form-control" id="manufacturer_name"
                          placeholder="Enter Manufacturer Name" name="manufacturer_name" value="sadukti">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Supplier/RC Holder Name</label>
                      <input type="text" class="form-control" id=""
                          placeholder="Enter Supplier/RC Holder Name" name="supplier_name" value="sadukti">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Product Name</label>
                      <input type="text" class="form-control" id="product_name"
                          placeholder="Enter Product Name" name="product_name">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Category Name</label>
                      <select name="category" class="form-control" id="category">
                        @foreach ($categorries as $category)
                        <option value="{{ $category->ItemCategoryName }}">{{ $category->ItemCategoryName }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="sub_category">Choose Subcategory</label>
                      <select name="sub_category" id="sub_category" class="form-control">
                        @foreach ($subcategorries as $subcategory)
                        <option value="{{ $subcategory->SubCategoryName }}">{{ $subcategory->SubCategoryName }}</option>
                        @endforeach
                        <option value="other">other</option>
                      </select>
                      <input type="text" class="form-control" id="other-sub_category"
                      placeholder="Enter Subcategory" name="custom_sub_category" value="other">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Brand Name</label>
                      <input type="text" class="form-control" id=""
                          placeholder="Enter Brand Name" name="brand_name">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Net Weight</label>
                      <input type="number" class="form-control" id="weight" step=".001"
                          placeholder="Enter Weight" name="weight">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for=""> Unit of Measurement</label>
                      <select class="form-control" name="uomid" id="uomid">
                        @foreach ($guoms as $guom)
                        <option value="{{ $guom->UomID }}">{{ $guom->UomName }}</option>
                        @endforeach
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
<script>
$(document).ready(function () {
        $("#other-sub_category").hide();

        $("#sub_category").change(function () {
            if ($(this).val() === "other") {
                $("#other-sub_category").show();
                $("#other-sub_category").attr("name", "other_sub_category");
                $("#other-sub_category").val("test");
            } else {
                $("#other-sub_category").hide();
                $("#other-sub_category").attr("name", "sub_category");
            }
        });
    });
</script>
@endsection