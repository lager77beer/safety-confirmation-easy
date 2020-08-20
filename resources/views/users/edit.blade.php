@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザー情報更新</h1>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control','disabled' => 'disabled']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Password（確認）') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Phone') !!}
                    {!! Form::text('phone',$user->phone, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}

            {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class="form-group center">
                    <button type="button" class="btn-warning" data-toggle="modal" data-target="#confirm-modal">
                    ユーザーの削除
                    </button>
                </div>
                {{-- 削除確認モーダル --}}
                <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <label>削除してよろしいですか？</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">いいえ</button>
                                {!! Form::submit('はい', ['class' => 'btn btn-danger']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
    </div>
@endsection
