<div class="form-group">
    {!! Form::label('pegawai', 'Nama Pegawai') !!}
    {!! Form::select('id_pegawai', ['' => 'Pilih'] + \App\Models\Pegawai::pluck('nama_pegawai', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'namaPerusahaan']) !!}
</div>
<div class="form-group">
    {!! Form::label('kendaraan', 'Kendaraan') !!}
    {!! Form::select('id_kendaraan', ['' => 'Pilih'] + \App\Models\Kendaraan::where('status_unit', 1)->pluck('nama_kendaraan', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'kendaraan']) !!}
</div>
<div class="form-group">
    {!! Form::label('tujuan', 'Tujuan Pemesanan') !!}
    {!! Form::textarea('tujuan_pemesanan', null, ['class' => 'form-control', 'id' => 'tujuan', 'rows' => 5]) !!}
</div>
@if (auth()->user()->role == 'admin')
    <div class="form-group">
        {!! Form::label('namaPejabat', 'Nama Pejabat') !!}
        {!! Form::select('id_approval', ['' => 'Pilih'] + \App\Models\Pejabat::pluck('nama_pejabat', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'namaPerusahaan']) !!}
    </div>
@endif
