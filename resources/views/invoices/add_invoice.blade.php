@extends('layouts.master')
@section('title')
    Invoices List
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoices List</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection

@section('content')

<div class="row">

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    {{-- 1 --}}

                    <div class="row">
                        <div class="col-md-4">
                            <label for="input_name" class="control-label">Invoice Number</label>
                            <input type="text" class="form-control" id="input_name" name="invoice_number"
                                title="Please write invoice num" required>
                        </div>

                        <div class="col-md-4">
                            <label>Invoice Date</label>
                            <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label>Due Date</label>
                            <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                type="text" required>
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Section</label>
                            <select name="section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <!--placeholder-->
                                <option value="" selected disabled>Choose Section</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Product</label>
                            <select id="product" name="product" class="form-control">
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Collection Amount</label>
                            <input type="text" class="form-control" id="inputName" name="amount_collection"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Comission Amount</label>
                            <input type="text" class="form-control form-control-lg" id="commission_amount"
                                name="commission_amount" title="يرجي ادخال مبلغ العمولة "
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Discount</label>
                            <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                title="يرجي ادخال مبلغ الخصم "
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value=0 required>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">VAT Rate</label>
                            <select name="rate_vate" id="rate_vate" class="form-control" onchange="myFunction()">
                                <!--placeholder-->
                                <option value="" selected disabled>Select VAT Rate</option>
                                <option value=" 5%">5%</option>
                                <option value="10%">10%</option>
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputName" class="control-label">VAT Value</label>
                            <input type="text" class="form-control" id="value_vat" name="value_vat" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="inputName" class="control-label">Total</label>
                            <input type="text" class="form-control" id="total" name="total" readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Notes</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                        </div>
                    </div><br>

                    <p class="text-danger">* Attachment Format pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">Attachments</h5>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

</div>

<!-- row closed -->
</div>
@endsection

@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function () {
        $('select[name=section]').on('change', function() {
            var sectionId = $(this).val();
            if (sectionId)
            {
                $.ajax({

                    url: "{{ URL::to('section') }}/" + sectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data)
                    {

                        $('select[name=product]').empty();

                        $.each(data, function (key, value) {
                            $('select[name=product]').append('<option value="' + value + '">' + value + '</option');
                        });

                    },

                });
            }
            else
            {
                console.log("AJAX load did not work");
            }

        });
    });
</script>

<script>
    function myFunction()
    {
        var commissionAmount = parseFloat(document.getElementById("commission_amount").value);
        var discount = parseFloat(document.getElementById("discount").value);
        var rateVat = parseFloat(document.getElementById("rate_vate").value);

        var commissionAfterDiscount = commissionAmount - discount;

        if (typeof commissionAmount === 'undefined' || !commissionAmount)
        {
            alert("Please insert Commission Amount");
        }
        else
        {
            var intResult = commissionAfterDiscount * rateVat / 100;

            var intResult2 = parseFloat(intResult + commissionAfterDiscount);

            sumq = parseFloat(intResult).toFixed(2);

            sumt = parseFloat(intResult2).toFixed(2);

            document.getElementById("value_vat").value = sumq;

            document.getElementById("total").value = sumt;

        }

    }
</script>

@endsection
