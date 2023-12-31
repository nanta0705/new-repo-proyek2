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
        <a class="btn btn-primary" data-bs-target="#modaldemo1" data-bs-toggle="modal" href="">View Live Demo</a>
        <a href="javascript:void(0);" class="btn btn-success btn-icon text-white">
            <span>
                <i class="fe fe-log-in"></i>
            </span> Export
        </a>
    </div>
</div>
<!-- PAGE-HEADER END -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Responsive DataTable</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-15p border-bottom-0">Username</th>
                                <th class="wd-20p border-bottom-0">Alamat</th>
                                <th class="wd-15p border-bottom-0">No Telepon</th>
                                <th class="wd-15p border-bottom-0">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->alamat}}</td>
                                <td>{{$data->no_tlp}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="{{url('/admin/content/view/'.$data->id)}}"><i class="fa fa-eye"></i></a>
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
@endsection
