<div>
    <section class="section">
        <div class="section-header">
            <h1>Divisi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Perencanaan</a></div>
                <div class="breadcrumb-item">Divisi</div>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Divisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisis as $key => $divisi)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$divisi->nama}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
