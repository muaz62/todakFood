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


    <div class="modal fade" id="updateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status Restaurant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="" action="{{ route('update.vendor') }}" method='post'>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="idRes" />
                        <label for="">Name</label>
                        <input type="text" name="name" id="nameRes" class="form-control-sm form-control"/>

                        <label for="">Category</label>
                        <select name="kategori" id="katRes" class="form-control-sm form-control">
                            <option value="western">Western</option>
                            <option value="asian">Asian</option>
                            <option value="dessert">Dessert</option>
                        </select>

                        <label for="">Status</label>
                        <select name="status" id="StausRes" class="form-control-sm form-control">
                            <option value="new">New</option>
                            <option value="available">Available</option>
                            <option value="banned">Banned</option>

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-success" type="submit">
                            Done
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="detailTempahan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tempahan {{ Config::get('tempahanbilik.shortName') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="container p-2">
                    <div class="row px-3">
                        <div class="col-lg-8">
                            <h3 class="mb-0 namaBilikDetailBilik"></h3>
                            <span class="badge badge-dark namaBagunanDetailBilik"></span>
                        </div>
                        <div class="col-lg-4 text-right">
                            <span class="badge statusDetailBilik"></span><br>
                            <span class="waktuDetailBilik">9:30 AM - 10:30 AM </span>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="container row px-4 py-2">
                        <div class="col-lg-6">
                            <p class="mb-0 font-weight-bold">Tujuan</p>
                        </div>
                        <div class="col-lg-6">
                            : <span class="mb-0 tujuanDetailBilik"></span> 
                        </div>
                    </div>
                    <div class="container row px-4 py-2">
                        <div class="col-lg-6">
                            <p class="mb-0 font-weight-bold">Pemohon </p>
                        </div>
                        <div class="col-lg-6">
                            : <span class="mb-0 namaDetailBilik"></span>   
                        </div>
                    </div>
                    <div class="container row px-4 py-2">
                        <div class="col-lg-6">
                            <p class="mb-0 font-weight-bold">Pegerusi </p>
                        </div>
                        <div class="col-lg-6">
                            : <span class="mb-0 pengerusiDetailBilik"></span>   
                        </div>
                    </div>
                    <div class="container row px-4 py-2">
                        <div class="col-lg-6">
                            <p class="mb-0 font-weight-bold">No Tel </p>
                        </div>
                        <div class="col-lg-6">
                            : <span class="mb-0 notelDetailBilik"></span>   
                        </div>
                    </div>
                    <div class="container row px-4 py-2">
                        <div class="col-lg-6">
                            <p class="mb-0 font-weight-bold">Catatan </p>
                        </div>
                        <div class="col-lg-6">
                            : <span class="mb-0 catatanDetailBilik"></span>   
                        </div>
                    </div>
                    <div class="text-right border-top px-4 py-2">
                        <span class="text-lg tarikhDetailBilik"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteSenarai">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title deleteHeader" id="exampleModalLabel">Padam</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="deleteFormAdmin" action="{{ route('deleteTempahan') }}" class="w-100" method="post">
                    @csrf
                    <input type="hidden" name="id" id="idSenaraiDelete">
                    <div class="mt-2">
                        <p class="deleteAyatSenarai">Adakah anda pasti untuk memadam Permohonan ini?</p>
                        <p class=""><b class="namaItemSenarai"></b></p>
                    </div>
                    <div class="text-right">
                        <x-adminlte-button label="Ya" type="submit" class="btn-sm " theme="success" />
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div> --}}

    <div class="pt-2">
        <div class="card p-2">
            {{-- <div class="text-right py-2">
                <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#createModal" aria-expanded="false" aria-controls="createModal">
                    <i class="fas fa-plus"></i> restaurant
                </button>
            </div> --}}
            <table class="table table-sm w-100" id="restaurantTable">
                <thead>
                    <tr>
                        <th scope="col">Bil</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){

            ajax_Vendor_Table();

        });

        function ajax_Vendor_Table(){

            $.ajax({
                url: "{{ route('get.vendor.all.data') }}",
                type: "get",
                success: function(data) {

                    create_restaurant_Table(data)
                    
                }
            });
        }

        function create_restaurant_Table(data) {
            if ($.fn.dataTable.isDataTable('#restaurantTable')) {
                $('#restaurantTable').DataTable().destroy();
            }

            table = $('#restaurantTable').DataTable({
                dom: 'frtip',
                ordering: true,
                data: data,
                select: true,
                // paging: false,
                pageLength : 10,
                info : false,
                columns: [

                    {
                        "data": "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        'data': 'name'
                    },
                    {
                        'data': 'kategori'
                    },
                    {
                        'data': 'status'
                    },
                    {
                        'data': 'id', defaultContent: '',
                        'render': function(data, type, row) {

                            var DataApps = {
                                'id'                : data,
                                'kategori'          : row.kategori,
                                'nama'              : row.name,
                                'status'            : row.status,

                            }
                            
                            DataApps = encodeURIComponent(JSON.stringify(DataApps))

                        
                            return `<div class='row'>
                                            <div class='w-50'>
                                                <button class="btn bg-white" onclick="updateStatus('${DataApps}')"  data-toggle="modal"  data-target="#updateModal">
                                                    <i class="fa fa-bars"></i>
                                               </button>
                                             </div>
                                             <div class='w-50'>
                                                <button class="btn bg-white" onclick="deleteSenarai('${data}')" data-toggle="modal"  data-target="#deleteSenarai">
                                                    <i class="fa fa-trash-alt text-danger"></i>
                                                </button>
                                            </div>
                                        </div>`;
                        }
                    },
                ],
            });

        }

        function updateStatus(data){
            
            let decodedata = JSON.parse(decodeURIComponent(data))

            $('#idRes').val(decodedata.id);
            $('#nameRes').val(decodedata.nama);
            $('#katRes').val(decodedata.kategori);
            $('#StausRes').val(decodedata.status);

    
        }

    </script>
@endpush
