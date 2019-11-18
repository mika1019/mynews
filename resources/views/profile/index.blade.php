@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                
                                <div class="name p-2">
                                    <h1>{{ str_limit($headline->name, 70) }}</h1>
                                </div>
                                <div class="gender p-2">
                                    <h1>{{ str_limit($headline->gender, 70) }}</h1>
                                </div>
                                <div class="hobby p-2">
                                    <h1>{{ str_limit($headline->hobby, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="introduction mx-auto">{{ str_limit($headline->introduction, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="profiles col-md-8 mx-auto mt-3">
                @foreach($profiles as $profile)
                    <div class="profile">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $profile->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ str_limit($profile->name, 150) }}
                                </div>
                                <div class="gender">
                                    {{ str_limit($profile->gender, 150) }}
                                </div>
                                <div class="hobby">
                                    {{ str_limit($profile->hobby, 150) }}
                                </div>
                                <div class="introduction mt-3">
                                    {{ str_limit($profile->introduction, 1500) }}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection