<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Services\CloudinaryService;

class BannerController extends Controller
{
    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

    public function uploadBannerImage(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branch,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $file = $request->file('image');
        $upload = $this->cloudinaryService->uploadImage($file->getRealPath(), 'banner');

        Banner::create([
            'photo' => $upload['url'],
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ]);

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }

    public function deleteBanner($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->public_id) {
            $this->cloudinaryService->deleteImage($banner->public_id);
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Зураг амжилттай устгагдлаа');
    }
}
