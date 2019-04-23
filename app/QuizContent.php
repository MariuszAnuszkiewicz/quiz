<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\getField;

class QuizContent extends Model
{
    use getField;

    protected $fillable = [
        'question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'created_at', 'updated_at',
    ];

    public function getAllResults()
    {
        return DB::table('quiz_content')->select('*')->get();
    }

    public function getResultById($id)
    {
        return $data['result'] = DB::table('quiz_content')->select('*')->whereId($id)->get();
    }
}
