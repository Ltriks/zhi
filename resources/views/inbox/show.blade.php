@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dialog List</div>
                    <div class="panel-body">
                        <form action="/inbox/{{$dialogId}}/store" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="body" class="form-control"></textarea>
                            </div>
                            <div class="form-group pull-right">
                                <button class="btn btn-success">Send Message</button>
                            </div>
                        </form>
                        <div class="message-list">
                            @foreach($messages as $message)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img width="48" src="{{ $message->fromUser->avatar }}" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="#">
                                                {{ $message->fromUser->name }}
                                            </a>
                                        </h4>
                                        <p>
                                            {{ $message->body }} <span class="pull-right"> {{ $message->created_at->format('m-d H:i') }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
