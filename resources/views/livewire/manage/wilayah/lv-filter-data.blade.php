@section('css-libraries')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

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
                                <th class="text-left" scope="col">Divisi</th>
                                <th class="text-left" style="width: 150px;" scope="col">Menu</th>
                                <th class="text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ([] as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->getRoleNames()[0] ?? '-'}}</td>
                                <td>
                                    <button wire:click="setUser({{$user->id}})" wire:target="setUser({{$user->id}})" data-toggle="modal" data-target="#modalEditUserRole" wire:loading.class="disabled btn-progress" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
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
    
</div>

@push('script-libraries')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
@endpush
@push('script')
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
