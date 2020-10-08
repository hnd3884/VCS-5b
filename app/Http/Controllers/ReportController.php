<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function AddReport(Request $request)
    {

        $file = $request->file('fileUpload');
        $fileName = uniqid() . "_" . $file->getClientOriginalName();

        $filePath = 'assignments_file';

        $file->move($filePath, $fileName);

        Report::create([
            'filepath' => $filePath . "/" . $fileName,
            'filename' => $file->getClientOriginalName(),
            'assignmentid' => $request->assignid,
            'studentid' => auth()->user()->id
        ]);

        return redirect('/detailassignments?assignid=' . $request->assignid);
    }

    public function ChangeReport(Request $request)
    {
        $rp = Report::find($request->reportid);
        unlink($rp->filepath);

        $file = $request->file('fileUpload');
        $fileName = uniqid() . "_" . $file->getClientOriginalName();

        $filePath = 'assignments_file';

        $file->move($filePath, $fileName);

        $rp->filepath = $filePath . "/" . $fileName;
        $rp->filename = $file->getClientOriginalName();

        $rp->push();

        return redirect('/detailassignments?assignid=' . $rp->assignmentid);
    }

    public static function GetReportOfLoggedInStudent($assignid)
    {
        return DB::table('reports')->where('studentid', '=', auth()->user()->id)->where('assignmentid', '=', $assignid)->get();
    }
}
