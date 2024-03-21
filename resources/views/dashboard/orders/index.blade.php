@extends('dashboard.master')
@section('title' , 'All Pending Orders')
@section('body')

    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">All Pending Orders</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                <li><a data-action="close"><i class="feather icon-x"></i></a></li>

                            </ul>

                        </div>
                    </div>
                    <!-- Zero configuration table -->
                    <section id="configuration">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="card">

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Table Name</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $key => $order)
                                                <tr>
                                                    <td>{{ $key +1 }}</td>
                                                    <td>{{ $order->table->name }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->status == 0 ?'pending' :'accepted' }}</td>
                                                    <td>{{ $order->created_at }}</td>


                                                    <td>
                                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary"><i
                                                                class="feather icon-eye "></i></a>

                                                    </td>

                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--/ Zero configuration table -->                </div>
            </div>
        </div>
    </section>

@endsection
