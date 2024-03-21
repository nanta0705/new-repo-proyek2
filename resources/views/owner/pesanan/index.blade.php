@extends('admin.dashboard')
@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Data Pesanan</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pesanan</li>
            </ol>
        </div>
        <div class="ms-auto pageheader-btn">
            <a class="btn btn-primary" data-bs-target="#modaldemo1" data-bs-toggle="modal" href=""><i
                    class="fa fa-plus"></i>Tambah Data</a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pesanan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>Kode Booking</strong></th>
                                    <th>Name Event</th>
                                    <th>Makeup</th>
                                    <th>Type Makeup</th>
                                    <th>Tanggal Booking</th>
                                    <th>Waktu Booking</th>
                                    <th><strong>status</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $pesanan)
                                    <tr>
                                        {{-- <td>{{$loop->iteration}}</td> --}}
                                        <td><strong>{{ $pesanan->id_booking }}</strong></td>
                                        <td>{{ $pesanan->name }}</td>
                                        <td class="text-center">{{ $pesanan->getMakeup->name }}</td>
                                        <td class="text-center">{{ $pesanan->getTypeMakeup->name }}</td>
                                        <td class="text-center">{{ date('d F Y', strtotime($pesanan->tanggal_booking)) }}
                                        </td>
                                        <td class="text-center">{{ $pesanan->waktu_booking }}</td>
                                        <td>
                                            @if ($pesanan->status == 0)
                                                <select name="status" class="badge bg-warning"
                                                    onchange="changeStatus(this.value, {{ $pesanan->id }})">
                                                    <option class="badge bg-warning" value="0"
                                                        {{ $pesanan->status == 0 ? 'selected' : '' }}>Pending</option>
                                                    <option class="badge  bg-primary" value="1"
                                                        {{ $pesanan->status == 1 ? 'selected' : '' }}>Terima</option>
                                                    <option class="badge  bg-danger" value="3"
                                                        {{ $pesanan->status == 3 ? 'selected' : '' }}>Tolak</option>
                                                </select>
                                            @elseif ($pesanan->status == 1)
                                                <select name="status" class="badge  bg-primary"
                                                    onchange="changeStatus(this.value, {{ $pesanan->id }})">
                                                    <option class="badge  bg-warning" value="0"
                                                        {{ $pesanan->status == 0 ? 'selected' : '' }}>Pending</option>
                                                    <option class="badge  bg-primary" value="1"
                                                        {{ $pesanan->status == 1 ? 'selected' : '' }}>Terima</option>
                                                    <option class="badge  bg-danger" value="3"
                                                        {{ $pesanan->status == 3 ? 'selected' : '' }}>Tolak</option>
                                                </select>
                                            @elseif ($pesanan->status == 3)
                                                <select name="status" class="badge bg-danger"
                                                    onchange="changeStatus(this.value, {{ $pesanan->id }})">
                                                    <option class="badge bg-warning" value="0"
                                                        {{ $pesanan->status == 0 ? 'selected' : '' }}>Pending</option>
                                                    <option class="badge bg-primary" value="1"
                                                        {{ $pesanan->status == 1 ? 'selected' : '' }}>Terima</option>
                                                    <option class="badge bg-danger" value="3"
                                                        {{ $pesanan->status == 3 ? 'selected' : '' }}>Tolak</option>
                                                </select>
                                            @endif
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function changeStatus(status, pesananId) {
        $.ajax({
            type: "POST",
            url: "{{ route('changeStatus') }}",
            data: {
                _token: '{{ csrf_token() }}',
                status: status,
                pesanan_id: pesananId
            },
            success: function(response) {
                // Tampilkan pesan sukses atau lakukan aksi lain yang diperlukan
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
                console.error(error);
            }
        });
    }
</script>

@endsection
