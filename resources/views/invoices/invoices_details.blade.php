@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice Details</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
    <div class="col-xl-12">
        <!-- div -->
        <div class="card mg-b-20" id="tabs-style2">
            <div class="card-body">

                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab1" class="nav-link active" data-toggle="tab">Invoice</a></li>
                                        <li><a href="#tab2" class="nav-link" data-toggle="tab">Payment status</a></li>
                                        <li><a href="#tab3" class="nav-link" data-toggle="tab">Attachments</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">
                                        <div class="table-responsive mt-15">
                                            <table class="table table-striped" style="text-align: center">

                                                <tbody>
                                                    <tr>
                                                        <th scope="row">رقم الفاتورة</th>
                                                        <td>{{ $invoice->invoice_number }}</td>
                                                        <th scope="row">تاريخ الاصدار</th>
                                                        <td>{{ $invoice->invoice_date }}</td>
                                                        <th scope="row">تاريخ الدفع</th>
                                                        <td>{{ $invoice->due_date }}</td>
                                                        <th scope="row">القسم</th>
                                                        <td>{{ $invoice->section->section_name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">المنتج</th>
                                                        <td>{{ $invoice->product }}</td>
                                                        <th scope="row">مبلغ التحصيل</th>
                                                        <td>{{ $invoice->amount_collection }}</td>
                                                        <th scope="row">مبلغ العمولة</th>
                                                        <td>{{ $invoice->amount_commission }}</td>
                                                        <th scope="row">الخصم</th>
                                                        <td>{{ $invoice->discount }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">قيمة الضريبة</th>
                                                        <td>{{ $invoice->value_vat }}</td>
                                                        <th scope="row">نسبة الضريبة</th>
                                                        <td>{{ $invoice->rate_vate }}</td>
                                                        <th scope="row">الاجمالي شامل الضريبة</th>
                                                        <td>{{ $invoice->total }}</td>
                                                        <th scope="row">الحالة الحالية</th>
                                                        @if ($invoice->value_status == 1)
                                                            <td>
                                                                <span class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                                            </td>
                                                        @elseif($invoice->value_status == 2)
                                                            <td>
                                                                <span class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                                            </td>
                                                        @endif
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">ملاحظات</th>
                                                        <td>{{ $invoice->notes }}</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab2">
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table-hover" style="text-align: center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>رقم الفاتورة</th>
                                                        <th>نوع المنتج</th>
                                                        <th>القسم</th>
                                                        <th>حالة الدفع</th>
                                                        <th>تاريخ الدفع</th>
                                                        <th>ملاحظات</th>
                                                        <th>تاريخ الاضافة</th>
                                                        <th>المستخدم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0
                                                    @endphp

                                                    @foreach ($invoiceDetails as $invoiceDetail)

                                                    @php
                                                        $i++
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $invoiceDetail->invoice_number }}</td>
                                                        <td>{{ $invoiceDetail->product }}</td>
                                                        <td>{{ $invoice->section->section_name }}</td>

                                                        @if ($invoiceDetail->status_value == 1)
                                                            <td>
                                                                <span class="badge badge-pill badge-success">{{ $invoiceDetail->status }}</span>
                                                            </td>
                                                        @elseif($invoiceDetail->status_value == 2)
                                                            <td>
                                                                <span class="badge badge-pill badge-danger">{{ $invoiceDetail->status }}</span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge badge-pill badge-warning">{{ $invoiceDetail->status }}</span>
                                                            </td>
                                                        @endif

                                                        <td>{{ $invoice->payment_date }}</td>
                                                        <td>{{ $invoiceDetail->note }}</td>
                                                        <td>{{ $invoiceDetail->created_at }}</td>
                                                        <td>{{ $invoiceDetail->user }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab3">

                                        <div class="card card-statistics">
                                            <div class="card-body">
                                                <p class="text-danger">
                                                    Attachment Format jpg, jpeg, pdf, png
                                                </p>

                                                @can('Add Attachment')
                                                <h5 class="card-title">Add Attachment</h5>
                                                <form action="{{ route('InvoiceAttachment.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input type="file" name="file_name" id="custom_file"
                                                        class="custom-file-input" required>
                                                        <input type="hidden" name="invoice_number" id="custom_file" name="invoice_number"
                                                        value="{{ $invoice->invoice_number }}">
                                                        <input type="hidden" name="invoice_id" id="custom_file" name="invoice_id"
                                                        value="{{ $invoice->id }}">
                                                        <label class="custom-file-label" for="custom_file">Select attachment</label>
                                                    </div> <br> <br>
                                                    <button type="submit" class="btn btn-primary" name="uploadedFile">Add</button>
                                                </form>
                                                @endcan
                                            </div>

                                        </div>

                                        @if ($invoiceAttachments)
                                        <div class="table-responsive mt-15">


                                            <table class="table center-aligned-table mb-0 table-hover" style="text-align: center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>م</th>
                                                        <th>اسم الملف</th>
                                                        <th>قام بالاضافة</th>
                                                        <th>تاريخ الاضافة</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0
                                                    @endphp

                                                    @foreach ($invoiceAttachments as $invoiceAttachment)

                                                    @php
                                                        $i++
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $invoiceAttachment->file_name }}</td>
                                                        <td>{{ $invoiceAttachment->created_by }}</td>
                                                        <td>{{ $invoiceAttachment->created_at }}</td>
                                                        <td>

                                                            <a class="btn btn-outline-success btn-sm"
                                                            href="{{ url('view_file') }}/{{ $invoice->invoice_number }}/{{ $invoiceAttachment->file_name }}"
                                                            role="button">Show &nbsp;<i class="fas fa-eye"></i></a>

                                                            <a class="btn btn-outline-danger btn-sm"
                                                            href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $invoiceAttachment->file_name }}"
                                                            role="button">Download &nbsp;<i class="fas fa-download"></i></a>

                                                        </td>
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
                    </div>
                </div>
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
@endsection
