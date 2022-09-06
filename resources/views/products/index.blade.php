@extends('layouts.master')
@section('title')
    Products
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Products</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Delete') }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    {{-- <div class="col-sm-6 col-md-3 mg-t-10">
                                    <button class="btn btn-info btn-block">Add Product</button>
                                </div> --}}

                    <!-- Button trigger modal -->
                    @can('Add Product')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Product
                    </button>
                    @endcan

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('products.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" class="form-control" name="product_name"
                                                id="product_name">
                                        </div>

                                        {{-- <div class="form-group">
                                                    <label for="section_name">Section</label>
                                                <select name="section_name" id="section_name" class="form-control" required>
                                                    <option value="" selected disabled>-- Choose Section --</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->section_name }}">{{ $section->section_name }}</option>
                                                    @endforeach
                                                </select>
                                                </div> --}}
                                        <div class="form-group">
                                            <label for="section_name">Section</label>
                                            <select name="section_id" id="section_name" class="form-select"
                                                aria-label="Default select example" required>
                                                <option selected disabled value="">-- Choose Section --</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->section_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Product Name</th>
                                    <th class="wd-20p border-bottom-0">Section Name</th>
                                    <th class="wd-15p border-bottom-0">Notes</th>
                                    <th class="wd-10p border-bottom-0">Processes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $product)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->section->section_name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            @can('Edit Product')
                                            <a class="modal-effect btn btn-sm btn-info"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->product_name }}"
                                                data-section_name="{{ $product->section->section_name }}"
                                                data-description="{{ $product->description }}"
                                                href="#exampleModal1" data-target="#exampleModal1" data-bs-toggle="modal" data-bs-target="#exampleModal1" title="Edit"><i class="las la-pen"></i></a>
                                            @endcan
                                                @can('Delete Product')
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->product_name }}" data-toggle="modal"
                                                href="#modaldemo9" title="Delete"><i class="las la-trash"></i></a>
                                                @endcan
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->

                {{-- Edit --}}
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    @can('Edit Product')
                                    <h5 class="modal-title" id="exampleModal1Label">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    @endcan
                                </div>

                                <form action="{{ url('products/update') }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="product_id" id="id" value="">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" class="form-control" name="product_name"
                                                id="product_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="section_name">Section</label>
                                            <select name="section_name" id="section_name" class="form-select" required>
                                                @foreach ($sections as $section)
                                                    <option>{{ $section->section_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                {{-- End Edit --}}


                {{-- Delete --}}
                <div class="modal" id="modaldemo9">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Delete Product</h6><button aria-label="Close" class="close"
                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="products/destroy" method="post">
                                @method('DELETE')
                                @csrf
                                <div class="modal-body">
                                    <p>? Are You Sure </p><br>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            {{-- End Delete --}}

            </div><!-- bd -->
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $('#exampleModal1').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var productName = button.data('product_name')
            var sectionName = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)

            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #product_name').val(productName)
            modal.find('.modal-body #section_name').val(sectionName)
            modal.find('.modal-body #description').val(description)

        });

        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var productName = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #product_name').val(productName)
        });
    </script>
@endsection
