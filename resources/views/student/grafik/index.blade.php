@extends('layouts.master')

@section('title')
    {{ __('section-title.evaluation_result_data') }}
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
                <h2><strong>Filter Mata Pelajaran</strong></h2>
            </div>
            <div class="body">
                <table class="table table-borderless">                    
                    @foreach($student as $key => $students)
                    <tr>
                        <td style="width: 25%">{{ __('label.student_name')}}</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 70%"><b>{{$students->name}}</b></td>
                    </tr>
                    <tr>
                        <td>{{ __('label.class_name')}}</td>
                        <td>:</td>
                        <td style="width: 70%"><b>{{$students->grade}}</b></td>
                    </tr>
                    @endforeach
                </table>
                <form method="GET" action="{{ route('student.reports') }}">
                    <div class="form-group row">
                        <label for="subject_id" class="col-sm-2 col-form-label">Pilih Mata Pelajaran</label>
                        <div class="col-sm-4">
                            <select name="subject_id" id="subject_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Mata Pelajaran</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        @if(request('subject_id'))
            <div class="col-lg-12 mt-4">
                <h3>Grafik Nilai Tugas Siswa</h3>
                <canvas id="nilaiSiswaTugasChart"></canvas>
            </div>
            
            <div class="col-lg-12 mt-4">
                <h3>Grafik Nilai Ujian Siswa</h3>
                <canvas id="nilaiSiswaChart"></canvas>
            </div>

            <div class="col-lg-12 mt-4">
                <h3>Grafik Rata-Rata Nilai Keterampilan</h3>
                <canvas id="nilaiSiswaKetrampilanChart"></canvas>
            </div>
        @else
            <div class="col-lg-12 mt-4">
                <p class="alert alert-warning">Silakan pilih mata pelajaran untuk melihat grafik.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Grafik Nilai Tugas -->
<script>
    var taskName = {!! json_encode($taskName) !!};
    var markScores = {!! json_encode($markScores) !!};
    var teacherNotes = {!! json_encode($teacherNotes) !!};

    var ctx = document.getElementById('nilaiSiswaTugasChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: taskName,
            datasets: [{
                label: 'Nilai Tugas',
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

<!-- Grafik Nilai Ujian -->
<script>
    var examName = {!! json_encode($examName) !!};
    var finalScore = {!! json_encode($finalScore) !!};

    var ctx = document.getElementById('nilaiSiswaChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: examName,
            datasets: [{
                label: 'Nilai Ujian',
                data: finalScore,
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
                                category = '"Anda perlu memperhatikan materi pelajaran dengan lebih serius. Cobalah untuk belajar secara teratur dan meminta bantuan guru atau teman jika ada yang tidak dipahami. Pertimbangkan untuk mengikuti kelompok belajar agar bisa lebih memahami konsep yang sulit."';
                            } else if (score >= 2.1 && score <= 4) {
                                category = '"Meskipun Anda sudah mulai berusaha, masih ada banyak hal yang perlu diperbaiki. Usahakan untuk lebih aktif dalam kelas dan bertanya jika ada yang tidak dimengerti. Luangkan waktu tambahan untuk belajar di rumah, dan gunakan sumber belajar tambahan seperti buku atau video pembelajaran."';
                            }else if (score >= 4.1 && score <= 6) {
                                category = '"Anda sudah menunjukkan kemajuan, tetapi masih ada ruang untuk perbaikan. Cobalah untuk memperdalam pemahaman Anda tentang topik yang sulit. Berpartisipasilah lebih aktif dalam diskusi kelas dan berlatih soal-soal latihan untuk meningkatkan pengetahuan Anda."';
                            }else if (score >= 6.1 && score <= 8) {
                                category = '"Bagus! Anda sudah menunjukkan pemahaman yang baik terhadap materi. Untuk meningkatkan lebih lanjut, cobalah untuk menantang diri sendiri dengan mengambil topik yang lebih kompleks dan berdiskusi dengan teman tentang materi yang dipelajari. Pertahankan semangat belajar Anda."';
                            }else if (score > 8.1) {
                                category = '"Kinerja Anda sangat memuaskan! Untuk tetap berada di jalur yang benar, teruslah mengasah pengetahuan Anda dengan membaca lebih banyak dan mengikuti perkembangan terbaru dalam bidang studi Anda. Pertimbangkan untuk membantu teman-teman yang membutuhkan, sehingga Anda juga dapat memperdalam pemahaman Anda."';
                            }

                            return [tooltipItem.dataset.label + ': ' + score, 'Note: ' + category];
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
                label: 'Nilai Keterampilan Siswa',
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

                            return [tooltipItem.dataset.label + ': ' + score, 'Note: ' + category];
                        }
                    }
                }
            }
        }
    });
</script>

@stop
