@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ログイン</h1>
    </div>

    <div class="container">

    <div class="row">
        <div class="col-sm-4 offset-sm-4">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

            <p class="mt-2">New user? {!! link_to_route('signup.get', '新規登録') !!}</p>
            <p class="mt-4">使用方法? <a href="https://cacoo.com/diagrams/T3w8k1qkiy6Ep0TF/38A2D" target="_blank">サイトマップ等</a></p>
        </div>
    </div>

    </div>
@endsection
