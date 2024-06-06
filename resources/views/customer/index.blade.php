@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

    @if (Session::has('success'))
        <div class="pt-3">
            <div class="noti alert alert-success w-100 d-flex justify-content-between">
                <div class="">
                    {{ Session::get('success') }}
                </div>
                <div class="mt-0 mr-0 ml-auto">
                    <button type="button" class="close rounded-3 " onclick="buangalert()">&times;</button>
                </div>
            </div>
        </div>
    @endif

    @if (Session::has('errors'))
        <div class="pt-3">
            <div class="noti alert alert-danger w-100 d-flex justify-content-between">
                <div class="">
                    {{ Session::get('errors') }}
                </div>
                <div class="mt-0 mr-0 ml-auto">
                    <button type="button" class="close rounded-3 " onclick="buangalert()">&times;</button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3 p-2">
            <div class="card p-2 mb-0">
                <div class="col row">
                    <p class="text-bold">Your Point : </p> <span class="UrPoint"> </span>
                </div>
            </div>
        </div>
    </div>

    <div class="orderCart pt-2"></div>

    <div class="row">
        <div class="col-lg-6 p-2">
            <div class="card p-2 ">
                <div class="col-lg-4 my-2 row">
                    <label for="">Category</label>
                    <select name="kategori" id="katRes" class="form-control-sm form-control">
                        <option value="western">Western</option>
                        <option value="asian">Asian</option>
                        <option value="dessert">Dessert</option>
                    </select>
                </div>
                <table class="table table-sm w-100" id="restaurantTable">
                    <thead>
                        <tr>
                            <th scope="col">Bil</th>
                            <th scope="col">restaurant</th>
                            {{-- <th scope="col"></th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card p-2">
                <div class="col-lg-4 row">
                    <label for="">Menu</label>
                </div>
                <table class="table table-sm w-100" id="menuTable">
                    <thead>
                        <tr>
                            <th scope="col">Bil</th>
                            <th scope="col">item</th>
                            <th scope="col">harga</th>
                            {{-- <th scope="col"></th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 p-2">
            <div class="card p-2 ">
                <div class="col-lg-4 row my-2">
                    <label for="">Checkout</label>
                </div>
                <form action="{{ route('make.order') }}" method="post">
                    @csrf
                    <input type="hidden" name="restaurant_id" id="checkoutRes">
                    <div class="formData">

                    </div>
                    <div class="">
                        <div class="">
                            <input type="radio" name="type" value="delivery" id="">  Delivery
                        </div>
                        <div class="">
                            <input type="radio" name="type" value="pickup" id="">  Pickup
                        </div>
                    </div>
                    <div class="w-100 row text-right">
                        <div class="col">
                            <input type="hidden" id="" name="total" class="totalprice">
                            <p class="">Total RM <span class="totalAll"></span></p>
                        </div>
                        <div class="col">
                            <button class="btn btn-sm btn-success">Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var allprice = 0;

        $(document).ready(function(){

            ajax_Vendor_Table('western')
            ajax_order_Table('all')
            ajax_point_Table()

        });

        $('#katRes').on('change',function(){

            var data =$(this).val();
            ajax_Vendor_Table(data);

            var clearArray = [];

            create_menu_Table(clearArray)

        });

        function ajax_Vendor_Table(data){

            $.ajax({
                url: "{{ route('get.vendor.available.data') }}",
                type: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'kategori' : data,

                },
                success: function(data) {

                    if(data.length > 0) $('#checkoutRes').val(data[0].id);


                    create_restaurant_Table(data);

                    
                }
            });
        }

        function ajax_point_Table(){

            $.ajax({
                url: "{{ route('get.point') }}",
                type: "get",
                success: function(data) {

                    $('.UrPoint').text(data)
                    
                }
            });
        }
        
        function create_restaurant_Table(data) {
            if ($.fn.dataTable.isDataTable('#restaurantTable')) {
                $('#restaurantTable').DataTable().destroy();
            }

            table = $('#restaurantTable').DataTable({
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
                        'data': 'name'
                    },
                    // {
                    //     'data': 'id', defaultContent: '', width: '100px',
                    //     'render': function(data, type, row) {

                    //         var DataApps = {
                    //             'id'                : data,
                    //             'kategori'          : row.kategori,
                    //             'nama'              : row.name,
                    //             'status'            : row.status,

                    //         }
                            
                    //         DataApps = encodeURIComponent(JSON.stringify(DataApps))

                        
                    //         return `<div class='row'>
                    //                         <div class='w-50'>
                    //                             <button class="btn bg-white" onclick="updateStatus('${DataApps}')"  data-toggle="modal"  data-target="#updateModal">
                    //                                 <i class="fa fa-bars"></i>
                    //                         </button>
                    //                         </div>
                    //                         <div class='w-50'>
                    //                             <button class="btn bg-white" onclick="deleteSenarai('${data}')" data-toggle="modal"  data-target="#deleteSenarai">
                    //                                 <i class="fa fa-trash-alt text-danger"></i>
                    //                             </button>
                    //                         </div>
                    //                     </div>`;
                    //     }
                    // },
                ],
            });

            table.on('click', 'tbody tr', function (e) {
                // e.currentTarget.classList.toggle('selected');
                ajax_menu_Table(table.row(this).data()['id'])

            });

            // $('#restaurantTable tbody').on('click', 'tr', function() {
            //     console.log('clicked: ' + table.row(this).data()['name'])
            //     ajax_menu_Table(table.row(this).data()['id'])
            // })
        }

        function ajax_menu_Table(data){

            $.ajax({
                url: "{{ route('get.vendor.menu.data') }}",
                type: "post",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'restaurant_id' : data,

                },
                success: function(data) {

                    // if(data == '') $('#menuTable').DataTable().destroy();

                    if(data !== '') create_menu_Table(data)

                    
                }
            });
        }

        function create_menu_Table(data) {

            if ($.fn.dataTable.isDataTable('#menuTable')) {
                $('#menuTable').DataTable().destroy();

            }else{
                tableMenu = $('#menuTable');

                tableMenu.on('click', 'tbody tr', function (e) {
                    // e.currentTarget.classList.toggle('selected');
                    templatecheckout(tableMenu.row(this).data())
                });
            }

            tableMenu = $('#menuTable').DataTable({
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
                        'data': 'name'
                    },
                    {
                        'data': 'price'
                    },
                    // {
                    //     'data': 'id', defaultContent: '', width: '100px',
                    //     'render': function(data, type, row) {

                    //         var DataApps = {
                    //             'id'                : data,
                    //             'kategori'          : row.kategori,
                    //             'nama'              : row.name,
                    //             'status'            : row.status,

                    //         }
                            
                    //         DataApps = encodeURIComponent(JSON.stringify(DataApps))

                        
                    //         return `<div class='row'>
                    //                         <div class='w-50'>
                    //                             <button class="btn bg-white" onclick="updateStatus('${DataApps}')"  data-toggle="modal"  data-target="#updateModal">
                    //                                 <i class="fa fa-bars"></i>
                    //                         </button>
                    //                         </div>
                    //                         <div class='w-50'>
                    //                             <button class="btn bg-white" onclick="deleteSenarai('${data}')" data-toggle="modal"  data-target="#deleteSenarai">
                    //                                 <i class="fa fa-trash-alt text-danger"></i>
                    //                             </button>
                    //                         </div>
                    //                     </div>`;
                    //     }
                    // },
                ],
            });

        }

        function templatecheckout(data){

            var template = `
                    <div class="row">
                        <div class="col-lg-9 pl-2">
                            <input type="hidden" id="" name="item[]" class="form-control-sm form-control" value="${data.id}" readonly>
                            <p class="">${data.name}</p>
                        </div>
                        <div class="col-lg-2">
                            <p class="">RM ${data.price}</p>
                        </div>
                        <div class="col-lg-1">
                            <p class="">x1</p>
                        </div>
                    </div>
            
            `;

            allprice = Number(allprice) + Number(data.price)

            
            $('.totalAll').text(allprice);

            $('.totalprice').val(allprice);

            $('.formData').append(template);

            
        }

        function ajax_order_Table(data){

            $.ajax({
                url: "{{ route('get.order.data') }}",
                type: "post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "status" : data
                },
                success: function(data) {

                    if(data !== '') 
                    {
                        data.forEach(element => {
                            var template = templateorderDetail(element)

                            $('.orderCart').append(template)
                        });

                    }
                    
                }
            });
        }

        function templateorderDetail(data){


            return `<div class="card p-2">
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
        }


    </script>
@endpush