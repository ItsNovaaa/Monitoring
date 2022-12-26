<div class="form-group">
    {!! Form::label('namaPerusahaan', 'Nama Perusahaan') !!}
    {!! Form::select('id_perusahaan', ['' => 'Pilih'] + \App\Models\Perusahaan::pluck('nama_perusahaan', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'namaPerusahaan']) !!}
</div>
<div class="form-group">
    {!! Form::label('namaKendaraan', 'Nama Kendaraan') !!}
    {!! Form::text('nama_kendaraan', null, ['class' => 'form-control', 'id' => 'namaKendaraan']) !!}
</div>
<div class="form-group">
    {!! Form::label('jenisKendaraan', 'Jenis Kendaraan') !!}
    {!! Form::text('jenis_kendaraan', null, ['class' => 'form-control', 'id' => 'jenisKendaraan']) !!}
</div>
<div class="form-group">
    {!! Form::label('tipeKendaraan', 'Tipe Kendaraan') !!}
    {!! Form::select('tipe_kendaraan', ['' => 'Pilih', 'berat' => 'Berat', 'ringan' => 'Ringan', 'sedang' => 'Sedang'], null, ['class' => 'form-control', 'id' => 'tipeKendaraan']) !!}
</div>
<div class="form-group">
    {!! Form::label('bbm', 'BBM (liter)') !!}
    {!! Form::text('bbm', null, ['class' => 'form-control', 'id' => 'bbm', 'data-input-type' => 'number-format', 'data-thousand-separator' => false, 'data-decimal-separator' => false, 'data-precision' => 0]) !!}
</div>
<div class="form-group">
    {!! Form::label('jadwalService', 'Jadwal Service') !!}
    {!! Form::text('jadwal_service', null, ['class' => 'form-control', 'id' => 'jadwalService', 'data-input-type' => 'dateinput']) !!}
</div>
<div class="form-group">
    {!! Form::checkbox('sewaan', 1, isset($model->sewa) && $model->sewa == 1 ? true : false, ['id' => 'sewaan', 'onclick' => 'sewaans()']) !!}
    {!! Form::label('sewaan', 'Sewaan') !!}
</div>
<div id="template"></div>
<script>
    $(function() {
        $('#template').buildForm();
        if ($('#sewaan').is(':checked') == true) {
            sewaans();
        }
    })
    function sewaans() {
        if ($('#sewaan').is(':checked') == true) {
            $('#template').html(`
                <div class="form-group">
                    <label>Biaya</label>    
                    <input type="text" class="form-control text-right" id="biaya" name="biaya" data-input-type="number-format" value="{{ isset($model->sewa) && $model->sewa == 1 ? $model->biaya : 0 }}">
                </div>
                <div class="form-group">
                    <label>Dari Tanggal</label>    
                    <input type="text" class="form-control" id="dariTanggal" name="dari_tanggal" data-input-type="dateinput" value="{{ isset($model->sewa) && $model->sewa == 1 ? date('d-m-Y', strtotime($model->dari_tanggal)) : null }}">
                </div>
                <div class="form-group">
                    <label>Sampai Tanggal</label>    
                    <input type="text" class="form-control" id="sampaiTanggal" name="sampai_tanggal" data-input-type="dateinput" value="{{ isset($model->sewa) && $model->sewa == 1 ? date('d-m-Y', strtotime($model->sampai_tanggal)) : null }}">
                </div>
            `)
            $('#template').buildForm();
        } else {
            $('#template').html('')
        }
    }
</script>