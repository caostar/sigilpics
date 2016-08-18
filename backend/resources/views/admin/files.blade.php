@extends('layouts.default-logged')

@section('content')
<h3>List Files</h3>
<ul id="files">
    @foreach($files as $file)
    <li>
        <div class="file">

            <div class="file-title">
                <img src="{{ $file->iconLink }}">
                {{ $file->name }}
            </div>
            <div class="file-modified">
                last modified: {{ Date::format($file->modifiedTime) }}
            </div>
            <div class="file-links">
                <img src="{{ $file->thumbnailLink }}" alt="{{ $file->originalFilename }}"> 
                <a href="{{ $file->thumbnailLink }}" target="_blank">view thumb in browser</a>
                <a href="downloadFile/{{ $file->id }}" target="_blank">view full in browser</a>
                <a href="{{ $file->webViewLink }}" target="_blank">view inside drive (must be logged)</a>
                @if(!empty($file->webContentLink))
                <a href="{{ $file->webContentLink }}" target="_blank">direct download (must be logged)</a>
                @endif
                <!-- <a href="delete/{{ $file->id }}">delete</a> -->
            </div>
        </div>
    </li>
    @endforeach
</ul>
@stop