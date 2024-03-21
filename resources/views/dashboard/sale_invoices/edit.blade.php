@extends('dashboard.master')

@section('title' , 'Edit Sale Invoice')

@section('body')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                    <li class="breadcrumb-item active">Edit Invoice</li>
                </ol>
            </div>
        </div>
        <h3 class="content-header-title mb-0">Edit Invoice</h3>
    </div>

    <div class="content-body">
        <!-- invoice add wrapper -->
        <div class="invoice-add-wrapper">
            <!-- defining a Bootstrap row -->
            <div class="row">
                <!-- defining Bootstrap columns for different screen sizes -->
                <div class="col-xl-12 col-md-12 col-12">
                    <!-- Bootstrap card component -->
                    <form action="submit-form.php" method="POST">
                        <div class="card">
                            <div class="card-body">
                                <!-- card header -->
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 col-12 order-md-1 order-2 d-flex justify-content-end align-items-center mb-2 mb-md-0">
                                            <img src="{{ url('website/assets/images/icon/alftooh/Logo footer.png') }}" alt="logo" height="46" width="164">
                                        </div>
                                        <div class="col-md-9 col-12 d-flex align-items-start align-items-md-start align-items-center flex-wrap pl-0">
                                            <div class="col-md-3 col-12 d-flex justify-content-start align-items-center mb-2 mb-md-0">
                                                <h6 class="invoice-text mr-1 font-weight-bold">Invoice Number </h6>
                                                <input type="text" name="invoice_number" class="form-control w-100" value="{{ $sale_invoices->invoice_number }}">
                                            </div>
                                            <div class="col-md-3 col-12 d-flex align-items-center justify-content-start mr-2 mb-2 mb-md-0">
                                                <h6 class="invoice-text mr-1 font-weight-bold">Date:</h6>
                                                <input type="date" name="date" class="pick-a-date bg-white form-control" value="{{ $sale_invoices->created_at }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <!-- logo and invoice title -->

                                <!-- bill address section -->
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12 col-xs-12 col-sm-12">
                                        <h5 class="form-section"><i class="feather icon-user"></i> Bill to</h5>
                                        <div class="d-f8lex flex-wrap">
                                            <div class="col-12 col-md-6 mb-2">
                                                <input type="text" class="form-control" name="client_name" value="{{ $sale_invoices->client_name }}" placeholder="Client Email">
                                            </div>
                                            <div class="col-12 col-md-6 mb-1">
                                                <textarea class="form-control" rows="1" name="client_address" placeholder="Client Address"> {{ $sale_invoices->client_address }}</textarea>
                                            </div>
                                            <div class="col-12 col-md-6 mb-1">
                                                <input type="number" class="form-control" name="client_phone" value="{{ $sale_invoices->client_phone }}" placeholder="Client Phone">
                                            </div>
                                            <div class="col-12 col-md-6 mb-2">
                                                <input type="email" class="form-control" name="client_email" value="{{ $sale_invoices->client_email }}" placeholder="Client Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div id="invoiceContainer">
                                    <!-- Existing invoice info form -->
                                    <div class="row invoice-info">
                                        <div class="col-lg-12 col-xl-12 col-xs-12 col-sm-12">
                                            <h5 class="form-section"><i class="feather icon-file-text"></i> Invoice details</h5>
                                            <div class="d-flex flex-wrap">
                                                <div class="col-12 col-md-4 mb-2">
                                                    <label>Item</label>
                                                    <input type="text" class="form-control" name="item" value="{{ $sale_invoices->item }}">
                                                </div>
                                                <div class="col-12 col-md-4 mb-1">
                                                    <label>Amount</label>
                                                    <input class="form-control" name="ammount" value="{{ $sale_invoices->ammount }}">
                                                </div>
                                                <div class="col-12 col-md-4 mb-1">
                                                    <label>Price</label>
                                                    <input type="number" class="form-control" name="price" value="{{ $sale_invoices->price }}">
                                                </div>

                                                <div class="col-12 col-md-4 mb-1">
                                                    <div class="col-12 col-md-4 mb-1 removeBtnContainer">
                                                        <!-- Add your content here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <button id="addInvoiceBtn" type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add new item</button>
                            </div>
                            <hr>

                            <div class="col-12 col-md-6 mb-1">
                                <h5 class="form-section"><i class="fa fa-pencil"></i> Note</h5>
                                <textarea class="form-control" rows="3" name="note" placeholder="Note">{{$sale_invoices->note}}</textarea>
                            </div>

                            <div class="form-actions container d-flex justify-content-end mt-2 mb-2">
                                <button type="submit" class="btn btn-primary" style="margin-right: 25px;">
                                    <i class="feather icon-check-square"></i> Submit invoice
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
