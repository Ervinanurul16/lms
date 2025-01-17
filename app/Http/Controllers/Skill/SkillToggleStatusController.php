<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;

class TaskToggleStatusController extends Controller
{

    public function __invoke(Request $request, Task $skill)
    {
        try {
            $status = !filter_var($request->status, FILTER_VALIDATE_BOOLEAN);
            $skill->update(['status' => $status]);

            $status = ($status == 1) ? __('label.open') : __('label.closed');
        } catch (\Throwable $e) {

            return response()->json(["error" => true, "e" => $e]);

        }

        return response()->json(['success' => true, 'message' => __('messages.skill_status', ['status' => $status])]);
    }
}
