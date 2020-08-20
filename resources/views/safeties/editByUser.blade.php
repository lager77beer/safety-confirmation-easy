@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザー安否登録・変更</h1>
    </div>

    <div class="container">

@if ($safety != null)

    <div class="row disaster_block p-0">
        <div class="col-sm-1 offset-sm-2 p-0">
            <h4 class="disaster-name text-align-r">{!! link_to_route('safety.indexByDisaster', $disaster->id, ['disaster' => $disaster]) !!}</h4>
        </div>
        <div class="col-sm-5 p-0">
            <h3 class="disaster-name text-align-l text-danger">{{ $disaster->name }}</h3>
        </div>
        <div class="col-sm-3 p-0">
            <h4 class="disaster-name text-align-l">{{ $disaster->created_at }}</h4>
        </div>
    </div>

    <div class="row safety_name_block">
        <div class="user-block col-sm-8 offset-sm-3 p-0">
            <img class="rounded-circle avatar" src="{{ Gravatar::src($safety->user()->email, 50) }}" alt="アバター">
            <p>{{ $user->name }}</p>
        </div>
    </div>

    <div class="row safety_edit_block">
        <div class="col-sm-2 offset-sm-3" id="waku-1">
        {!! Form::model($safety, ['route' => ['safety.update', $safety->id], 'method' => 'put']) !!}
            <div class="form-group">
                <div class="radioBtn-title"><p>本人の安否</p></div>
            </div>
        </div>
        <div class="col-sm-4" id="waku-2">
            <div class="form-group">
                <div class="radioBtn form-inline">
                    <div class="col-sm-6 offset-sm-0 p-0">
                        <div class="radioBtn-01">
                            <div class="form-check-inline">
                                {!! Form::radio('myself', '不明', false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('myself', '不明', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check-inline">
                                {!! Form::radio('myself', '無事', false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('myself', '無事', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>
                        <div class="radioBtn-23">
                            <div class="form-check-inline">
                                {!! Form::radio('myself', '有事', false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('myself', '有事（けが等）', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check-inline">
                                {!! Form::radio('myself', '回復', false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('myself', '回復', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row safety_contact_block">
        <div class="col-sm-6 offset-sm-3 p-0">
            <div class="form-group">
                <div class="contact">
                    <div class="Contact-title"><p class="m-0">連絡事項（任意）</p></div>
                    {!! Form::textarea('contact_information', $safety->contact_information, ['size' => '60x3','class' => 'form-control']) !!}
                </div>
            </div>
            {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @else
    <div class="disaster-block text-center mt-5">
        <p class="lead text-left alert alert-info">現在、あなた（{{ $user->name }}）の安否登録が必要な災害はありません。</p>
    </div>
    @endif

    </div>
@endsection
