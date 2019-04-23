<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizContent;
use App\Classes\PreventDoubleQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;

class QuizController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $path = storage_path() . '/json/geography.json';
        $json = json_decode(file_get_contents($path), true);

        try {
            foreach ($json as $key => $value)
            {
                $insertArr[$key] = $value;
            }
            $quizContent = new QuizContent();
            if ($quizContent->getAllResults()->count() === 0) {
                DB::table('quiz_content')->insert($insertArr[$key]);
            }

        } catch (\Exception $e) {
            $request->session()->flash('error', 'Problem to save data: ' . $e->getMessage());
        }
        $quiz = new Quiz();
        if ($quiz->getAllResults()->count() > Quiz::LIMIT_ROWS_BEFORE_DIRECT) {
            return redirect('/application/quiz/result');
        }

        $getAllResults = $quizContent->getAllResults();
        $firstId = $getAllResults[0]->id;
        $secondId = $getAllResults[1]->id;

        $ids = $quizContent->getResultById($secondId);
        $fields = $quizContent->getResultById($firstId);
        $quantityResults = $quizContent->getAllResults()->count();
        return view('application.quiz', ['fields' => $fields, 'ids' => $ids, 'quantityResults' => $quantityResults]);
    }

    public function run(Request $request)
    {
        $id = $request->route('id');
        $quiz = new Quiz();
        $quizContent = new QuizContent();
        $PreventDoubleQuestions = new PreventDoubleQuestions();
        $getAllRecordsFromQuiz = $quiz->getAllResults();
        $quantityRowsFromQuiz = count($getAllRecordsFromQuiz);

        $getAllRecordsFromQuizContent = $quizContent->getAllResults();
        $quantityRowsFromQuestions = count($getAllRecordsFromQuizContent);
        $currentIncrementId = 0;

        if ($request->isMethod('post') || $request->isMethod('get')) {
            $validator = Validator::make($request->all(), [
                'answer' => 'required',
            ]);

            if ($validator->fails()) {
                $request->session()->flash('checked_error', 'Not checked checkbox');
                $fields = $quizContent->getResultById($id);
                return view('application.quiz_run', ['fields' => $fields, 'ids' => DB::table('quiz_content')->select('id')->whereId($id)->get()]);
            }

            if ($PreventDoubleQuestions->guard() == true) {
                $PreventDoubleQuestions->deleteByDouble();
            }

            if ($request->input('next-btn')) {

                $currentIncrementId++;
                $id += (int)$currentIncrementId;
                $nextId = ($id == $quantityRowsFromQuestions + 1) ? 0 : $id;
                $nextQuestion = (!$validator->fails()) ? $id : - 1;
                $ids = $quizContent->getResultById($nextId);
                $arrayField[] = $quizContent->getResultById($nextQuestion -1);
                $field = $quizContent->getField($arrayField);
                $checkbox = ($request->has('answer')) ? implode(" ", $request->input('answer')) : null;
                $divideLength = preg_match('/no/', $checkbox) ? Quiz::LENGTH_FOR_NO : Quiz::LENGTH_FOR_YES;

                DB::table('quiz')->insert([
                    'user_id' => Auth::user()->id,
                    'result' => substr($checkbox, strlen($checkbox) - $divideLength, strlen($checkbox)),
                    'question_number' => $field['field']->id - 1,
                    'created_at' => $quiz->getCreatedAtAttribute(),
                    'updated_at' => null,
                ]);

                $quantityResults = $quizContent->getAllResults()->count();
                return ($quantityRowsFromQuiz < Quiz::LIMIT_ROWS_BEFORE_DIRECT) ? view('application.quiz_run', ['fields' => $field, 'ids' => $ids, 'quantityResults' => $quantityResults])
                                                                                : redirect('/application/quiz/result');
            }
        }
    }

    public function result()
    {
        $quiz = new Quiz();
        $quizContent = new QuizContent();
        $results = $quiz->getAllResults();
        $countTrueResults = count($quiz->getByString(Quiz::YES_VALUE));
        $resultToPercent = $quiz->resultToPercent();
        $quantityResults = $quizContent->getAllResults()->count();

        if ($results->count() < ($quantityResults - 1)) {
            return redirect('/application/quiz');
        }
        return view('application.quiz_result', ['results' => $results, 'countTrueResults' => $countTrueResults, 'resultToPercent' => $resultToPercent]);
    }

    public function destroy()
    {
        $quiz = new Quiz();
        $quiz->deleteAll();
        return redirect('/application/quiz');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/application');
    }
}
