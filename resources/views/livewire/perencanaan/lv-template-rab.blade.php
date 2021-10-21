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
                                    <th class="text-center" scope="col">Description</th>
                                    <th class="text-center" scope="col">Satuan</th>
                                    <th class="text-center" scope="col">Luasan (Jumlah)</th>
                                    <th class="text-center" scope="col">Harga Satuan</th>
                                    <th class="text-center" scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($konstruksi_divisis as $key => $konstruksi_divisi)
                                @php
                                $alphabet = range('A', 'Z');
                                @endphp
                                <tr>
                                    <td class="text-primary font-weight-bold" colspan="5">
                                        {{-- <h6 class="mb-0"><i>{{$alphabet[$key]}}.  {{$konstruksi_divisi->nama}}</i></h6> --}}
                                        <i>{{$alphabet[$key]}}.  {{$konstruksi_divisi->nama}}</i>
                                    </td>
                                </tr>
                                @foreach ($konstruksi_divisi->sub_divisis as $sub_key => $sub_divisi)
                                @if ($sub_divisi->has_child)
                                <tr>
                                    <td colspan="5"> {{$sub_key+1}}. {{$sub_divisi->nama}} </td>
                                </tr>
                                @foreach ($sub_divisi->items as $item_key => $item)
                                <tr>
                                    <td>
                                        <span class="ml-3">{{\Str::lower($alphabet[$item_key])}}. {{$item->nama}}</span>
                                    </td>
                                    <td class="text-center"> {{$item->ms_satuan->satuan}} </td>
                                    <td class="text-right"> {{number_format($item->jumlah, 0, ',', '.')}} </td>
                                    <td class="text-right"> 
                                        <div class="d-flex justify-content-between">
                                            <span>Rp</span>
                                            <span>{{number_format($item->harga, 0, ',', '.')}}</span>    
                                        </div> 
                                    </td>
                                    <td class="text-right"> 
                                        <div class="d-flex justify-content-between">
                                            <span>Rp</span>
                                            <span>{{number_format($item->total_harga, 0, ',', '.')}}</span>    
                                        </div> 
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td> {{$sub_key+1}}. {{$sub_divisi->nama}} </td>
                                    <td class="text-center"> {{$sub_divisi->ms_satuan->satuan}} </td>
                                    <td class="text-right"> 
                                        @if ($sub_divisi->is_percentage)
                                        {{$sub_divisi->jumlah}}%
                                        @else
                                        {{number_format($sub_divisi->jumlah, 0, ',', '.')}} 
                                        @endif
                                    </td>
                                    <td class="text-right"> 
                                        <div class="d-flex justify-content-between">
                                            <span>Rp</span>
                                            <span>{{number_format($sub_divisi->harga, 0, ',', '.')}}</span>    
                                        </div> 
                                    </td>
                                    <td class="text-right"> 
                                        <div class="d-flex justify-content-between">
                                            <span>Rp</span>
                                            <span>{{number_format($sub_divisi->total_harga, 0, ',', '.')}}</span>    
                                        </div> 
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td class="text-primary text-center font-weight-bold">
                                        <i>Sub Total {{$alphabet[$key]}}</i>
                                    </td>
                                    <td colspan="3"></td>
                                    <td class="text-primary text-center font-weight-bold">
                                        <div class="d-flex justify-content-between">
                                            <span>Rp</span>
                                            <span>{{number_format($konstruksi_divisi->total_harga, 0, ',', '.')}}</span>    
                                        </div> 
                                    </td>
                                </tr>
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
