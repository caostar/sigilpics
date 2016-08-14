@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Tokens / Edit #{{$token->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('tokens.update', $token->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('plataform')) has-error @endif">
                       <label for="plataform-field">Plataform</label>
                    <input type="text" id="plataform-field" name="plataform" class="form-control" value="{{ is_null(old("plataform")) ? $token->plataform : old("plataform") }}"/>
                       @if($errors->has("plataform"))
                        <span class="help-block">{{ $errors->first("plataform") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('token')) has-error @endif">
                       <label for="token-field">Token</label>
                    <textarea class="form-control" id="token-field" rows="3" name="token">{{ is_null(old("token")) ? $token->token : old("token") }}</textarea>
                       @if($errors->has("token"))
                        <span class="help-block">{{ $errors->first("token") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('tokens.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
