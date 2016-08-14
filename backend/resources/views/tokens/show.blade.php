@extends('layout')
@section('header')
<div class="page-header">
        <h1>Tokens / Show #{{$token->id}}</h1>
        <form action="{{ route('tokens.destroy', $token->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('tokens.edit', $token->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="plataform">PLATAFORM</label>
                     <p class="form-control-static">{{$token->plataform}}</p>
                </div>
                    <div class="form-group">
                     <label for="token">TOKEN</label>
                     <p class="form-control-static">{{$token->token}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('tokens.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection