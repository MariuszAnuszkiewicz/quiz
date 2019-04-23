<?php

namespace App\Classes;

use App\Quiz;

class PreventDoubleQuestions
{
    public function guard()
    {
        $status = false;
        $quiz = new Quiz();
        if ($quiz->countDoubleQuestions()) {
            $status = true;
        }
        return $status;
    }

    public function deleteByDouble()
    {
        $quiz = new Quiz();
        $doubleQuestionsValues = $quiz->countDoubleQuestions();
        foreach ($doubleQuestionsValues as $value) {
            $selectIdDoubleValues = $quiz->selectIdDoubleValues($value->question_number);
            foreach ($selectIdDoubleValues as $key => $value) {
                $field[$key] = $value->id;
            }
            $quiz->deleteDoubleValue($field[count($field) - 1]);
        }
    }
}