<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
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

    public function gts(Request $request)
    {
        $files=DB::table('files')->where('user_id',Auth::id())->get();
        $trashs=DB::table('trashes')->where('user_id',Auth::id())->get();
        $trashsize =0;
        $myfilessize=0;
        foreach ($files as $file) {
            $myfilessize = $myfilessize + Storage::size(Auth::id().'/files'.'/'.$file->file);
        }
        foreach ($trashs as $trash) {
            $trashsize = $trashsize + Storage::size(Auth::id().'/trash'.'/'.$trash->file);
        }
        $totalsize= bcadd($trashsize , $myfilessize, 3) /1073741824 ;
        
        if($request->ajax())
        {
       
        
            
            return Response($files);
        
         
        }
        
        //return number_format((float)$totalsize, 3, '.', '')."GB"; */
    }
    
}
