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
          <div class="card-header">{{ __('Add primary') }} <a href="{{ url('/primaries') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="fa-brands fa-primaries-hunt"></i>Primary List</a></div>
          <div class="card-body">
            <form method="POST" action="{{ route('primaries.store') }}" enctype="multipart/form-data">
              @csrf      
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4 form-group">
                    <label for="exampleInputEmail1">Choose Product</label>
                    <select name="product_id" id="productid" class="form-control">
                        <option value="">Choose Product</option>
                        @foreach ($products as $product)
                          <option value="{{ $product->ProductCode }}">{{ $product->ProductName }}({{ date('d-M-Y h:i:s a', strtotime($product->created_at)) }})</option>
                        }
                        }
                        @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">Manufacturer Name</label>
                    <input type="text" class="form-control" id="manufacturer_name" placeholder="Enter Manufacturer Name" name="manufacturer_name" readonly>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">Supplier Name</label>
                    <input type="text" class="form-control" id="supplier_name" placeholder="Enter Supplier Name" name="supplier_name" readonly>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" id="category_id" placeholder="Enter Category Name" name="category_id" readonly>
                  </div>
                    <input type="hidden" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name" readonly>
                  <div class="col-lg-4 form-group">
                    <label for="exampleInputEmail1">Choose Subcategory</label>
                    <input type="text" class="form-control" id="sub_category_id" placeholder="Enter Category Name" name="sub_category_id" readonly>
                  </div>
                    <input type="hidden" class="form-control" id="sub_category_name" placeholder="Enter Category Name" name="sub_category_name" readonly>
                  <div class="col-lg-4 form-group">
                    <label for="">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" placeholder="Enter Brand Name" name="brand_name" readonly>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">Weight</label>
                    <input type="text" class="form-control" id="weight" placeholder="Enter Weight" name="weight" readonly>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="exampleInputEmail1"> Unit Of Measurement</label>
                    <input type="text" class="form-control" id="uom_name" placeholder="Unit Of Measurement" name="uom_name" readonly>
                  </div>
                  <div class="col-lg-4 form-group">
                    <input type="hidden" class="form-control" id="uom_id" placeholder="Unit Of Measurement" name="uom_id">
                  </div>
               </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4 form-group">
                    <label for="exampleInputEmail1">Choose Type of Label</label>
                    <select name="type" class="form-control">
                      <option>Choose Type of Label:</option>
                      @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->display_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">Batch No </label>
                    <input type="text" class="form-control" id=""placeholder="Enter Batch No" name="batch_no">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">MFG Date </label>
                    <input type="date" class="form-control" id="mfg_date" name="mfg_date" onchange="checkDate(this)">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="">Exp. Date </label>
                    <input type="date" class="form-control" id="exp_date" name="exp_date" onchange="checkDate(this)">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for=""> No. of Labels </label>
                    <input type="text" class="form-control" id="" placeholder="Enter Quantity" name="quantity">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for=""> MRP Price </label>
                    <input type="text" class="form-control" id="" placeholder="Enter MRP Price" name="mrp">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label>Choose Print or Save</label>
                    <select class="form-control" name="work">
                      <option>Select Print Or Save</option>
                      <option value="1">Save</option>
                    </select>
                  </div>
                </div>                                  
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
<script>
  function checkDate() {
    var mfg_date = new Date($('#mfg_date').val());
    var exp_date = new Date($('#exp_date').val());
    if (mfg_date > exp_date) {
      Swal.fire({
        icon: "error",
        title: "Expiry Date Error",
        text: "Manufacturing Date Can not Be Greater Than Expiry Date",
        showConfirmButton: true,
        dangerMode: true,
        timer: 10000
      });
      $("#exp_date").val(new Date());
    }
  }
  $(document).ready(function() {
    $('#productid').change(function() {
      var id = $(this).val();
      $.ajax({
        url: '/get-related-data',
        type: "GET",
        data: {
          id: id,
        },
        success: function(data, textStatus, jqXHR) {
          if (data.status = true) {
            console.log(data[0]);
            $('#manufacturer_name').val(data[0]['ManufacturerName']);
            $('#supplier_name').val(data[0]['SupplierName']);
            $('#category_name').val(data[0]['ItemCategoryID']);
            $('#category_id').val(data[0]['category']['ItemCategoryName']);
            $('#sub_category_name').val(data[0]['SubCategoryID']);
            $('#sub_category_id').val(data[0]['sub_category']['SubCategoryName']);
            $('#brand_name').val(data[0]['BrandName']);
            $('#weight').val(data[0]['Weight']);
            $('#uom_name').val(data[0]['unit_of_measurement']['UomName']);
            $('#uom_id').val(data[0]['UomID']);
          } else {

          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
    })
  })




  
            // --- Fz for product api --- //
</script>
@endsection