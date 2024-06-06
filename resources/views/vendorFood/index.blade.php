@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

<div class="row">
    <div class="col-lg-6 p-2">
        <div class="card p-2 ">
            <div class="col-lg-4 row my-2">
                <p class="text-bold">Overall Sales : </p> <span class="overallSale"> </span>

            </div>
        </div>
    </div>
    <div class="col-lg-6 p-2">
        <div class="card p-2 ">
            <div class="col-lg-4 row my-2">
                <p class="text-bold">Today Sales : </p> <span class="todaySale"> </span>

            </div>
        </div>
    </div>
</div>
{{-- <div class=""> --}}
    <div class="col p-2">
        <div class="card p-2 ">
            <label for="">Detail Order</label>
            <div class="row my-2 orderDetail">
            </div>
        </div>
    </div>
    <div class="col p-2">
        <div class="card p-2 ">
            <div class="col-lg-4 my-2 row">
                <label for="">Order</label>
                <select name="kategori" id="katOrder" class="form-control-sm form-control">
                    <option value="all">Sila Pilih</option>
                    <option value="ordered">Ordered</option>
                    <option value="preparing">Preparing</option>
                    <option value="cancel">Cancel</option>
                    <option value="complete">Complete</option>
                </select>
            </div>
            <table class="table table-sm w-100" id="orderTable">
                <thead>
                    <tr>
                        <th scope="col">Bil</th>
                        <th scope="col">user</th>
                        <th scope="col">Status</th>
                        <th scope="col">Type</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

{{-- </div> --}}

@endsection

@push('js')
    <script>
        var allprice = 0;

        $(document).ready(function(){

            ajax_getOrder_Table('all')
            ajax_overallS()
            ajax_todayS()

        });

        $('#katOrder').on('change',function(){

            var data =$(this).val();
            ajax_getOrder_Table(data);

        });

        function ajax_getOrder_Table(data){

                $.ajax({
                    url: "{{ route('get.order.data') }}",
                    type: "POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        "status" : data
                    },
                    success: function(data) {

                        if(data !== '') 
                        {
                            $('#checkoutRes').val(data[0].id);
                            create_order_Table(data);

                        }
                        
                    }
                });
        }

        function create_order_Table(data) {
            if ($.fn.dataTable.isDataTable('#orderTable')) {
                $('#orderTable').DataTable().destroy();
            }

            table = $('#orderTable').DataTable({
                dom: 'rti',
                ordering: false,
                data: data,
                select: true,
                // paging: false,
                pageLength : 10,
                info : false,
                columns: [

                    {
                        "data": "id", width: '100px',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        'data': 'customer.name'
                    },
                    {
                        'data': 'status'
                    },
                    {
                        'data': 'type'
                    },
                    {
                        'data': 'id', defaultContent: '', width: '300px',
                        'render': function(data, type, row) {

                            var DataApps = {
                                'restaurant'      : row.owner,
                                'total_price'     : row.total_price,
                                'status'          : row.status,
                                'type'            : row.type,
                                'detail'          : row.detail

                            }

                            DataApps = encodeURIComponent(JSON.stringify(DataApps))

                        
                            return `<div class='row'>
                                            <div class='col-lg-3'>
                                                <form action="{{ route('change.status.order') }}" method='POST'>
                                                    @csrf
                                                    <input type="hidden" name="id" id="" value="${data}"/>
                                                    <input type="hidden" name="status" id="" value="preparing"/>
                                                    <button class="btn btn-sm btn-primary" type="submit">
                                                        preparing
                                                    </button>
                                                </form>
                                            </div>
                                            <div class='col-lg-3'>
                                                <form action="{{ route('change.status.order') }}" method='POST'>
                                                    @csrf
                                                    <input type="hidden" name="id" id="" value="${data}"/>
                                                    <input type="hidden" name="status" id="" value="complete"/>
                                                    <button class="btn btn-sm btn-success" type="submit">
                                                        complete
                                                    </button>
                                                </form>
                                            </div>
                                            <div class='col-lg-3'>
                                                <form action="{{ route('change.status.order') }}" method='POST'>
                                                    @csrf
                                                    <input type="hidden" name="id" id="" value="${data}"/>
                                                    <input type="hidden" name="status" id="" value="cancel"/>
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        cancel
                                                    </button>
                                                </form>
                                            </div>
                                            <div class='col-lg-3'>
                                                <button class="btn btn-sm btn-dark" onclick="templateorderDetail('${DataApps}')" type="button">
                                                    detail
                                                </button>
                                            </div>
                                        </div>`;
                        }
                    },
               
                ],
            });

            // table.on('click', 'tbody tr', function (e) {
            //     // e.currentTarget.classList.toggle('selected');
            //     ajax_menu_Table(table.row(this).data()['id'])

            // });

            // $('#restaurantTable tbody').on('click', 'tr', function() {
            //     console.log('clicked: ' + table.row(this).data()['name'])
            //     ajax_menu_Table(table.row(this).data()['id'])
            // })
        }

        function templateorderDetail(data){

            data = JSON.parse(decodeURIComponent(data));

            $('.orderDetail').empty()

            var template = `<div class="p-2">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <p class="">${data.restaurant.name}</p>
                                    </div>
                                    <div class="col">
                                        <p class="">${data.detail}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="">RM ${data.total_price}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="">${data.type}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="">${data.status}</p>
                                    </div>
                                </div>
                            </div>`;

            $('.orderDetail').append(template)

        }

        function ajax_overallS(){

            $.ajax({
                url: "{{ route('get.overallS') }}",
                type: "get",
                success: function(data) {

                    $('.overallSale').text(data)
                    
                }
            });
        }

        function ajax_todayS(){

            $.ajax({
                url: "{{ route('get.todayS') }}",
                type: "get",
                success: function(data) {

                    $('.todaySale').text(data)
                    
                }
            });
        }


    </script>
@endpush