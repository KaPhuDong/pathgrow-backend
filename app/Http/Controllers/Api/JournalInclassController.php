<?php
namespace App\Http\Controllers\Api;

use App\Services\JournalInclassService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JournalInclassController extends Controller
{
    protected $service;

    public function __construct(JournalInclassService $service)
    {
        $this->service = $service;
    }

    // Lấy tất cả các mục hoặc theo journal_id
    public function index(Request $request)
    {
        // Kiểm tra xem có tham số journal_id trong query string không
        $journalId = $request->query('journal_id');

        // Nếu có journal_id, gọi phương thức getList
        if ($journalId) {
            return response()->json($this->service->getList($journalId));
        }

        // Nếu không có journal_id, gọi phương thức getAll
        return response()->json($this->service->getAll());
    }

    // Tạo mới một mục
    public function store(Request $request)
    {
        $data = $request->all();

        // Nếu cần, có thể thêm kiểm tra validation ở đây
        return response()->json($this->service->create($data));
    }

    // Cập nhật một mục
    public function update(Request $request, $id)
    {
        $data = $request->all();

        // Kiểm tra và gọi phương thức update
        return response()->json($this->service->update($id, $data));
    }

    // Xóa một mục
    public function delete($id)
    {
        return response()->json($this->service->delete($id));
    }
}
