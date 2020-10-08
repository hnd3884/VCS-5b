<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChallengeController extends Controller
{
    public function AddChallenge(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $file = $request->file('fileUpload');
        $folder = uniqid();

        $filePath = 'challenges_file/' . $folder;

        $challengename = trim($request->challengename);
        $hint = trim($request->hint);

        $file->move($filePath, $file->getClientOriginalName());

        Challenge::create([
            'challengename' => $challengename,
            'hint' => $hint,
            'folder' => $folder,
        ]);

        return redirect('/challenges');
    }

    public static function GetAllChallenge()
    {
        return DB::table('challenges')->get();
    }

    public function DeleteChallenge(Request $request)
    {
        if (auth()->user()->role === 1) {
            return redirect('accessdenied');
        }

        $chal = Challenge::find($request->challengeid);

        File::deleteDirectory(public_path('challenges_file/' . $chal->folder));
        $chal->forceDelete();

        return redirect('/challenges');
    }

    public function DetailChallenge(Request $request)
    {
        $challenge = Challenge::find($request->chalid);
        $challenge->histories = DB::table('histories')
            ->where('challengeid', '=', $request->chalid)
            ->join('users', 'studentid', '=', 'users.id')
            ->select('histories.*', 'users.fullname')
            ->get();

        return view('detailchallenge', compact('challenge'));
    }

    public function Answer(Request $request)
    {
        $chalid = $request->chalid;
        $answer = $request->answer;

        $chal = Challenge::find($chalid);

        $files = File::files(public_path('challenges_file/' . $chal->folder));
        $filename =  basename($files[0]);
        if ($answer == substr($filename, 0, strrpos($filename, '.'))) {
            History::create([
                'studentid' => auth()->user()->id,
                'result' => true,
                'challengeid' => $chalid
            ]);

            $filepath = 'challenges_file/' . $chal->folder . '/' . $filename;
            return redirect('/challenges/detail?chalid=' . $chalid)->with('result', 'true')->with('filepath', $filepath);
        } else {
            History::create([
                'studentid' => auth()->user()->id,
                'result' => false,
                'challengeid' => $chalid
            ]);

            return redirect('/challenges/detail?chalid=' . $chalid)->with('result', 'false');
        }
    }
}
