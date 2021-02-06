@extends('web/layout')

@section('title')
      Question - {{ $exam->name() }}
@endsection

@section('styles')
        <link href="{{ asset('web/css/TimeCircles.css') }}" rel="stylesheet">
@endsection

@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="category.html">{{ $exam->skill->cat->name() }}</a></li>
                        <li><a href="category.html">{{ $exam->skill->name() }}</a></li>
                        <li>{{ $exam->name() }}</li>
                    </ul>
                    <h1 class="white-text">{{ $exam->name() }}</h1>
                    <ul class="blog-post-meta">
                        <li>{{ Carbon\Carbon::parse($exam->created_at)->format("d M, Y")}}</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>{{ $exam->users()->count() }}</a></li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

        <!-- main blog -->
        <div id="main" class="col-md-9">

            {{-- make form and conect with input to receive answer and count score --}}
            <form id="exam-submit-form" action="{{ url("exams/submit/{$exam->id}") }}" method="post">
                @csrf
            </form>

        <!-- blog post -->
        <div class="blog-post mb-5">
            <p>
                {{-- foreach to shows exams --}}
                @foreach ($exam->questions as $index => $ques)
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        {{-- after loop we show title by $ques->title --}}
                        <h3 class="panel-title">{{$index + 1 }}- {{$ques->title}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="radio">
                            <label>
                                <input type="radio" name="answers[{{ $ques->id }}]"  value="1" form="exam-submit-form">
                                {{$ques->option_1}}
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="answers[{{ $ques->id }}]"   value="2" form="exam-submit-form">
                                {{$ques->option_2}}
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="answers[{{ $ques->id }}]"   value="3" form="exam-submit-form">
                                {{$ques->option_3}}
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="answers[{{ $ques->id }}]"   value="4" form="exam-submit-form">
                                {{$ques->option_4}}
                            </label>
                        </div>
                    </div>
                    </div> 
                @endforeach  
            </p>       
        </div>
        <!-- /blog post -->
            
            <div>
                {{-- conet button submit with form  to can count answer  --}}
                <button type="submit" form="exam-submit-form" class="main-button icon-button pull-left">Submit</button>
                <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
            </div>
        </div>
        <!-- /main blog -->
                
            <!-- aside blog -->
            <div id="aside" class="col-md-3">

                <!-- exam details widget -->
                <ul class="list-group">
                    <li class="list-group-item">{{ __('web.skill') }}: {{ $exam->skill->name() }}</li>
                    <li class="list-group-item">{{ __('web.questions') }}:{{ $exam->questions_num }}</li>
                    <li class="list-group-item">{{ __('web.duration') }}: {{ $exam->duration_mins }}</li>
                    <li class="list-group-item">{{ __('web.difficulty') }}: 
                        <!-- to make start for exam difficulty we make for loop -->
                        @for ($i = 1; $i <= $exam->difficulty ; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        @for ($i = 1; $i <= 5-$exam->difficulty ; $i++)
                            <i class="fa fa-star-o"></i>
                        @endfor
                    </li>
                </ul>
                <!-- /exam details widget --> 
                
                {{-- time watch for exam  count seconds so we calculte it by exam time minuts * 60 seonds  --}}
                <div class="deuration-countdown" data-timer="{{$exam->duration_mins * 60}}"></div>

            </div>
            <!-- /aside blog -->
            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->

@endsection
            {{-- here we use count down and disable it when arrive zero to not count up again when arrive to zero --}}
@section('scripts')
    <script type="text/javascript" src="{{ asset('web/js/TimeCircles.js') }}"></script>
        <script>
              $(".deuration-countdown").TimeCircles({
                 time: {
                     Days: {
                         show: false,
                     }
                 },
                 //this to stop count when arrive to zero not count up again and make submit form outomatic when time finish
                      count_past_zero: false,
                }).addListener(function(unit, value, total) {
                    if(total <= 0) {
                        $('#exam-submit-form').submit()
                    };
                });
        </script>
@endsection