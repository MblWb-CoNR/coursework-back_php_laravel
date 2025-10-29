<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    // Показать галерею работ (для всех пользователей)
    public function index()
    {
        $works = Portfolio::with('artist.user')
            ->latest()
            ->paginate(12);

        $artists = Artist::with('user')->active()->get();

        return view('portfolio.index', compact('works', 'artists'));
    }

    // Показать работу детально
    public function show($id)
    {
        $work = Portfolio::with('artist.user')->findOrFail($id);
        return view('portfolio.show', compact('work'));
    }

    // Показать форму добавления работы (только для админов)
    public function create()
    {
         if (!Auth::user()->isAdmin()) {
             abort(403);
         }

        \Log::info('Portfolio create method accessed', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->username,
            'is_admin' => Auth::user()->isAdmin()
        ]);

//        $artists = Artist::with('user')->active()->get();
        $artists = Artist::with('user')->where('is_active', true)->get();

        \Log::info('Artists loaded', [
            'count' => $artists->count(),
            'artists' => $artists->pluck('id', 'user.username')
        ]);

        return view('portfolio.create', compact('artists'));
    }

    // Сохранить новую работу
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'artist_id' => 'required|exists:artists,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Сохраняем изображение
            $imagePath = $request->file('image')->store('portfolio', 'public');

            // Создаем запись в портфолио
            Portfolio::create([
                'artist_id' => $request->artist_id,
                'image_path' => $imagePath,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('portfolio.index')->with('success', 'Работа успешно добавлена в портфолио!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ошибка при добавлении работы: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Удалить работу
    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $work = Portfolio::findOrFail($id);

        // Удаляем файл изображения
        if (Storage::disk('public')->exists($work->image_path)) {
            Storage::disk('public')->delete($work->image_path);
        }

        $work->delete();

        return redirect()->route('portfolio.index')->with('success', 'Работа удалена!');
    }

    // Фильтр по мастеру
    public function byArtist($artistId)
    {
        $artist = Artist::with('user')->findOrFail($artistId);
        $works = Portfolio::where('artist_id', $artistId)
            ->with('artist.user')
            ->latest()
            ->paginate(12);

        $artists = Artist::with('user')->active()->get();

        return view('portfolio.index', compact('works', 'artists', 'artist'));
    }
}
