<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\convertResult;

class Quiz extends Model
{
    use convertResult;

    const LENGTH_FOR_NO = 2;
    const LENGTH_FOR_YES = 3;
    const LIMIT_ROWS_BEFORE_DIRECT = 20;
    const YES_VALUE = 'yes';

    protected $fillable = [
        'user_id', 'result', 'question_number',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $incrementing = false;

    public function getCreatedAtAttribute()
    {

        return $this->dates['created_at'] = Carbon::now("Europe/Warsaw");
    }

    public function getUpdatedAtAttribute()
    {
        return $this->dates['updated_at'] = Carbon::now("Europe/Warsaw");
    }

    public function getAllResults()
    {
        return DB::table('quiz')->select('*')->get();
    }

    public function getByString($string)
    {
        return DB::select("SELECT * FROM quiz WHERE result = ?", [$string]);
    }

    public function deleteAll()
    {
        return DB::select("DELETE FROM quiz");
    }

    public function resultToPercent()
    {
        $allQuestions = count(self::getAllResults());
        $rightQuestions = count(self::getByString(self::YES_VALUE));
        return $this->ConvertResultToPercent($allQuestions, $rightQuestions);
    }

    public function countDoubleQuestions()
    {
        return DB::select("SELECT
                                       COUNT(*),
                                       question_number
                                 FROM quiz
                                 GROUP BY question_number
                                 HAVING COUNT(question_number) > 1");
    }

    public function selectIdDoubleValues($value)
    {
        return DB::select("SELECT id FROM quiz WHERE question_number = ?", [$value]);
    }

    public function deleteDoubleValue($value)
    {
        return DB::delete("DELETE FROM quiz WHERE id = ?", [$value]);
    }
}
