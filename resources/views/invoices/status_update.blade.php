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



    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ URL::route('update_status', $invoice->id) }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    @method('PATCH')
                    @csrf
                    {{-- 1 --}}

                    <div class="row">

                        <div class="col-md-4">
                            <label for="input_name" class="control-label">Invoice Number</label>
                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                            <input type="text" class="form-control" value="{{ $invoice->invoice_number }}" id="input_name" name="invoice_number"
                                readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Invoice Date</label>
                            <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ $invoice->invoice_date }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Due Date</label>
                            <input class="form-control fc-datepicker" value="{{ $invoice->due_date }}" name="due_date"
                                type="text" readonly>
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Section</label>
                            <select name="section" class="form-control SlectBox" readonly>
                                <!--placeholder-->
                                <option value="{{ $invoice->section_id }}">{{ $invoice->section->section_name }}</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Product</label>
                            <select id="product" name="product" class="form-control" readonly>
                                <option value="{{ $invoice->product }}">{{ $invoice->product }}</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Collection Amount</label>
                            <input readonly type="text" class="form-control" id="inputName" name="amount_collection"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value="{{ $invoice->amount_collection }}">
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Comission Amount</label>
                            <input type="text" class="form-control form-control-lg" id="commission_amount"
                                name="commission_amount" title="يرجي ادخال مبلغ العمولة "
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                readonly
                                value="{{ $invoice->amount_commission }}">
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">Discount</label>
                            <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                title="يرجي ادخال مبلغ الخصم "
                                readonly
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value="{{ $invoice->discount }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="inputName" class="control-label">VAT Rate</label>
                            <select readonly name="rate_vate" id="rate_vate" class="form-control">
                                <!--placeholder-->
                                <option value="{{ $invoice->rate_vate }}" readonly>{{ $invoice->rate_vate }}</option>
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputName" class="control-label">VAT Value</label>
                            <input type="text" value="{{ $invoice->value_vat }}" class="form-control" id="value_vat" name="value_vat" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="inputName" class="control-label">Total</label>
                            <input value="{{ $invoice->total }}" type="text" class="form-control" id="total" name="total" readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Notes</label>
                            <textarea value="{{ $invoice->notes }}" class="form-control" id="exampleTextarea" name="note" rows="3" readonly></textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Payment Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option selected="true" disabled="disabled">-- Choose Payment Status --</option>
                                <option value="paid">Paid</option>
                                <option value="partially paid">Partially Paid</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>Payment Date</label>
                            <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD"
                                type="text" required>
                        </div>


                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Update Payment Status</button>
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



@endsection
