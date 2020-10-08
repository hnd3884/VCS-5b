<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function SendMessage(Request $request)
    {
        Message::create([
            'content' => $request->message,
            'sendid' => auth()->user()->id,
            'receiveid' => $request->receiveid,
            'seen' => false,
            'sendname' => auth()->user()->fullname
        ]);

        return redirect('/detail?userid=' . $request->receiveid)->with('message','Message sent!');
    }

    public static function GetSentMessage($receiveid){
        $messages = DB::table('messages')->where('sendid','=',auth()->user()->id)->where('receiveid','=',$receiveid)->orderByDesc('created_at')->get();

        return $messages;
    }

    public static function GetReceivedMessage(){
        $messages = DB::table('messages')->where('receiveid','=',auth()->user()->id)->orderByDesc('created_at')->get();

        return $messages;
    }

    public function DeleteMessage(Request $request){
        $user = Message::find($request->messid);
        $user->forceDelete();

        return redirect('/detail?userid=' . $request->userid);
    }

    public function EditMessage(Request $request)
    {
        $mess = Message::find($request->messid);

        $mess->content = $request->newmessage;

        $mess->push();

        return redirect('/detail?userid=' . $request->userid);
    }
}
