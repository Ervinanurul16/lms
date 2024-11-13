@extends('layouts.master')

@section('title')
    {{ __('section-title.skill_submission_show') }}
@endsection

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
                <h2>{{ __('label.skill_grading') }}</h2>
                <ul class="header-dropdown">
                    <li>
                        <a role="button" href="{{ \LaravelLocalization::localizeURL('admin/skills/' . $skill_id . '/submissions') }}"><i class="zmdi zmdi-arrow-left"></i> {{ __('button-label.back') }}</a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div>
                    <table class="table table-borderless" style="table-layout: fixed;">
                        <tr>
                            <td class="w-3p"><i class="zmdi zmdi-account"></i></td>
                            <td class="w-15p">{{ __('label.student_name') }}</td>
                            <td class="font-weight-bold">{{$submission->user}}</td>
                        </tr>
                        <tr>
                            <td class="w-3p"><i class="zmdi zmdi-badge-check"></i></td>
                            <td class="w-15p">{{ __('label.class_name') }}</td>
                            <td class="font-weight-bold">{{$submission->grade}}</td>
                        </tr>
                        <tr>
                            <td class="w-3p"><i class="zmdi zmdi-badge-check"></i></td>
                            <td class="w-15p">{{ __('label.subject') }}</td>
                            <td class="font-weight-bold">{{$subjects->subject_name}}</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-5">
                    <h3>{{ __('label.skill_grading_form') }}</h3>
                </div>
                <hr>
                <form action="{{\LaravelLocalization::localizeURL('admin/skills/submissions')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="row clearfix">
                        <div class="col-lg-12 col-12 form-group">
                            <label style="font-size: 25px;">Indikator: Persepsi - Mempersiapkan diri (Kepatuhan Terhadap Waktu Masuk Kelas)</label>
                            <input type="hidden" name="user_id" value="{{$submission->user_id}}">
                            <input type="hidden" name="grade_id" value="{{$submission->grade_id}}">
                            <input type="hidden" name="skill_id" value="{{$skill_id}}">
                            <br>
                            <div style="display: block;">
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="1" name="indikator_1" class="form-check-input"> Siswa hampir selalu terlambat ke kelas dan sering kali tidak hadir pada waktu yang tepat
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="2" name="indikator_1" class="form-check-input"> Siswa sering terlambat ke kelas dan jarang tiba tepat waktu
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="3" name="indikator_1" class="form-check-input"> Siswa sering kali tiba di kelas tepat waktu tetapi sering mengalami keterlambatan yang cukup signifikan
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="4" name="indikator_1" class="form-check-input"> Siswa hampir selalu tiba tepat waktu, dengan beberapa keterlambatan minor yang jarang terjadi
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="5" name="indikator_1" class="form-check-input"> Siswa selalu tiba tepat waktu atau lebih awal untuk setiap kelas tanpa keterlambatan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-12 form-group">
                            <label style="font-size: 25px;">Indikator: Kesiapan – memulai pembelajaran (Penilaian Kesiapan Siswa dalam Belajar)</label>
                            <br>
                            <div style="display: block;">
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="1" name="indikator_2" class="form-check-input"> Siswa tidak pernah atau jarang sekali siap dengan bahan belajar dan tugas
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="2" name="indikator_2" class="form-check-input"> Siswa sering kali tidak siap dengan bahan belajar atau tugas yang belum dikerjakan
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="3" name="indikator_2" class="form-check-input"> Siswa terkadang lupa membawa bahan belajar atau tugas yang diperlukan
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="4" name="indikator_2" class="form-check-input"> Siswa biasanya siap dengan bahan belajar dan tugas, meskipun terkadang ada kekurangan
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="5" name="indikator_2" class="form-check-input"> Siswa selalu siap dengan bahan belajar, seperti buku, alat tulis, dan tugas yang telah dikerjakan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-12 form-group">
                            <label style="font-size: 25px;">Indikator: Kesiapan – memperlihatkan (Penilaian Kesiapan Siswa dalam Belajar)</label>
                            <br>
                            <div style="display: block;">
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="1" name="indikator_3" class="form-check-input"> Siswa menunjukkan motivasi yang sangat rendah dan tidak terlibat dalam kegiatan belajar
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="2" name="indikator_3" class="form-check-input"> Siswa menunjukkan motivasi yang rendah dan jarang terlibat aktif dalam kegiatan belajar
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="3" name="indikator_3" class="form-check-input"> Siswa menunjukkan motivasi yang sedang-sedang saja dalam belajar dan hanya kadang-kadang terlibat akti	
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="4" name="indikator_3" class="form-check-input"> Siswa menunjukkan motivasi yang baik dalam belajar dan terlibat aktif dalam kegiatan belajar
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="5" name="indikator_3" class="form-check-input"> Siswa menunjukkan antusiasme tinggi dan motivasi kuat dalam belajar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-12 form-group">
                            <label style="font-size: 25px;">Indikator: Reaksi yang diarahkan – mengikuti (Partisipasi di Kelas)</label>
                            <br>
                            <div style="display: block;">
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="1" name="indikator_4" class="form-check-input"> Siswa hampir tidak pernah berpartisipasi dalam kelas dan tidak berkontribusi dalam diskusi atau aktivitas
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="2" name="indikator_4" class="form-check-input"> Siswa jarang berpartisipasi dalam kelas dan biasanya hanya berkontribusi sedikit dalam diskusi atau aktivitas.
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="3" name="indikator_4" class="form-check-input"> Siswa berpartisipasi dalam kelas tetapi tidak secara konsisten, dan kadang-kadang kurang aktif dalam diskusi atau aktivitas	
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="4" name="indikator_4" class="form-check-input"> Siswa aktif berpartisipasi dalam kelas sebagian besar waktu, meskipun mungkin tidak selalu konsisten dalam kontribusinya
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="5" name="indikator_4" class="form-check-input"> Siswa selalu aktif berpartisipasi dalam kelas, mengikuti diskusi, dan berkontribusi secara konsisten dalam aktivitas kelas
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-12 form-group">
                            <label style="font-size: 25px;">Indikator: Reaksi yang diarahkan – Mempraktekan (Partisipasi di kelas)</label>
                            <br>
                            <div style="display: block;">
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="1" name="indikator_5" class="form-check-input"> Tidak mampu menginterpretasikan instruksi atau demonstrasi dengan benar dan sering kali bingung
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="2" name="indikator_5" class="form-check-input"> Siswa menunjukkan kesalahan dalam menginterpretasikan instruksi atau demonstrasi dan sering memerlukan bantuan
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="3" name="indikator_5" class="form-check-input"> Siswa membutuhkan arahan lebih lanjut untuk menginterpretasikan instruksi atau demonstrasi dengan benar
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="4" name="indikator_5" class="form-check-input"> Siswa cukup baik dalam menginterpretasikan instruksi atau demonstrasi dan biasanya dapat mencontohkan dengan benar	
                                </div>
                                <div class="form-check" style="font-size: 18px;">
                                    <input type="radio" value="5" name="indikator_5" class="form-check-input"> Siswa menunjukkan kemampuan interpretasi yang tinggi terhadap instruksi, petunjuk, atau demonstrasi guru, dan dapat mereplikasi atau mencontohkan dengan sangat tepat
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-group text-right mg-t-8">
                        <button type="submit" class="btn btn-primary btn-raised btn-round waves-effect">{{ __('button-label.save') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection