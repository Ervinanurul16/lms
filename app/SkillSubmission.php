<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SkillSubmission extends Model
{
    protected $fillable = ['skill_id','grade_id','user_id','mark','indikator_1','indikator_2','indikator_3','indikator_4','indikator_5'];

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->format('d F Y H:i');
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        if($updated_at == null)
        {
            return $updated_at;
        }
        return Carbon::parse($updated_at)->format('d F Y H:i');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

        // SkillSubmission.php
    public function learningTopic()
    {
        return $this->hasOneThrough('App\LearningTopic', 'App\Skill', 'id', 'id', 'skill_id', 'learning_topic_id');
    }

}
