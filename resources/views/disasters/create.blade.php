@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>災害の登録およびメール送信確認</h1>
    </div>

    {!! Form::open(['route' => 'disasters.store']) !!}
    <div class="container">

    <div class="row">
        <div class="col-sm-12 offset-sm-0 p-1">
            <div class="text-center mt-4">
                <h3 class="alert alert-warning text-left" role="alert">災害を登録すると全ユーザーに安否確認メールを作成します。よろしいですか？</h3>
            </div>
            <div class="text-center mt-4">
                <button type="button" class="btn btn-dark">{!! link_to_route('disasters.index', 'いいえ', [],['id' => 'btn-confirm']) !!}</button>
                {!! Form::submit('はい', ['class' => 'btn btn-danger', 'id' => 'btn-disaster-create']) !!}
            </div>
        </div>
    </div>

    <div class="row disaster_confirm_block">
        <div class="col-sm-2 offset-sm-2 p-1">
            <div class="form-group text-align-r mt-1">
                {!! Form::label('name', '災害名称', ['class' => 'lbl-name',]) !!}
            </div>
        </div>
        <div class="col-sm-4 p-1">
            <div class="form-group text-align-l">
                {!! Form::text('name', $disaster['name'], ['class' => 'form-control txt-name', 'id' => 'disaster-name']) !!}
            </div>
        </div>
        <div class="col-sm-4 p-1">
        </div>
    </div>
    {!! Form::close() !!}

    <div class="row users_block">
        <div class="col-sm-6 offset-sm-3 mt-2">
            <table  id="users-table" class="table table-striped table-sm  table-borderless table-responsive">
                <thead class="table-primary">
                    <tr>
                        <th colspan="2">name</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><img class="rounded-circle avatar" src="{{ Gravatar::src($user->email, 20) }}" alt="アバター"></td>
                        <td>{{ $user->name }}</td>
                        <td class="mailto">{{ $user->email }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-3">
        </div>
    </div>

    <div class="container">
@endsection


