<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AchievementController extends Controller
{

    public function getAchievementsByUserId($userId)
    {
        $achievements = Achievement::where('student_id', $userId)->get();

        return response()->json([
            'message' => 'Achievements fetched successfully.',
            'achievements' => $achievements
        ]);
    }

    // GET /api/achievements
    public function index()
    {
        $achievements = Achievement::where('student_id', Auth::id())->get();

        return response()->json([
            'message' => 'Achievements fetched successfully.',
            'achievements' => $achievements
        ]);
    }

    // POST /api/achievements
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [];

        if ($request->hasFile('image')) {
            $uploadResult = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'achievements',
                    'public_id' => 'achievement_' . time(),
                    'transformation' => [
                        'quality' => 'auto:eco',
                        'fetch_format' => 'auto',
                        'width' => 800,
                        'crop' => 'limit'
                    ]
                ]
            );

            $data['image_url'] = $uploadResult['secure_url'];
            $data['image_public_id'] = $uploadResult['public_id'];
        }

        $achievement = Achievement::create([
            'student_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $data['image_url'] ?? null,
            'image_public_id' => $data['image_public_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'Achievement created successfully!',
            'achievement' => $achievement
        ], 201);
    }

    // PUT /api/achievements/{id}
    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        if ($achievement->student_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Nếu có ảnh mới thì upload lên Cloudinary
        if ($request->hasFile('image')) {
            // Xoá ảnh cũ nếu có
            // if ($achievement->image_public_id) {
            //     Cloudinary::destroy($achievement->image_public_id);
            // }

            $uploadResult = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'achievements',
                    'public_id' => 'achievement_' . time(),
                    'transformation' => [
                        'quality' => 'auto:eco',
                        'fetch_format' => 'auto',
                        'width' => 800,
                        'crop' => 'limit'
                    ]
                ]
            );

            $data['image_url'] = $uploadResult['secure_url'];
            $data['image_public_id'] = $uploadResult['public_id'];
        }

        $achievement->update($data);

        return response()->json([
            'message' => 'Achievement updated successfully!',
            'achievement' => $achievement
        ]);
    }

    public function destroy($id)
    {
        $achievement = Achievement::where('id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if (!$achievement) {
            return response()->json(['message' => 'Unauthorized or not found'], 403);
        }

        if (!empty($achievement->image_public_id)) {
            Cloudinary::uploadApi()->destroy($achievement->image_public_id);
        }

        $achievement->delete();

        return response()->json(['message' => 'Achievement deleted successfully.']);
    }


}
