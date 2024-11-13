@extends('layouts.master')

@section('title')
    {{ __('section-title.skill_data') }}
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
                <h2><strong><i class="zmdi zmdi-assignment-check"></i> {{ __('section-title.skill_data') }}</strong></h2>
            </div>
            <div class="body">
                <!-- Filter Form -->
                <form method="GET" id="filter-form" action="{{ \LaravelLocalization::localizeURL('admin/skills') }}">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <select name="grade" class="form-control" onchange="document.getElementById('filter-form').submit();">
                                <option value="">{{ __('label.select_class') }}</option>
                                @foreach($grades as $id => $name)
                                    <option value="{{ $id }}" {{ request('grade') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="subject" class="form-control" onchange="document.getElementById('filter-form').submit();">
                                <option value="">{{ __('label.select_subject') }}</option>
                                @foreach($subjects as $id => $name)
                                    <option value="{{ $id }}" {{ request('subject') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <br>

                <!-- Table Data -->
                <form action="{{route('skills.batch.delete')}}" method="POST">
                @csrf
                @method('delete')
                    <div class="table-responsive">
                        <table class="table table-hover dataTable c_table theme-color">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkAll">
                                            <label class="form-check-label">-</label>
                                        </div>
                                    </th>
                                    <th>{{ __('label.name') }}</th>
                                    @unlessrole('Siswa')
                                    <th class="no-sort text-right"><i class="zmdi zmdi-settings"></i> {{ __('label.action') }}</th>
                                    @endunlessrole
                                    <th>{{ __('label.lesson_hours') }}</th>
                                    <th>{{ __('label.subject') }}</th>
                                    <th>{{ __('label.class_name') }}</th>
                                    <th>{{ __('label.teacher') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skills as $skill)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" value="{{$skill->id}}" name="skill_id[]" class="form-check-input">
                                                <label class="form-check-label font-weight-bold"></label>
                                            </div>
                                        </td>
                                        <td><a href="{{\LaravelLocalization::localizeURL('admin/skills/'.$skill->id.'/submissions')}}">{{$skill->skill_name}}</a></td>
                                        @unlessrole('Siswa')
                                        <td class="header">
                                            <ul class="header-dropdown">
                                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-left slideUp">
                                                        @hasrole('Pengajar')
                                                        <li>
                                                            <a href="{{\LaravelLocalization::localizeURL('admin/skills/'.$skill->id.'/edit')}}"><i class="zmdi zmdi-edit action-icon"></i>{{ __('label.edit') }}</a>
                                                        </li>
                                                        @endhasrole
                                                        <li>
                                                            <a href="{{\LaravelLocalization::localizeURL('admin/skills/'.$skill->id.'/submissions')}}"><i class="zmdi zmdi-chart action-icon"></i>{{ __('label.skill_report') }}</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                        @endunlessrole
                                        <td>{{$skill->deadline}}</td>
                                        <td>{{$skill->subject}}</td>
                                        <td>{{$skill->grade}}</td>
                                        <td>{{$skill->name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @hasrole("Pengajar")
                            <div class="col-lg-3 col-12 mb-3">
                                <button type="submit" class="btn btn-warning btn-raised waves-effect">{{ __('button-label.batch_delete')}}</button>
                            </div>
                            @endhasrole
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
@push('after-scripts')
<script>
    $(document).ready(function(){
        $('.status-toggle').on('click',function(){

            let status = $(this).attr("aria-pressed")
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
            let skill_id = $(this).data("skill-id")

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                url: '{!! \LaravelLocalization::localizeURL("/") !!}/admin/skills/'+skill_id+'/status/change',
                type: 'patch',
                dataType: 'json',
                data: {
                    status: status,
                },
                success: function(response){
                    $('.alert-danger').slideUp(500)
                    $('.alert-success').slideDown(500).delay(1000).slideUp()
                    $('.alert-success').text(response['message'])
                },
                error: function(response){
                    $('.alert-success').slideUp(500)
                    $('.alert-danger').slideDown(500).delay(1000).slideUp()
                    $('.alert-danger').text("{!! __('messages.skill_status_unchanged') !!}")
                },
            })
        });
    })
</script>
@endpush