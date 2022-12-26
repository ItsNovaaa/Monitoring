@extends('layout')
@section('title', 'Dashboard')
@section('content')
<div class="portlet">
    <div class="portlet-body">
        <div id="chart"></div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $.ajax({
                url: '',
                success: function(response) {
                    var jumlah = [];
                    var nama_kendaraan = [];
                    $.each (response, function(i, row) {
                        jumlah.push(row.jumlah)
                        nama_kendaraan.push(row.nama_kendaraan)
                    })
                    var options = {
                        series: [{
                        name: 'Frekuensi',
                        type: 'column',
                        data: jumlah
                        }],
                        chart: {
                        height: 300,
                        type: 'line',
                        },
                        stroke: {
                        width: [0, 4]
                        },
                        title: {
                        text: 'Kendaraan Yang Digunakan'
                        },
                        dataLabels: {
                        enabled: true,
                        enabledOnSeries: [1]
                        },
                        labels: nama_kendaraan,
                        yaxis: [{
                        title: {
                            text: 'Frekuensi',
                        },
                        }]
                    };
        
                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();  
                }
            })
        })
    </script>
@endpush