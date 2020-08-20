@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザー安否確認一覧</h1>
    </div>

    <div class="container">

    <div class="row disaster_block p-0">
        <div class="col-sm-3 offset-sm-1 p-0">
            <h4 class="disaster-name text-align-r">{{ $disaster->updated_at }}</h4>
        </div>
        <div class="col-sm-7 p-0">
            <h3 class="disaster-name text-align-l text-danger">{{ $disaster->name }}</h3>
        </div>
        <div class="col-sm-1 p-0">
            <div id="filter-box"></div>
        </div>
    </div>

    <div class="row">
        <div class="safety_index_block col-sm-12 offset-sm-0">
            <table  id="safety-table" class="table table-striped table-sm table-borderless">
                <tfoot>
                    <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>安否_フィルタ</th>
                    <th></th>
                @if ($admin)
                    <th></th>
                    <th></th>
                @endif
                    </tr>
                </tfoot>
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th></th>
                        <th>名前</th>
                        <th>安否</th>
                        <th>更新日時</th>
                    @if ($admin)
                        <th>電話番号</th>
                        <th>ユーザー情報メンテ</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($safety_users as $safety_user)
                    <tr>
                        {{-- ここでは管理者用に、safety_user->user_idではなくsafety_user->idをパラメータにセット --}}
                        <td>{!! link_to_route('safety.editByUser', $safety_user->user_id, ['id' => $safety_user->id]) !!}</td>
                        <td><img class="rounded-circle avatar" src="{{ Gravatar::src($safety_user->email, 20) }}" alt="アバター"></td>
                        <td>{{ $safety_user->name }}</td>
                        <td><h5 class="myself-Safety">{{ $safety_user->myself }}</h5></td>
                        <td>{{ $safety_user->updated_at }}</td>
                    @if ($admin)
                        <td>{{ $safety_user->phone }}</td>
                        <td>{!! link_to_route('users.edit', "ユーザー情報メンテ", ['id' => $safety_user->user_id], ['class' => 'badge badge-warning']) !!}</td>
                    @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
@endsection


