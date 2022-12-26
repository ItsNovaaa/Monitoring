{!! Form::model($model, ['id' => 'formApprove']) !!}
    <div class="form-group">
        {!! Form::label('namaPejabat', 'Nama Pejabat') !!}
        @if ($model->id_approval)
            {!! Form::hidden('id_approval', $model->id_approval) !!}
            {!! Form::text('nama_pejabat', $model->nama_pejabat, ['class' => 'form-control', 'id' => 'namaPejabat', 'readonly']) !!}
        @else
            {!! Form::select('id_approval', ['' => 'Pilih'] + App\Models\Pejabat::pluck('nama_pejabat', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'namaPejabat']) !!}
        @endif
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="approved('{{ $model->id }}')">Submit</button>
    </div>
{!! Form::close() !!}