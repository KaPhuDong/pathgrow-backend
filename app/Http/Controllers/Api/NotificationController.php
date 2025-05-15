<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    protected $repo;

    public function __construct(NotificationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return response()->json($this->repo->getAll());
    }

    public function getByUser($userId)
    {
        return response()->json($this->repo->getByUser($userId));
    }

    public function show($id)
    {
        $notification = $this->repo->getById($id);
        return $notification
            ? response()->json($notification)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'message' => 'required|string',
        ]);

        $notification = $this->repo->create($data);
        return response()->json($notification, 201);
    }

    public function markAsRead($id)
    {
        $updated = $this->repo->markAsRead($id);
        return $updated
            ? response()->json(['message' => 'Marked as read'])
            : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->repo->delete($id);
        return $deleted
            ? response()->json(['message' => 'Deleted'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
