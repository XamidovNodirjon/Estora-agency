<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UniversityService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    protected $universityService;

    public function __construct(UniversityService $universityService){
        $this->universityService = $universityService;
    }

    public function storeUniversity(Request $request)
    {
        $validateData = $request->validate([
            'university_name' => 'required|string|max:255'
        ]);

        try {
            $this->universityService->createUniversity($validateData);
            return redirect()->back()->with('success','University created successfully');

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function updateUniversity(Request $request, $id)
    {
        $updateData = $request->validate([
            'university_name' => 'nullable|string|max:255'
        ]);

        if (empty($updateData)) {
            return redirect()->back()->with('info', 'O‘zgartirish uchun ma’lumot berilmadi.');
        }

        try {
            $this->universityService->updateUniversity((int)$id, $updateData);

            return redirect()->back()->with('success', 'University muvaffaqiyatli yangilandi.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Xatolik: University topilmadi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Yangilashda xatolik: ' . $e->getMessage());
        }
    }

    public function destroyUniversity($id)
    {
        try {
            $this->universityService->destroyUniversity((int)$id);
            return redirect()->back()->with('success', 'University muvaffaqiyatli o‘chirildi.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Xatolik: University topilmadi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'O‘chirishda xatolik: ' . $e->getMessage());
        }
    }
}
