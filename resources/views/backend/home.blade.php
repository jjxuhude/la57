@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="content-wraper">
        <div class="messages">
                <span class="iconfont message-warning"></span>
                <span>
                One or more integrations have been reset because of a change to their xml configs.
        </div>
        <div class="page-title"></div>
        <div class="tools"></div>
        <div class="grid">
            <div class="grad-header"></div>
            <div class="grad-data"></div>
        </div>
    </div>
</div>
@endsection
