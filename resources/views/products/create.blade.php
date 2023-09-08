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
            <div class="card-header">{{ __('Add Product') }} <a href="{{ url('/products') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="fa-brands fa-product-hunt"> </i>Product List</a></div>
            <div class="card-body">
              <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf      
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 form-group">
                      <label for="exampleInputEmail1">Is Secondary Label Needed</label>
                      <select name="secondary" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for=""> Application Id</label>
                      <select class="form-control" name="applicationid" id="applicationid">
                        @if ($applications)
                        <option value="">Choose Application</option>
                        @foreach ($applications as $application)
                        <option value="{{ $application->id }}">{{ $application->ApplicationName }}</option>
                        @endforeach
                        @endif
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
                        @if ($categories)
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->ItemCategoryID }}">{{ $category->ItemCategoryName }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="sub_category">Choose Subcategory</label>
                      <select name="sub_category" id="sub_category" class="form-control">
                        @if ($subcategories)
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->SubCategoryName }}">{{ $subcategory->SubCategoryName }}</option>
                        @endforeach
                        @endif
                      </select>
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
  // $(document).ready(function() {
  //     $('#applicationid').change(function() {
  //       console.log("hi");
  //         var id = $(this).val();
  //         $.ajax({
  //             url: '/get-product-category',
  //             type: "GET",
  //             data: {
  //                 id: id,
  //             },
  //             success: function(data, textStatus, jqXHR) {
  //                 if (data.status = true) {
  //                     console.log(data);
  //                     const select = document.getElementById("category");
  //                     data.forEach(item => {
  //                       if (item.id && item.ItemCategoryName) { // Check if the item has 'id' and 'ItemCategoryName' properties
  //                         const option = document.createElement("option");
  //                         option.value = item.id;
  //                         option.textContent = item.ItemCategoryName;
  //                         select.appendChild(option);
  //                       }
  //                     });
  //                 } else {

  //                 }
  //             },
  //             error: function(jqXHR, textStatus, errorThrown) {

  //             }
  //         });
  //     })

  //     $('#applicationid').change(function() {
  //       console.log("hi");
  //         var id = $(this).val();
  //         $.ajax({
  //             url: '/get-product-subcategory',
  //             type: "GET",
  //             data: {
  //                 id: id,
  //             },
  //             success: function(data, textStatus, jqXHR) {
  //                 if (data.status = true) {
  //                     console.log(data[0]);
  //                     // $('#manufacturer_name').val(data[0]['manufacturer_name']);
  //                     // $('#supplier_name').val(data[0]['supplier_name']);
  //                     // $('#category_name').val(data[0]['category_name']);
  //                     // $('#sub_category_name').val(data[0]['sub_category_name']);
  //                     // $('#brand_name').val(data[0]['brand_name']);
  //                     // $('#weight').val(data[0]['weight']);
  //                     // $('#uom_id').val(data[0]['uom_id']);
  //                 } else {

  //                 }
  //             },
  //             error: function(jqXHR, textStatus, errorThrown) {

  //             }
  //         });
  //     })
  //   })
</script>
@endsection