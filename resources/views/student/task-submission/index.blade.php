@extends('layouts.master')

@section('title')
    {{ __('section-title.task_submission_data')}}
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="header">
                <h2><strong>{{ __('section-title.task_submission_data')}}</strong></h2>
            </div>
            <div class="body">
                 <!-- Dropdown untuk Filter Mata Pelajaran -->
                 <form method="GET" action="{{ route('student.task-submission.index') }}">
                    <div class="form-group row">
                        <label for="subject_id" class="col-sm-2 col-form-label">Filter Mata Pelajaran</label>
                        <div class="col-sm-4">
                            <select name="subject_id" id="subject_id" class="form-control" onchange="this.form.submit()">
                                <option value="">{{ __('Pilih Mata Pelajaran') }}</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table class="table dataTable text-nowrap">
                        <thead>
                            <tr>
                                <th class="no-sort">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">-</label>
                                    </div>
                                </th>
                                <th>{{ __('label.number')}}</th>
                                <th>{{ __('label.name_task')}}</th>
                                <th>{{ __('label.subject')}}</th>
                                <th>{{ __('label.meeting')}}</th>
                                <th>{{ __('label.submit_time')}}</th>
                                <th>{{ __('label.status')}}</th>
                                <th>{{ __('label.grade')}}</th>
                                @hasrole('Siswa')
                                <th class="no-sort"><i class="zmdi zmdi-settings"></i> {{ __('label.action')}}</th>
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
                                    <td>{{$submission->task->name}}</td>
                                    <td>{{$submission->task->subject->name}}</td>
                                    <td>{{$submission->task->learningTopic->name ?? 'N/A'}}</td>
                                    <td>{{($submission->updated_at != null) ? $submission->updated_at : $submission->created_at}}</td>
                                    <td>
                                        @if($submission->status == 1)
                                            <span class="badge badge-pill badge-success">{{ __('label.on_time')}}</span>
                                        @elseif($submission->status == 2)
                                        <span class="badge badge-pill badge-warning">{{ __('label.late')}}</span>
                                        @else
                                            <span class="badge badge-pill badge-secondary">{{ __('label.not_submit_yet')}}</span>
                                        @endif
                                    </td>
                                    <td>{{$submission->mark}}</td>
                                    @hasrole('Siswa')
                                    <td>
                                        <a class="text-success" href="{{\LaravelLocalization::localizeURL('tasks/'.$submission->task_id)}}"><i class="zmdi zmdi-eye mr-2"></i>{{ __('label.show')}}</a>
                                    </td>
                                    @endhasrole
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>

                
                
            </div>
        </div>
    </div>
</div>
@if(request('subject_id'))
    <div class="chart-container" style="position: relative; height:80vh; width:160vw">
        <canvas id="subjectChart"></canvas>
    </div>
@else
    <h3 class="text-center">Pilih mata pelajaran untuk melihat grafik</h3>
@endif

@endsection
@section('page-script')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script>
    $(document).ready(function() {
        // Inisiasi DataTables dengan sorting
        $('.dataTable').DataTable({
            "ordering": true, // Mengaktifkan sorting
            "columnDefs": [ 
                {
                    "targets": 'no-sort',
                    "orderable": false,
                } 
            ]
        });

        /*-------------------------------------
            All Checkbox Checked
        -------------------------------------*/
        $(".checkAll").on("click", function () {
            $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    @if(request('subject_id') && isset($chartData))
    console.log(@json($chartData)); // Debug: cetak data chart di console browser
    var ctx = document.getElementById('subjectChart').getContext('2d');
    var subjectChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartData['labels']), // Sumbu X
            datasets: [{
                label: 'Nilai',
                data: @json($chartData['data']), // Sumbu Y
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nilai'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: ''
                    }
                }
            }
        }
    });
    @endif
</script>



@stop