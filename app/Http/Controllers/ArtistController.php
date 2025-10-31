<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Feedback;
use App\Models\Portfolio;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    // Список всех мастеров
    public function index()
    {
        $artists = Artist::with(['user', 'styles', 'user.avatar'])
            ->active()
            ->get();

        return view('artists.index', compact('artists'));
    }

    // Страница мастера
    public function show($id)
    {
        $artist = Artist::with([
            'user',
            'styles',
            'portfolios',
            'prices.service',
            'user.avatar',
//            'feedbacks.user.avatar'
        ])->findOrFail($id);

        $services = Service::all();
        $positiveFeedbacks = $artist->feedbacks->where('rating_positive', true);
        $negativeFeedbacks = $artist->feedbacks->where('rating_positive', false);

        return view('artists.show', compact('artist', 'services', 'positiveFeedbacks', 'negativeFeedbacks'));

        // Загружаем отзывы отдельно
        $positiveFeedbacks = collect([]);
        $negativeFeedbacks = collect([]);

        try {
            // Загружаем отзывы отдельным запросом
            $feedbacks = \App\Models\Feedback::with('user.avatar')
                ->where('artist_id', $artist->id)
                ->get();

            $positiveFeedbacks = $feedbacks->where('rating_positive', true);
            $negativeFeedbacks = $feedbacks->where('rating_positive', false);

        } catch (\Exception $e) {
            \Log::error('Error loading feedbacks: ' . $e->getMessage());
        }

        $services = Service::all();

        return view('artists.show', compact('artist', 'services', 'positiveFeedbacks', 'negativeFeedbacks'));
    }


    // Добавление отзыва
    public function storeFeedback(Request $request, $artistId)
    {
        $validator = Validator::make($request->all(), [
            'rating_positive' => 'required|boolean',
            'comment' => 'required|string|min:10|max:1000',
        ], [
                'comment.required' => 'Напишите текст отзыва',
                'comment.min' => 'Отзыв должен содержать не менее :min символов',
                'comment.max' => 'Отзыв должен содержать не более :max символов',
                'rating_positive.required' => 'Выберите тип отзыва',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Проверяем, не оставлял ли пользователь уже отзыв этому мастеру
        $existingFeedback = Feedback::where('user_id', Auth::id())
            ->where('artist_id', $artistId)
            ->first();

        if ($existingFeedback) {
            return redirect()->back()
                ->with('error', 'Вы уже оставляли отзыв этому мастеру');
        }

        try {
            Feedback::create([
                'user_id' => Auth::id(),
                'artist_id' => $artistId,
                'rating_positive' => $request->rating_positive,
                'comment' => $request->comment,
            ]);

            return redirect()->back()->with('success', 'Отзыв успешно добавлен!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ошибка при добавлении отзыва: ' . $e->getMessage());
        }
    }
}
