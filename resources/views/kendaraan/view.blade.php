<table class="table" style="border: none">
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Nama Perusahaan</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->nama_perusahaan }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Nama Kendaraan</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->nama_kendaraan }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Jenis Kendaraan</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->jenis_kendaraan }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Tipe Kendaraan</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ ucwords($model->tipe_kendaraan) }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">BBM (liter)</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->bbm }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Jadwal Service</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ date('d-m-Y', strtotime($model->jadwal_service)) }}</td>
    </tr>
    @if ($model->sewa == 1)
        <tr>
            <td style="border-top: 0; border-bottom: 0;">Biaya</td>
            <td style="border-top: 0; border-bottom: 0;">:</td>
            <td style="border-top: 0; border-bottom: 0;">{{ number_format($model->biaya) }}</td>
        </tr>
        <tr>
            <td style="border-top: 0; border-bottom: 0;">Dari Tanggal</td>
            <td style="border-top: 0; border-bottom: 0;">:</td>
            <td style="border-top: 0; border-bottom: 0;">{{ date('d-m-Y', strtotime($model->dari_tanggal)) }}</td>
        </tr>
        <tr>
            <td style="border-top: 0; border-bottom: 0;">Sampai Tanggal</td>
            <td style="border-top: 0; border-bottom: 0;">:</td>
            <td style="border-top: 0; border-bottom: 0;">{{ date('d-m-Y', strtotime($model->sampai_tanggal)) }}</td>
        </tr>
    @endif
</table>