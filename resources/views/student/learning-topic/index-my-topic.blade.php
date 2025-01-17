@extends('layouts.master')

@section('title')
    {{ __('section-title.my_topic_collection') }}
@endsection
@section('page-style')
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{asset('css/all.min.css')}}">
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">

            <div class="header">
                <h2><strong>{{ __('label.material') }}</strong></h2>
            </div>


            <div class="body">
                <form action="" method="GET" class="inline">
                    <div class="form-group">
                
                        <select class="form-control" id="subjectSelectBox" name="subject_id" onchange="this.form.submit()">
                            <option>{{ __('label.select_subject') }}</option> 
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>


            <div class="body topic-list-wrapper py-1">
                <h3 id="searchTitle">{{ request('subject_id') ? __('label.showing_topics_for') . ' ' . $subject->name : '' }}</h3>
                
                <!-- Include content untuk menampilkan daftar topik -->
                @include('frontpage.learning-topic.content')
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.btn-add-collection').on('click', function(){
        
        let button_content = $(this).html()
        $(this).text('Loading...')
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        let topic_id = $(this).data('topic-id')
        let button = $(this)

        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : CSRF_TOKEN
            },
            url: '{!! \LaravelLocalization::localizeURL("/my-topics") !!}',
            type: 'post',
            dataType: 'json',
            data: {
                topic_id: topic_id,
            },
            success: function(response){
                button.html(button_content)
                button.hide()
                button.siblings('.btn-remove-collection').show()
                swal({
                    text: response['message'],
                    icon: "success",
                });
            },
            error: function(response){
                swal({
                    text: "{!! __('messages.topic_fail_added') !!}",
                    icon: "error",
                });
            },
        });
    });

    $('.btn-remove-collection').on('click', function(){

        let button_content = $(this).html()
        $(this).text('Loading...')
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        let topic_id = $(this).data('topic-id')
        let button = $(this)

        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : CSRF_TOKEN
            },
            url: '{!! \LaravelLocalization::localizeURL("/my-topics") !!}/'+topic_id,
            type: 'delete',
            dataType: 'json',
            success: function(response){
                button.html(button_content)
                button.hide()
                button.siblings('.btn-add-collection').show()
                swal({
                    text: response['message'],
                    icon: "success",
                });
            },
            error: function(response){
                swal({
                    text: "{!! __('messages.topic_fail_removed') !!}",
                    icon: "error",
                });
            },
        });
    });
</script>
@stop