<?php


namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    // Отображение главной страницы
    public function index()
    {
        return view('link'); // Загружается форма для ввода URL
    }

    // Сокращение ссылки
    public function shorten(Request $request)
    {
        // Валидация ввода
        $request->validate([
            'url' => 'required|url|max:2048', // Проверяем, что это URL
        ]);

        // Генерация уникального короткого кода
        $shortCode = Str::random(6);

        // Сохраняем в базу данных
        $link = Link::create([
            'original_url' => $request->url,
            'short_code' => $shortCode,
        ]);

        // Возвращаем JSON-ответ
        return response()->json([
            'short_url' => url($shortCode),
        ]);
    }

    // Перенаправление по короткому URL
    public function redirect($shortCode)
    {
        // Находим ссылку по короткому коду
        $link = Link::where('short_code', $shortCode)->first();

        // Если не найдено, показываем 404
        if (!$link) {
            abort(404, 'Link not found');
        }

        // Перенаправляем на оригинальный URL
        return redirect($link->original_url);
    }
}
