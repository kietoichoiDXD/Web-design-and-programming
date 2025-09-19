<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    private function loadQuizData()
    {
        $filePath = public_path('data/quiz.txt');
        
        if (!file_exists($filePath)) {
            return [];
        }
        
        $content = file_get_contents($filePath);
        $lines = array_filter(array_map('trim', explode("\n", $content)));
        
        $questions = [];
        $currentQuestion = null;
        $questionCounter = 0;
        
        foreach ($lines as $line) {
            if (empty($line)) continue;
            
            // Detect question line
            if (preg_match('/^Câu \d+\./', $line)) {
                // Save previous question if exists
                if ($currentQuestion !== null) {
                    $questions[] = $currentQuestion;
                }
                
                $questionCounter++;
                $currentQuestion = [
                    'id' => $questionCounter,
                    'question' => preg_replace('/^Câu \d+\.\s*/', '', $line),
                    'options' => [],
                    'correct_answer' => ''
                ];
            }
            // Detect answer options (A, B, C, D)
            elseif (preg_match('/^[A-D]\.\s*(.+)/', $line, $matches)) {
                if ($currentQuestion !== null) {
                    $optionLetter = substr($line, 0, 1);
                    $currentQuestion['options'][$optionLetter] = $matches[1];
                }
            }
            // Detect correct answer
            elseif (preg_match('/^ANSWER:\s*([A-D])/', $line, $matches)) {
                if ($currentQuestion !== null) {
                    $currentQuestion['correct_answer'] = $matches[1];
                }
            }
        }
        
        // Add the last question
        if ($currentQuestion !== null) {
            $questions[] = $currentQuestion;
        }
        
        return $questions;
    }
    
    public function index()
    {
        $questions = $this->loadQuizData();
        
        // Reset quiz session
        session()->forget(['quiz_answers', 'quiz_submitted', 'quiz_score']);
        
        return view('quiz.index', compact('questions'));
    }
    
    public function submit(Request $request)
    {
        $questions = $this->loadQuizData();
        $userAnswers = $request->input('answers', []);
        $score = 0;
        $totalQuestions = count($questions);
        $results = [];
        
        foreach ($questions as $question) {
            $questionId = $question['id'];
            $userAnswer = $userAnswers[$questionId] ?? null;
            $correctAnswer = $question['correct_answer'];
            $isCorrect = $userAnswer === $correctAnswer;
            
            if ($isCorrect) {
                $score++;
            }
            
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'is_correct' => $isCorrect
            ];
        }
        
        $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100, 2) : 0;
        
        // Save results to session
        session([
            'quiz_answers' => $userAnswers,
            'quiz_submitted' => true,
            'quiz_score' => $score,
            'quiz_percentage' => $percentage,
            'quiz_results' => $results
        ]);
        
        return redirect()->route('quiz.result');
    }
    
    public function result()
    {
        if (!session('quiz_submitted')) {
            return redirect()->route('quiz.index');
        }
        
        $score = session('quiz_score', 0);
        $percentage = session('quiz_percentage', 0);
        $results = session('quiz_results', []);
        $totalQuestions = count($results);
        
        return view('quiz.result', compact('score', 'percentage', 'results', 'totalQuestions'));
    }
    
    public function restart()
    {
        session()->forget(['quiz_answers', 'quiz_submitted', 'quiz_score', 'quiz_percentage', 'quiz_results']);
        return redirect()->route('quiz.index');
    }
}