@section('css-libraries')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

@inject('sectorDataHelper', 'App\Helpers\SectorData')

<div>   
    <section class="section">
        <div class="section-header">
          <h1>Filter Data Masuk</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('master.index') }}">Master</a></div>
            <div class="breadcrumb-item">Wilayah</div>
          </div>
        </div>
        
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 25px;" scope="col">#</th>
                                <th class="text-left" scope="col">Asal</th>
                                <th class="text-left" scope="col">Nama</th>
                                <th class="text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sector_items as $key => $sector_item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$sectorDataHelper::getNameById($sector_item->sector_id)}}</td>
                                <td>{{$sector_item->image_real_name}}</td>
                                <td>
                                    <button id="container_sector_{{$key.'_'.$sector_item['id']}}" wire:click="setItem({{$sector_item['id']}}, '{{$sector_item['sector_id']}}')" data-toggle="modal" data-target="#modalViewSectorItem" class="btn btn-sm btn-info"><i class="fas fa-search"></i></button>
                                    @if ($sector_item['jurnal_pusat'])
                                    <span class="btn btn-sm btn-outline-success">Accepted.</span>
                                    @else
                                    <button wire:click="copyDataSector({{$sector_item['id']}},'{{$sector_item['sector_id']}}')" wire:target="copyDataSector({{$sector_item['id']}},'{{$sector_item['sector_id']}}')" wire:loading.class="disabled btn-progress" type="button" class="btn btn-sm btn-success"><i class="fas fa-sign-in-alt"></i> Accept</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div wire:ignore.self class="modal fade" role="dialog" id="modalViewSectorItem">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$page_attribute['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        <div class="common-section-title">Image Name</div>
                        <p>{{$selected_item['image_real_name'] ?? '-'}}</p>
                    </div>
                    <div class="w-100 mb-4">
                        <div class="common-section-title">Date</div>
                        @if ($selected_item)
                        <p>{{date('d F Y', strtotime($selected_item['tanggal']))}}</p>
                        @else
                        <p>-</p>
                        @endif
                    </div>
                    <div class="w-100">
                        @if ($selected_item)
                        <img id="sector_img_id_{{$selected_item['id']}}" src="{{$selected_url}}" class="w-100 border shadow">
                        @endif
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <div class="mr-auto">
                        @if ($selected_item)
                        <button wire:click="downloadImage('{{$selected_item['sector_id']}}')" wire:target="downloadImage" wire:loading.class="disabled btn-progress" type="button" class="btn btn-primary"><i class="fas fa-download"></i></button>
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

@push('script-libraries')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
@endpush
@push('script')
<script>
    document.addEventListener('notification:show', function (event) {
        $('.modal').modal('hide');
        
        setTimeout(function() {
            Swal.fire({
                icon: event.detail.type,
                title: event.detail.title,
                text: event.detail.message,
            });
        }, 600);
    })
</script>
@endpush
