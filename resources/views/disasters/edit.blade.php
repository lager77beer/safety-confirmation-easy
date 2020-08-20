@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>災害情報更新</h1>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::model($disaster, ['route' => ['disasters.update', $disaster->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', '災害名称') !!}
                    {!! Form::text('name', $disaster->name, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}

            {!! Form::model($disaster, ['route' => ['disasters.destroy', $disaster->id], 'method' => 'delete']) !!}
                <div class="form-group center">
                    <button type="button" class="btn-warning" data-toggle="modal" data-target="#confirm-modal">
                    災害情報の削除
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
