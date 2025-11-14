<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metro;
use App\Services\MetroService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MetroController extends Controller
{
    protected $metroService;

    public function __construct(MetroService $metroService)
    {
        $this->metroService = $metroService;
    }


    public function storeMetro(Request $request)
    {
        $validateData = $request->validate([
            'metro_name' => 'required|string|max:255'
        ]);

        try {
            $this->metroService->createMetro($validateData);
            return redirect()->back()->with('success','Metro created successfully');

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function updateMetro(Request $request, $id)
    {
        $updateData = $request->validate([
            'metro_name' => 'nullable|string|max:255'
        ]);

        if (empty($updateData)) {
            return redirect()->back()->with('info', 'O‘zgartirish uchun ma’lumot berilmadi.');
        }

        try {
            $this->metroService->updateMetro((int)$id, $updateData);

            return redirect()->back()->with('success', 'Metro muvaffaqiyatli yangilandi.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Xatolik: Metro topilmadi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Yangilashda xatolik: ' . $e->getMessage());
        }
    }

    public function destroyMetro($id)
    {
        try {
            $this->metroService->destroyMetro((int)$id);
            return redirect()->back()->with('success', 'Metro muvaffaqiyatli o‘chirildi.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Xatolik: Metro topilmadi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'O‘chirishda xatolik: ' . $e->getMessage());
        }
    }
}
