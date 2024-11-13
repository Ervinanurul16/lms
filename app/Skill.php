<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Skill extends Model
{
    protected $fillable = ['name','deadline','status','grade_id','user_id','subject_id'];

    protected $dates = ['deadline'];

    public function setDeadlineAttribute($deadline)
    {
        $this->attributes['deadline'] = Carbon::createFromFormat('l d F Y - H:i', $deadline);
    }

    public function getDeadlineAttribute($deadline)
    {
        return Carbon::parse($deadline)->format('l d F Y - H:i');
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->format('d F Y');
    }

    public function learningTopic()
    {
        return $this->belongsTo('App\LearningTopic');
    }

    public function skillSubmissions()
    {
        return $this->hasMany('App\SkillSubmission');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }
}
