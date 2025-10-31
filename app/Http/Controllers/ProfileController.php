<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Avatar;
use App\Models\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user->load(['profile.messenger', 'avatar']);
        $messengers = Messenger::all();

        return view('profile.show', compact('user', 'messengers'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'messenger_id' => 'nullable|exists:messengers,id',
            'messenger_contact_url' => 'nullable|url',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
                'phone_number.regex' => 'Введите корректный номер телефона. Пример: +7-999-888-77-66',
                'avatar.image' => 'Файл должен быть изображением',
                'avatar.mimes' => 'Допустимые форматы изображений: jpeg, png, jpg, gif, webp',
                'avatar.max' => 'Максимальный размер файла: 5 МБ',
            ]);

        if ($validator->fails()) {
            \Log::info('Validation failed', ['errors' => $validator->errors()->toArray()]);
            return redirect()->route('profile')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Обновляем основную информацию пользователя
            $user->update([
                'username' => $request->username,
            ]);

            // Обновляем или создаем профиль
            $profileData = [
                'phone_number' => $request->phone_number,
                'messenger_id' => $request->messenger_id,
                'messenger_contact_url' => $request->messenger_contact_url,
            ];

            if ($user->profile) {
                $user->profile->update($profileData);
            } else {
                $profileData['user_id'] = $user->id;
                UserProfile::create($profileData);
            }

            // Обработка аватарки
            if ($request->hasFile('avatar')) {
                \Log::info('Starting avatar processing...');
                $avatarPath = $this->handleAvatar($user, $request->file('avatar'));
                \Log::info('Avatar processed, path: ' . $avatarPath);


            }

            return redirect()->route('profile')->with('success', 'Профиль успешно обновлен!');

        } catch (\Exception $e) {
            \Log::error('Avatar upload error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->route('profile')
                ->with('error', 'Ошибка при обновлении профиля: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function handleAvatar($user, $avatarFile)
    {
        try {
            \Log::info('handleAvatar method started for user: ' . $user->id);

            // Удаляем старую аватарку если есть
            $oldAvatar = Avatar::where('user_id', $user->id)->first();
            if ($oldAvatar) {
                \Log::info('Found old avatar, deleting...', ['id' => $oldAvatar->id]);
                if (Storage::disk('public')->exists($oldAvatar->file_path)) {
                    Storage::disk('public')->delete($oldAvatar->file_path);
                }
                $oldAvatar->delete();
                \Log::info('Old avatar deleted');
            }

            // Генерируем уникальное имя файла
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $avatarFile->getClientOriginalExtension();
            \Log::info('Generated filename: ' . $filename);

            // Сохраняем файл
            $avatarPath = $avatarFile->storeAs('avatars', $filename, 'public');
            \Log::info('File stored at: ' . $avatarPath);

            // Проверяем, что файл сохранился
            if (!Storage::disk('public')->exists($avatarPath)) {
                throw new \Exception('File was not saved to storage');
            }

            // Создаем запись в базе данных
            \Log::info('Creating avatar record in database...');
            $avatar = Avatar::create([
                'user_id' => $user->id,
                'file_path' => $avatarPath,
            ]);

            \Log::info('Avatar record created:', [
                'id' => $avatar->id,
                'user_id' => $avatar->user_id,
                'file_path' => $avatar->file_path
            ]);

            // Проверяем связь
            $user->load('avatar');

            return $avatarPath;

        } catch (\Exception $e) {
            \Log::error('Error in handleAvatar: ' . $e->getMessage());
            throw $e;
        }
    }
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            // Удаляем файл с сервера
            if (Storage::exists('public/' . $user->avatar->file_path)) {
                Storage::delete('public/' . $user->avatar->file_path);
            }

            // Удаляем запись из базы
            $user->avatar->delete();

            return redirect()->route('profile')->with('success', 'Аватарка удалена!');
        }

        return redirect()->route('profile')->with('error', 'Аватарка не найдена');
    }

}
