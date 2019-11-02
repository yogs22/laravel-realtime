<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Events\FeedbackReceived;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $words = $request('words');

        if (strpos($words, ',') != false) {
            return response()->json([
                'message' => 'Kata tidak ada boleh tanda koma (,)'
            ], 400);
        }

        $words = explode(" ", $words);
        if (count($word) > 3) {
            return response()->json([
                'message' => 'Tidak boleh lebih dari 3 kata'
            ], 400);
        }

        foreach ($words as $key => $word) {
            $this->createOrIncrement($word);
        }

        $data = json_decode($this->getData());
        broadcast(new FeedbackReceived($data));

        return response()->json('ok');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function dashboardData()
    {
        return response()->json($this->getData());
    }

    public function getData()
    {
        $topTen = Feedback::orderBy('count', 'DESC')
            ->get()
            ->take(10);

        return $topTen;
    }

    public function create()
    {
        return view('create');
    }

    public function createOrIncrement()
    {
        $word = strtolower($word);

        $feedback = Feedback::where('word', $word)->first();

        if ($feedback) {
            $feedback->increment('count');
        } else {
            Feedback::create([
                'word' => $word,
                'count' => 1
            ]);
        }
    }
}
