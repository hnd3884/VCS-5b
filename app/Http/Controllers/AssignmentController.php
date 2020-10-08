<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function AddAssignment(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $file = $request->file('fileUpload');
        $fileName = uniqid() . "_" . $file->getClientOriginalName();

        $filePath = 'assignments_file';

        $description = trim($request->description);
        $dueto = trim($request->dueto);

        $file->move($filePath, $fileName);

        Assignment::create([
            'description' => $description,
            'dueto' => $dueto,
            'filepath' => $filePath . "/" . $fileName,
            'filename' => $file->getClientOriginalName()
        ]);

        return redirect('/assignments');
    }

    public function ChangeAssignment(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $assign = Assignment::find($request->assignid);
        unlink($assign->filepath);

        $file = $request->file('fileUpload');
        $fileName = uniqid() . "_" . $file->getClientOriginalName();

        $filePath = 'assignments_file';

        $file->move($filePath, $fileName);

        $assign->filepath = $filePath . "/" . $fileName;
        $assign->filename = $file->getClientOriginalName();

        $assign->push();

        return redirect('/detailassignments?assignid=' . $request->assignid);
    }

    public static function GetAllAssignments()
    {
        return DB::table('assignments')->get();
    }

    public function DeleteAssignment(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $assign = Assignment::find($request->assignid);
        $reports = DB::table('reports')->where('assignmentid', '=', $request->assignid)->get('filepath');

        unlink($assign->filepath);
        foreach ($reports as $rp) {
            unlink($rp->filepath);
        }

        DB::table('reports')->where('assignmentid', '=', $request->assignid)->delete();
        $assign->forceDelete();

        return redirect('/assignments');
    }

    public function DetailAssignment(Request $request)
    {
        $assign = Assignment::find($request->assignid);
        if (auth()->user()->role == 2) {
            $assign->listreports = DB::table('reports')
                ->where('assignmentid', '=', $request->assignid)
                ->join('users', 'studentid', '=', 'users.id')
                ->select('reports.*', 'users.fullname')
                ->get();
        } else {
            $assign->listreports = ReportController::GetReportOfLoggedInStudent($request->assignid);
        }

        return view('detailassignment', compact('assign'));
    }
}
