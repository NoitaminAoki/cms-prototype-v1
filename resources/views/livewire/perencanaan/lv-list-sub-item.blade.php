@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

<div>   
    <section class="section">
        <div class="section-header">
            <h1>List Sub Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Perencanaan</a></div>
                <div class="breadcrumb-item"><a href="#">Sub Item</a></div>
                <div class="breadcrumb-item">List Sub Item</div>
            </div>
        </div>
        
        <div class="section-body">
            <h2 class="section-title">This is Example Page</h2>
            <p class="section-lead">This page is just an example for you to create your own page.</p>
            <div class="card">
                <div class="card-header">
                    <h4>Example Card</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Uraian</th>
                                <th class="text-center" scope="col">Satuan</th>
                                <th class="text-center" scope="col">Volume</th>
                                <th class="text-center" scope="col">Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sub_items as $key => $sub_item)
                            <tr>
                                <td class="text-primary font-weight-bold" colspan="4">{{$converter_class::numberToRoman($key+1)}}.  {{$sub_item->nama}}</td>
                            </tr>
                            @if ($sub_item->has_group)
                            @foreach ($sub_item->materials->groupBy('sub_item_group_id') as $group_material)
                            <tr>
                                <td class="text-center font-weight-bold">
                                    {{$group_material[0]->group->nama}}
                                </td>
                                <td colspan="4"></td>
                            </tr>
                            @foreach ($group_material as $sub_key => $material)
                            <tr>
                                <td>{{$sub_key+1}}. {{$material->material_detail->nama_material}}</td>
                                <td class="text-center text-danger">{{$material->material_detail->ms_satuan->satuan}}</td>
                                <td class="text-right text-danger">{{$material->material_detail->volume}}</td>
                                <td>
                                    <div class="d-flex justify-content-between"><span>Rp</span><span>{{number_format($material->material_detail->harga_satuan, 0, ',', '.')}}</span></div>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @else
                            @foreach ($sub_item->materials as $sub_key => $material)
                            <tr>
                                <td>{{$sub_key+1}}. {{$material->material_detail->nama_material}}</td>
                                <td class="text-center text-danger">{{$material->material_detail->ms_satuan->satuan}}</td>
                                <td class="text-right text-danger">{{$material->material_detail->volume}}</td>
                                <td>
                                    <div class="d-flex justify-content-between"><span>Rp</span><span>{{number_format($material->material_detail->harga_satuan, 0, ',', '.')}}</span></div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>

@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>

<script>
    
    document.addEventListener('notification:success', function (event) {
        $('.modal').modal('hide');
        
        setTimeout(function() {
            Swal.fire({
                icon: 'success',
                title: event.detail.title,
                text: event.detail.message,
            });
        }, 600);
    })
</script>
@endpush
