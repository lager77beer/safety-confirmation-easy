@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>災害一覧</h1>
    </div>

    <div class="container">

    <div class="row disaster_index_block mt-4">
        <div class="col-sm-12 offset-sm-0">
            <table  id="disaster-table" class="table table-striped table-sm  table-borderless">
                <thead class="table-primary">
                    <tr>
                        <th>安否一覧[ID]</th>
                        <th>災害</th>
                        <th>日付</th>
                        <th>メンテ</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($disasters as $disaster)
                    <tr>
                        <td>{!! link_to_route('safety.indexByDisaster', "安否一覧[{$disaster->id}]", ['id' => $disaster->id]) !!}</td>
                        <td>{{ $disaster->name }}</td>
                        <td>{{ $disaster->created_at }}</td>
                        <td>{!! link_to_route('disasters.edit', "メンテ", ['id' => $disaster->id], ['class' => 'badge badge-warning']) !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ Form::open(['route' => 'disasters.create', 'method' => 'get'])}}
    <div class="row disaster_create_block">
        <div class="col-sm-2 offset-sm-2 p-1">
            <div class="form-group text-align-r mt-1">
                {!! Form::label('name', '災害名称', ['class' => 'lbl-name',]) !!}
            </div>
        </div>
        <div class="col-sm-4 p-1">
            <div class="form-group text-align-l">
                {!! Form::text('name', null, ['class' => 'form-control txt-name',]) !!}
            </div>
        </div>
        <div class="col-sm-4 p-1">
            <div class="form-group text-align-l">
                {!! Form::submit('新規登録＆メール送信', ['class' => 'btn btn-primary', 'id' => 'btn-create']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    </div>
@endsection


