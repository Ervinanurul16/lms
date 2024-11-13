@extends('layouts.master')

@section('title')
    {{ __('section-title.skill_submission_data') }}
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
                <h2>{{ __('label.skill_detail') }} <strong>{{$skill->name}}</strong></h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td><i class="zmdi zmdi-calendar-close mr-2"></i> {{ __('label.lesson_hours') }}</td><td>:</td><td><b>{{$skill->deadline}}</b></td>
                        </tr>
                        <tr>
                            <td><i class="zmdi zmdi-help-outline mr-2"></i> {{ __('label.subject') }}</td><td>:</td><td>{!! $skill->subject->name !!}</td>
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
                        {{ __('section-title.skill_submission_data') }} @if($grade != null) Kelas {{ $grade }} @endif
                    </strong>
                </h2>
                
            </div>
            <div class="body">
                <div class="table-responsive">
                    <form action="{{\LaravelLocalization::localizeURL('admin/skills/submissions')}}" method="POST">
                        @csrf
                        @method('delete')
                        <table class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('label.student_reg_number') }}</th>
                                    <th>{{ __('label.name') }}</th>
                                    <th>{{ __('label.class') }}</th>
                                    <th>{{ __('label.skill_score') }}</th>
                                    @hasrole('Pengajar')
                                    <th class="no-sort text-center"><i class="zmdi zmdi-settings"></i> {{ __('label.action') }}</th>
                                    @endhasrole
                                </tr>
                            </thead>
                            <tbody>
                                @php($no=0)
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td>{{$submission->identity_number}}</td>
                                        <td>{{$submission->name}}</td>
                                        <td>{{$submission->grade}}</td>
                                        <td>{{$submission->mark}}</td>
                                        @hasrole('Pengajar')
                                        <td>
                                            @if($submission->mark == 0)                                                
                                                <a class="text-success" href="{{ \LaravelLocalization::localizeURL('admin/skills/submissions/' . $submission->id . '/' . $skill_id) }}">
                                                    <i class="zmdi zmdi-assignment-check mr-2"></i>{{ __('button-label.grading') }}
                                                </a>
                                            @else
                                                <span class="text-default" style="pointer-events: none; color: gray;">
                                                    <i class="zmdi zmdi-assignment-check mr-2"></i>Nilai sudah diberikan
                                                </span>
                                            @endif
                                        </td>
                                        @endhasrole
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for the chart
    const studentNames = @json($submissions->pluck('name'));
    const studentMarks = @json($submissions->pluck('mark'));

    // Create a bar chart using Chart.js
    const ctx = document.getElementById('scoreChart').getContext('2d');
    const scoreChart = new Chart(ctx, {
        type: 'bar', // Use bar chart
        data: {
            labels: studentNames, // X-axis will show student names
            datasets: [{
                label: 'Nilai', // Label for Y-axis
                data: studentMarks, // Y-axis will show marks
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color of the bars
                borderColor: 'rgba(75, 192, 192, 1)', // Border color of the bars
                borderWidth: 1 // Thickness of the border
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Start Y-axis at 0
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var score = tooltipItem.raw;
                            var category = '';

                            if (score <= 20) {
                                category = '"Anda perlu mulai fokus pada pengembangan keterampilan Anda. Mintalah bantuan dari guru atau teman untuk memahami keterampilan yang sulit. Bergabunglah dengan kelompok belajar atau kegiatan praktis yang dapat membantu Anda belajar dengan cara yang lebih interaktif."';
                            } else if (score >= 21 && score <= 40) {
                                category = '"Anda sudah mulai berusaha, tetapi masih ada banyak hal yang perlu diperbaiki. Perbanyak latihan dan cobalah untuk mengikuti instruksi dengan lebih baik. Jangan ragu untuk bertanya jika ada yang tidak Anda pahami."';
                            }else if (score >= 41 && score <= 60) {
                                category = '"Anda menunjukkan keterampilan dasar yang cukup baik. Untuk meningkatkan lebih lanjut, cobalah untuk berlatih lebih sering dan aktif dalam kelas. Diskusikan dengan teman atau guru tentang cara-cara untuk meningkatkan keterampilan."';
                            }else if (score >= 61 && score <= 80) {
                                category = ': "Bagus! Anda telah menunjukkan keterampilan yang baik. Untuk terus berkembang, cobalah untuk mencari tantangan baru dan terlibat dalam proyek yang lebih kompleks. Pertahankan semangat belajar Anda dan teruslah berlatih."';
                            } else if (score > 80) {
                                category = '"Kinerja Anda sangat mengesankan! Teruslah mencari cara untuk memperdalam keterampilan Anda. Cobalah untuk mengambil proyek yang lebih menantang dan berbagi pengetahuan Anda dengan orang lain."';
                            }

                            return [
                                'Nilai: ' + score,
                                'Note: ' + category
                            ];
                        }
                    }
                }
            }
        }
    });
</script>

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
