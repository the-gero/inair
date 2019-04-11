<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Files;
use App\Trash;
use App\Shared;
use File;
use Storage;
use Response;
class ManageFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addshare(Request $request)
    {
        $sharewithemail = User::where('email',$request->shared_with)->first();
        if($sharewithemail)
            {
                $sharewithID=$sharewithemail->id;
                $sharefle = new Shared;
                $sharefle->owner = Auth::id();
                $sharefle->owner_email = Auth::user()->email;
                $sharefle->shared_with_email = $request->shared_with;
                $sharefle->shared_with = $sharewithID;
                $sharefle->file_id = $request->file_id;
                $sharefle->file_name = $request->file_name;
                $sharefle->save();
                return back()->with('success', 'Shared with '.$request->shared_with);
            }
        else{
            return back()->with('error', 'User with E-Mail : '.$request->shared_with." not found.");
        }
                                                                               
    }
    public function delbyS($id)
    {
        $shareds = Shared::where('file_id',$id)->get();
        foreach($shareds as $shared)
        {
            if($shared->shared_with == Auth::id())
            {
                $shared->delete();
                return back()->with('error','Your Access has been removed ');
            }
        }
    }

    public function delbyO($id)
    {
        $shareds = Shared::where('file_id',$id)->get();
        foreach($shareds as $shared)
        {
            if($shared->owner == Auth::id())
            {
                $shared->delete();
                return back()->with('error','Their Access has been removed ');
            }
        }
    }
}
