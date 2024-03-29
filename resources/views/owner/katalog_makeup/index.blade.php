@extends('admin.dashboard')
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Katalog Makeup</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Katalog Makeup</li>
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
                <h3 class="card-title">Makeup Tabl</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-15p border-bottom-0">name</th>
                                <th class="wd-20p border-bottom-0">description</th>
                                <th class="wd-20p border-bottom-0">Tipe Makeup</th>
                                <th class="wd-15p border-bottom-0">price</th>
                                <th class="wd-15p border-bottom-0">image</th>
                                <th class="wd-15p border-bottom-0">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($katalog_makeup as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->description}}</td>
                                <td>
                                    <ul>
                                        @foreach ($data->detailMakeup as $type)
                                            <li>-- {{ $type->getType->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{'Rp'.  number_format($data->price, 0,',', '.')}}</td>
                                <td><img src="{{asset(''). $data->image}}" style="width:60px;height:60"></td>
                                <td class="text-center">
                                    <a class="btn btn-warning" data-bs-target="#modaldemo2{{$data->id}}" data-bs-toggle="modal" href=""><i class="fa fa-edit"></i></a>
                                    <form method="POST" action="{{url('/owner/katalog_makeup/'.$data->id)}}">
                                        @method('delete')
                                        @csrf
                                    <button type="submit" onclick="return confirm('apakah data ingin dihapus')"
                                        class="btn btn-danger ">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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

{{-- Start Tambah Modal --}}

<div class="modal fade" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Data Makeup</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ url('/owner/katalog_makeup') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">nama makeup</label>
                            <input class="form-control  mb-4 is-valid state-valid" placeholder="Masukan nama makeup" required="" type="text" name="name">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">deskripsi</label>
                            <input class="form-control  mb-4 is-valid state-valid" placeholder="Masukan deskripsi" required="" type="text" name="description">
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">harga</label>
                            <input class="form-control  mb-4 is-valid state-valid" placeholder="Masukan harga" required="" type="number" name="price">
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">image</label>
                            <input class="form-control  mb-4 is-valid state-valid" placeholder="Masukan image"  type="file" name="image">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            @foreach ($tipe as $item )
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="type_makeup[]"
                                    value="{{ $item->id }}">
                                <span class="custom-control-label">{{ $item->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save changes</button> <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Tambah Modal --}}

@foreach ($katalog_makeup as $edit)


<div class="modal fade" id="modaldemo2{{$edit->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('/owner/katalog_makeup/' .$edit->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">name</label>
                            <input value="{{$edit->name}}" class="form-control  mb-4 is-valid state-valid" placeholder="Masukan Nama" required="" type="text" name="name">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <input value="{{$edit->description}}" class="form-control  mb-4 is-valid state-valid" placeholder="Masukan deskripsi" required="" type="text" name="description">
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Harga</label>
                            <input value="{{$edit->price}}" class="form-control  mb-4 is-valid state-valid" placeholder="Masukan " required="" type="number" name="price">
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class ="form-group">
                            <label for="image">Gambar</label>
                            @if ($edit->image)
                                <p>Nama file: {{ $edit->image }}</p>
                                <img src="{{ asset(''. $edit->image )}}" alt="Current Image"
                                    style="max-height: 100px;">
                            @else
                                <p>No image available</p>
                            @endif
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save changes</button> <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
