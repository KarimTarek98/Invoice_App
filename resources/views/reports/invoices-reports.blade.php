@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
    Invoices Reports
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Reports</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoices
                Reports</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">

                <form action="{{ url('/reports/search_invoices') }}">
                    @csrf
                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input type="radio" name="radio" id="search_type" checked value="1">
                            <span>Search By Invoice type</span>
                        </label>
                    </div>

                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input type="radio" name="radio" value="2" id="search_number">
                            <span>Search By Invoice number</span>
                        </label>
                    </div>


                    <div class="row">
                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">Specify Invoices type</p>
                            <select name="type" class="form-control select2" required>
                                <option value="{{ $type ?? 'Specify Invoices type' }}" selected>
                                    {{ $type ?? 'Specify Invoices type' }}
                                </option>
                                <option value="paid">Paid</option>
                                <option value="not paid">Unpaid</option>
                                <option value="partially paid">Partially Paid</option>
                            </select>
                        </div>

                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                            <p class="mg-b-10">Search by invoice number</p>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number">

                        </div>

                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1">From the date of :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}" name="start_at"
                                    placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">Until date :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                            </div>
                            <input class="form-control fc-datepicker" name="end_at"
                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                            </div>
                        </div><br>



                </div>

                <div class="row">
                    <div class="col-sm-1 col-md-1">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                @if (isset($details))

                <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Invoice Number</th>
                            <th class="border-bottom-0">Invoice Date</th>
                            <th class="border-bottom-0">Due Date</th>
                            <th class="border-bottom-0">Product</th>
                            <th class="border-bottom-0">Section</th>
                            <th class="border-bottom-0">Discount</th>
                            <th class="border-bottom-0">Rate Vat</th>
                            <th class="border-bottom-0">Value Vat</th>
                            <th class="border-bottom-0">Total</th>
                            <th class="border-bottom-0">Status</th>
                            <th class="border-bottom-0">Notes</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($details as $invoice)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $invoice->invoice_number }} </td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ $invoice->product }}</td>
                                <td><a
                                        href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->section->section_name }}</a>
                                </td>
                                <td>{{ $invoice->discount }}</td>
                                <td>{{ $invoice->rate_vate }}</td>
                                <td>{{ $invoice->value_vat }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>
                                    @if ($invoice->value_status == 1)
                                        <span class="text-success">{{ $invoice->status }}</span>
                                    @elseif($invoice->value_status == 2)
                                        <span class="text-danger">{{ $invoice->status }}</span>
                                    @else
                                        <span class="text-warning">{{ $invoice->status }}</span>
                                    @endif

                                </td>

                                <td>{{ $invoice->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@section('js')

<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(function () {
        $('#invoice_number').hide();

        $('input[type="radio"]').click(function () {

            if ($(this).attr('id') == 'search_type')
            {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            }
            else
            {
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
                $('#invoice_number').show();
            }

        });
    });
</script>

@endsection
