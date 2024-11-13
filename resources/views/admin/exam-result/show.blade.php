@extends('layouts.master')

@section('title')
    {{ __('button-label.student_response_recap')}}
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>{{$exam->title}}</strong></h2>
            </div>
            <div class="body">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 25%">{{ __('label.subject')}}</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 70%"><b>{{$exam->subject->name}}</b></td>
                    </tr>
                    <tr>
                        <td>{{ __('label.time')}}</td>
                        <td>:</td>
                        <td><b>{{$exam->date->format('d F Y').', '.$exam->time_start.' - '.$exam->time_end}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>{{ __('button-label.student_response_recap')}}</strong></h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tableStudentResponse" class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('label.name')}}</th>
                                @for($i = 1; $i <= count($exam_questions); $i++)
                                    <th>Soal {{$i}}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam_results as $exam_result)
                            <tr>
                                <td>{{$exam_result->user->name}}</td>
                                @foreach($exam_questions as $exam_question)
                                    @php
                                        $userAnswer = $exam_question->examResponses->where('exam_result_id', $exam_result->id)->first();
                                        $correctAnswer = $exam_question->answerChoices->first()->label ?? null; // Ambil jawaban benar
                                    @endphp

                                    @if($exam_question->question_type_id == 1)
                                        <td>
                                            @if($userAnswer && $userAnswer->answerChoice)
                                                @if($correctAnswer && $userAnswer->answerChoice->label == $correctAnswer)
                                                    <span style="color: green">{{ $userAnswer->answerChoice->label }}</span>
                                                @else
                                                    <span style="color: red">{{ $userAnswer->answerChoice->label }}</span>
                                                @endif
                                            @else
                                                <span style="color: red">Tidak dijawab</span>
                                            @endif
                                        </td>
                                    @elseif($exam_question->question_type_id == 2)
                                        <td>
                                            @if($userAnswer && $userAnswer->answer)
                                                @if($correctAnswer && $userAnswer->answer == $correctAnswer)
                                                    <span style="color: green">{{ $userAnswer->answer }}</span>
                                                @else
                                                    <span style="color: red">{{ $userAnswer->answer }}</span>
                                                @endif
                                            @else
                                                <span style="color: red">Tidak dijawab</span>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>

                        <!-- Tambahkan catatan di bawah jawaban -->
                        <tr>
                            <td>Catatan</td>
                            @foreach($exam_questions as $exam_question)
                                <td>
                                    @if($correctAnswerCounts[$exam_question->id] < 5)
                                        Siswa kesulitan pada soal ini.
                                    @else
                                        Mantap!
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </table>
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>{{ __('label.score_graph') }}</strong></h2>
                                </div>
                                <div class="body">
                                    <canvas id="correctAnswersChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script src="{{asset('js/jquery.table2excel.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#btnExportStudentResponse").click(function(){
            $("#tableStudentResponse").table2excel({
                name: "{!! __('button-label.student_response_recap') !!} {!! $exam->title !!}",
                filename: "{!! __('button-label.student_response_recap') !!} {!! $exam->title !!}",
                fileext: ".xls"
            }); 
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- CDN untuk Chart.js -->
<script>
    var soalNumbers = [];
    for (let i = 1; i <= {{ count($correctAnswerCounts) }}; i++) {
        soalNumbers.push('Soal ' + i);
    }

    var correctAnswers = @json(array_values($correctAnswerCounts));

    var ctx = document.getElementById('correctAnswersChart').getContext('2d');
    var correctAnswersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: soalNumbers,
            datasets: [{
                label: 'Jumlah Jawaban Benar',
                data: correctAnswers,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
