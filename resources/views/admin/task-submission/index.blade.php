@extends('layouts.master')

@section('title')
    {{ __('section-title.task_submission_data') }}
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ __('label.task_detail') }} <strong>{{$task->name}}</strong></h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 25%;"><i class="zmdi zmdi-file-text mr-2"></i> {{ __('label.topic') }}</td><td style="width: 5%;">:</td><td style="width: 70%;"><b>{{$task->learningTopic->name}}</b></td>
                        </tr>
                        <tr>
                            <td><i class="zmdi zmdi-calendar-close mr-2"></i> {{ __('label.deadline') }}</td><td>:</td><td><b>{{$task->deadline}}</b></td>
                        </tr>
                        <tr>
                            <td><i class="zmdi zmdi-help-outline mr-2"></i> {{ __('form-label.instruction') }}</td><td>:</td><td>{!! $task->instruction !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card">
            <div class="header">
                <h2>
                    <strong>
                        {{ __('section-title.task_submission_data') }} @if($grade != null) Kelas {{ $grade }} @endif
                    </strong>
                </h2>
                <ul class="header-dropdown">
                    <!-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ __('label.select_class') }} <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-left slideUp">
                            @foreach($grades as $grade)
                                <li>
                                    <a href="{{\LaravelLocalization::localizeURL('admin/tasks/'.$task->id.'/submissions/'.$grade->id)}}">{{$grade->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li> -->
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <form action="{{\LaravelLocalization::localizeURL('admin/tasks/submissions')}}" method="POST">
                        @csrf
                        @method('delete')
                        <table class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkAll">
                                            <label class="form-check-label">-</label>
                                        </div>
                                    </th>
                                    <th>{{ __('label.student_reg_number') }}</th>
                                    <th>{{ __('label.name') }}</th>
                                    <th>{{ __('label.class') }}</th>
                                    <th>{{ __('label.status') }}</th>
                                    <th class="text-center">{{ __('label.submit_time') }}</th>
                                    <th>{{ __('label.score') }}</th>
                                    @hasrole('Pengajar')
                                    <th class="no-sort text-center"><i class="zmdi zmdi-settings"></i> {{ __('label.action') }}</th>
                                    @endhasrole
                                </tr>
                            </thead>
                            <tbody>
                                @php($no=0)
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" value="{{$submission->id}}" name="submission_id[]" class="form-check-input">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>{{++$no}}</td>
                                        <td>{{$submission->user->name}}</td>
                                        <td>{{$submission->user->grade->name}}</td>
                                        <td>
                                            @if($submission->status == 1)
                                                <span class="badge badge-pill badge-success">{{ __('label.on_time') }}</span>
                                            @elseif($submission->status == 2)
                                                <span class="badge badge-pill badge-warning">{{ __('label.late') }}</span>
                                            @else
                                                <span class="badge badge-pill badge-secondary">{{ __('label.not_submit_yet') }}</span>
                                            @endif
                                        </td>
                                        <td>{{($submission->updated_at != null) ? $submission->updated_at : $submission->created_at}}</td>
                                        <td>{{$submission->mark}}</td>
                                        @hasrole('Pengajar')
                                        <td>
                                            <a class="text-success" href="{{\LaravelLocalization::localizeURL('admin/tasks/submissions/'.$submission->id)}}">
                                                <i class="zmdi zmdi-assignment-check mr-2"></i>{{ __('button-label.grading') }}
                                            </a>
                                        </td>
                                        @endhasrole
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @hasrole('Pengajar')
                        <div class="col-lg-3 col-12 mb-3">
                            <button type="submit" class="btn btn-warning btn-raised waves-effect">{{ __('button-label.batch_delete') }}</button>
                        </div>
                        @endhasrole
                    </form>
                </div>
            </div>
            <!-- Tambahkan Canvas untuk Grafik -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ __('label.score_graph') }}</strong></h2>
                        </div>
                        <div class="body">
                            <canvas id="scoreChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Keterangan di Bawah Grafik -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <h2>CATATAN</h2>
                            <h3>
                                @if($averageScore < 50)
                                    Kurang belajar
                                @elseif($averageScore >= 51 && $averageScore <= 75)
                                    Cukup
                                @elseif($averageScore > 75 && $averageScore <= 100)
                                    Mantap
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            @endsection

            @section('page-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script>
    $('.dataTable').dataTable( {
        "columnDefs": [ {
        "targets": 'no-sort',
        "orderable": false,
        } ]
    });

    $(".checkAll").on("click", function () {
        $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
    });

    // Data nilai, nama siswa, dan catatan guru dari PHP (Laravel)
    var studentNames = @json($studentNames);
    var studentScores = @json($studentScores);
    var teacherNotes = @json($teacherNotes);

    // Script Chart.js untuk menampilkan grafik batang
    var ctx = document.getElementById('scoreChart').getContext('2d');
    var scoreChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: studentNames, // Nama siswa
            datasets: [{
                label: 'Nilai Siswa',
                data: studentScores, // Nilai siswa
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100 // Batas maksimum nilai 100
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = 'Nilai Siswa: ' + context.raw;
                        var note = teacherNotes[context.dataIndex] ? teacherNotes[context.dataIndex] : 'Tidak ada catatan';
                        return [label, 'Catatan: ' + note];
                    }
                }
            }
        }
    }

    });
</script>
@endsection

@section('page-script')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script>
    $('.dataTable').dataTable( {
            "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
        } ]
    } );

    /*-------------------------------------
        All Checkbox Checked
    -------------------------------------*/
    $(".checkAll").on("click", function () {
        $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
    });
</script>


@endsection