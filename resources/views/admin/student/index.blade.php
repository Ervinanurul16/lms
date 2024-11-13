@extends('layouts.master')
@section('title')
{{ __('section-title.student_data') }}
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')
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
                <h2><strong><i class="zmdi zmdi-accounts"></i> {{ __("label.student") }}</strong></h2>
                @hasrole('Admin')
                <ul class="header-dropdown">
                    <li>
                        <a role="button" class="btn btn-success" href="{{\LaravelLocalization::localizeURL('admin/students/create')}}"><i class="zmdi zmdi-plus text-light"></i> {{ __('label.add') }} {{ __('label.student') }}</a>
                    </li>
                </ul>
                @endhasrole
            </div>
            <div class="body">
                <!-- Dropdown untuk filter kelas -->
                <form action="{{ route('admin.student.index') }}" method="GET" class="mb-3">
                    <div class="form-group">
                        <label for="grade">{{ __('label.class') }}</label>
                        <select name="grade" id="grade" class="form-control" onchange="this.form.submit()">
                            <option value="">{{ __('label.select_class') }}</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade }}" {{ $gradeFilter == $grade ? 'selected' : '' }}>
                                    {{ $grade }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __('label.subject_name') }}</label>
                        <select name="subject" id="subject" class="form-control" onchange="this.form.submit()">
                            <option value="">{{ __('label.select_subject') }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $subjectFilter == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}  <!-- Ganti dengan nama mata pelajaran yang benar -->
                                </option>
                            @endforeach
                        </select>
                    </div>

                </form>

                <div class="table-responsive">
                    <form action="{{route('student.batch.delete')}}" method="POST">
                        @csrf
                        @method('delete')
                        <table class="table table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no=0)
                                @foreach($murid as $key => $student)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" value="{{$student->id}}" name="student_id[]" class="form-check-input">
                                        </div>
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$student->identity_number}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->grade}}</td>
                                    <td>
                                        <a class="text-success" href="{{\LaravelLocalization::localizeURL('admin/students/'.$student->id)}}" title="{{ __('label.detail') }}">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                        @hasrole('Admin')
                                        <a class="text-success" href="{{\LaravelLocalization::localizeURL('admin/students/'.$student->id.'/edit')}}" title="{{ __('label.edit') }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        @endhasrole
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        @hasrole('Admin')
                        <div class="col-lg-3 col-12">
                            <button type="submit" class="btn btn-warning btn-block btn-raised waves-effect">{{ __('button-label.batch_delete') }}</button>
                        </div>
                        @endhasrole
                    </form>

                    <div class="col-lg-12 mt-4">
                        <h3>Grafik Rata-Rata Nilai Tugas</h3>
                        <canvas id="nilaiSiswaTugasChart"></canvas>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <h3>Grafik Rata-Rata Nilai Evaluasi</h3>
                        <canvas id="nilaiSiswaChart"></canvas>
                    </div>
                    

                    <div class="col-lg-12 mt-4">
                        <h3>Grafik Rata-Rata Nilai Ketrampilan</h3>
                        <canvas id="nilaiSiswaKetrampilanChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop
@push('after-scripts')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Grafik Nilai Evaluasi -->
<script>
    var examTitle = {!! json_encode($examTitle) !!};
    var studentScores = {!! json_encode($studentScores) !!};

    var ctx = document.getElementById('nilaiSiswaChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: examTitle,
            datasets: [{
                label: 'Nilai Rata-Rata Ujian',
                data: studentScores,
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
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var score = tooltipItem.raw;
                            var category = '';

                            if (score <= 2) {
                                category = 'Pembelajaran Remedial: Selenggarakan sesi remedial intensif dengan fokus pada materi dasar. Gunakan pendekatan yang lebih menyenangkan, seperti permainan edukatif atau penggunaan multimedia.';
                            } else if (score >= 2.1 && score <= 4.0) {
                                category = 'Pendekatan Kolaboratif: Dorong siswa untuk belajar dalam kelompok kecil. Pembelajaran kolaboratif dapat meningkatkan pemahaman mereka melalui diskusi dan saling membantu.';
                            }else if (score >= 4.1 && score <= 6.0) {
                                category = 'Pengulangan Materi: Lakukan pengulangan materi dengan cara yang bervariasi. Gunakan teknik pengajaran yang berbeda, seperti pembelajaran visual, audio, dan kinestetik.';
                            }else if (score >= 6.1 && score <= 8.0) {
                                category = 'Pengulangan Materi: Lakukan pengulangan materi dengan cara yang bervariasi. Gunakan teknik pengajaran yang berbeda, seperti pembelajaran visual, audio, dan kinestetik.';
                            }else if (score >= 8.1 && score <= 10.0) {
                                category = 'Tantangan dan Kompetisi: Berikan tantangan dan kompetisi yang menstimulasi pemikiran kritis dan analitis, seperti lomba sains, debat, atau proyek penelitian';
                            }

                            return [
                                tooltipItem.dataset.label + ': ' + score,
                                'Note: ' + category
                            ];
                        }
                    }
                }
            }
        }
    });
</script>

<!-- Grafik Nilai Tugas -->
<script>
    var taskName = {!! json_encode($taskName) !!};
    var markScores = {!! json_encode($markScores) !!};

    var ctx = document.getElementById('nilaiSiswaTugasChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: taskName,
            datasets: [{
                label: 'Nilai Rata-Rata Tugas Siswa',
                data: markScores,
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
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var score = tooltipItem.raw;
                            var category = '';

                            if (score <= 60) {
                                category = 'Kurang';
                            } else if (score >= 61 && score <= 75) {
                                category = 'Cukup';
                            } else if (score > 75) {
                                category = 'Bagus';
                            }

                            return [
                                tooltipItem.dataset.label + ': ' + score,
                                'Note: ' + category
                            ];
                        }
                    }
                }
            }
        }
    });
</script>

<!-- Grafik Nilai Keterampilan -->
<script>
    var skillName = {!! json_encode($skillName) !!};
    var skillScores = {!! json_encode($skillScores) !!};

    var ctx = document.getElementById('nilaiSiswaKetrampilanChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: skillName,
            datasets: [{
                label: 'Nilai Rata-Rata Ketrampilan Siswa',
                data: skillScores,
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
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var score = tooltipItem.raw;
                            var category = '';

                            if (score <= 20) {
                                category = 'Siswa menunjukkan keterampilan yang sangat minim atau tidak ada sama sekali.';
                            } else if (score >= 21 && score <= 40) {
                                category = 'Siswa menunjukkan keterampilan yang kurang memadai.';
                            }else if (score >= 41 && score <= 60) {
                                category = 'Siswa memiliki keterampilan dasar yang cukup.';
                            }else if (score >= 61 && score <= 80) {
                                category = 'Siswa menunjukkan keterampilan yang baik dan konsisten';
                            }else if (score >= 81 && score <= 100) {
                                category = 'Siswa menunjukkan keterampilan yang sangat baik dan luar biasa.';
                            }

                            return [
                                tooltipItem.dataset.label + ': ' + score,
                                'Note: ' + category
                            ];
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    $('.dataTable').dataTable( {
        "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
        } ]
    });

    /*-------------------------------------
        All Checkbox Checked
    -------------------------------------*/
    $(".checkAll").on("click", function () {
        $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
    });
</script>
@endpush
