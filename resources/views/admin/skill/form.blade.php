<div class="col-lg-6 col-12 form-group">
    <label>{{ __('label.skill_name') }} <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$skill->name ?? old('name') ?? null}}" required autofocus>
    @error('name')
    <div class="form-grop">
        <span class="text-danger" role="alert">
            {{$message}}
        </span>
    </div>
    @enderror
</div>

<div class="col-lg-6 col-12 form-group">
    <label>{{ __('label.subject')}} <span class="text-danger">*</span></label>
    <select class="form-control" name="subject_id" id="mapelSelectBox">
        <option value="">-- {{ __('label.select') }} --</option>
        @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}" 
                @if((isset($skill) && $skill->subject_id == $subject->id) || old('subject_id') == $subject->id) selected @endif>
                {{ $subject->name }}
            </option>
        @endforeach
    </select>
    @error('subject_id')
    <div class="form-group">
        <span class="text-danger" role="alert">{{ $message }}</span>
    </div>
    @enderror
</div>

<div class="col-lg-6 col-12 form-group">
    <label>{{ __('label.class_name') }} <span class="text-danger">*</span></label>
        <select class="form-control" name="grade_id">
        <option value="">Pilih nama kelas</option>
        @foreach($grades as $grade)
            <option value="{{ $grade->id }}" 
                @if((isset($skill) && $skill->grade_id == $grade->id) || old('grade_id') == $grade->id) selected @endif>
                {{ $grade->name }}
            </option>
        @endforeach
    </select>

</div>

<div class="col-lg-6 col-12 form-group">
    <label>{{ __('label.lesson_hours') }} <span class="text-danger">*</span></label>
    <div class="input-group date">
        <div class="input-group-append">
            <span class="input-group-text"><i class="zmdi zmdi-calendar-alt"></i></span>
        </div>
        <input type="text" class="form-control datetimepicker @error('deadline') is-invalid @enderror" 
            name="deadline" value="{{ $skill->deadline ?? old('deadline') }}" required/>
    </div>
    @error('deadline')
    <div class="form-group">
        <span class="text-danger" role="alert">{{ $message }}</span>
    </div>
    @enderror
</div>
