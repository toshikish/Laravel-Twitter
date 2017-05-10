@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新しいツイート    
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Tweet Form -->
                    <form action="{{ url('tweet') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Tweet Name -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <textarea name="tweet" id="tweet" class="form-control" value="{{ old('tweet') }}"></textarea>
                            </div>
                        </div>

                        <!-- Add Tweet Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>つぶやく
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tweets -->
            @if (count($tweets) > 0)
                <div class="list-group">
                    @foreach ($tweets as $tweet)
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <h4 class="list-group-item-heading">{{ $tweet->user->nickname }} {{ '@' . $tweet->user->name }}</h4>
                            <small class="text-muted">{{ $tweet->getDiffForHumans() }}</small>
                            <p class="list-group-item-text">{{ $tweet->tweet }}</p>
                            @if (Auth::check() && Auth::id() === $tweet->user_id)
                                <form action="{{url('tweet/' . $tweet->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-tweet-{{ $tweet->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>削除
                                    </button>
                                </form>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection