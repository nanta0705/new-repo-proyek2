@extends('admin.dashboard')
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard 01</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li>
        </ol>
    </div>
    <div class="ms-auto pageheader-btn">
        <a href="{{ url('/') }}" class="btn btn-success btn-icon text-white">
            <span>
                <i class="fe fe-book"></i>
            </span> Booking Now!
        </a>
    </div>
</div>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Booking</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>Kode Booking</strong></th>
                                <th>Name Event</th>
                                <th>Makeup</th>
                                <th>Type Makeup</th>
                                <th>Tanggal Booking</th>
                                <th>Waktu Booking</th>
                                <th><strong>status</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking as $data)
                                <tr>
                                    <td><strong>{{ $data->id_booking }}</strong></td>
                                    <td>{{ $data->name }}</td>
                                    <td class="text-center">{{ $data->getMakeup->name }}</td>
                                    <td class="text-center">{{ $data->getTypeMakeup->name }}</td>
                                    <td class="text-center">{{ date('d F Y', strtotime($data->tanggal_booking)) }}</td>
                                    <td class="text-center">{{ $data->waktu_booking }}</td>
                                    <td>
                                        @if ($data->status == 0)
                                            <span class="badge rounded-pill bg-warning me-1 mb-1 mt-1">Pending</span>
                                        @elseif ($data->status == 1)
                                            <span class="badge rounded-pill bg-primary me-1 mb-1 mt-1">Diterima</span>
                                        @elseif ($data->status == 3)
                                            <span class="badge rounded-pill bg-danger me-1 mb-1 mt-1">Ditolak</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal"
                                            data-bs-target="#modalView{{ $data->id_booking }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button id="deletePasien" data-kode="{{ $data->id_customer }}"
                                            class="btn btn-danger ">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
@foreach ($booking as $view)
    <div class="modal fade" id="modalView{{ $view->id_booking }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal View Start -->
                <div class="modal-header">
                    <h5 class="modal-title" th:text="${company.id != null} ? 'View Company' : 'View Company'"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Event</th>
                                    <td> {{ $view->name }}</td>
                                </tr>
                                <tr>
                                    <th>Makeup</th>
                                    <td >{{ $view->getMakeup->name }}</td>
                                    <td >{{ $view->getTypemakeup->name }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal/Jam Booking</th>
                                    <td >{{ date('d F Y', strtotime($view->tanggal_booking)) }}</td>
                                    <td >{{ $view->waktu_booking }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>Rp.{{ $view->getMakeup->price }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- Modal View End -->
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('js')
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
<script>
    $(document).ready(function () {
        // Menangani klik tombol delete
        $('.deleteBooking').on('click', function () {
            var id = $(this).data('id');

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke route delete dengan parameter ID
                    window.location.href = "{{ url('/client/booking/') }}/" + id + "/delete";
                }
            });
        });
    });
</script>
@endsection
