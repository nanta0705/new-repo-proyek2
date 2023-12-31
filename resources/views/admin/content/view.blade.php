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
</div>
<!-- PAGE-HEADER END -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$name}}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-20p border-bottom-0">Description</th>
                                <th class="wd-20p border-bottom-0">Type Makeup</th>
                                <th class="wd-15p border-bottom-0">Price</th>
                                <th class="wd-15p border-bottom-0">Image</th>
                                <th class="wd-15p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($makeup as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    <ul>
                                        @foreach ($data->detailMakeup as $type)
                                            <li>-- {{ $type->getType->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ 'Rp'. number_format($data->price, 0, ',', '.') }}</td>
                                <td><img src="{{ asset('') . $data->image }}" style="width: 60px; height: 60;"></td>
                                <td class="text-center">
                                    <form action="/admin/content/changestatus" method="POST">
                                        @csrf
                                        <label class="custom-switch">
                                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                                data-product-id="{{ $data->id }}" {{ $data->managementContent->active == 1 ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
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
@endsection

@section('js')
<script>
    $('body').on('change', '.custom-switch-input', function() {
            let productId = $(this).data('product-id');
            let isChecked = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                method: 'POST',
                url: '/admin/content/changestatus',
                data: {
                    productId: productId,
                    isChecked: isChecked,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
</script>


@endsection
