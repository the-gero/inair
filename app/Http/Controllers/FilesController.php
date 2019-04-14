<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Files;
use App\Trash;
use App\Shared;
use DB;
use File;
use Storage;
use Response;
class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $files = Files::orderBy('created_at','desc')->where('user_id',Auth::id())->paginate(10);
        $filess=DB::table('files')->where('user_id',Auth::id())->get();
        $trashs=DB::table('trashes')->where('user_id',Auth::id())->get();
        $trashsize =0;
        $myfilessize=0;
        foreach ($filess as $file) {
            $myfilessize = $myfilessize + Storage::size(Auth::id().'/files'.'/'.$file->file);
        }
        foreach ($trashs as $trash) {
            $trashsize = $trashsize + Storage::size(Auth::id().'/trash'.'/'.$trash->file);
        }
        $totalsize= bcadd($trashsize , $myfilessize, 3) /1073741824 ;
        
        return view('files.myfiles')->with('files',$files)->with('totalsize',number_format((float)$totalsize, 3, '.', '')."GB");                                                                                                           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files = Files::orderBy('created_at','desc')->where('user_id',Auth::id())->paginate(10);

        return view('files.upload');
    }
    public function swm()
    {
        $files = Shared::orderBy('created_at','desc')->where('shared_with_id',Auth::id())->paginate(10);
        return view('files.sharedwithme')->with('files',$files);         
    }
    public function getDownload($id)
    {   
        $file = Files::find($id);
        $currentuser = Auth::id();
        $file_name = $file->file;
        $user_id=$file->user_id;
        $path = storage_path().'\\app'."\\".$user_id.'\\files'.'\\'.$file_name;
        $shareds = Shared::where('file_name',$file_name)->where('owner',$user_id)->get();
        if($user_id == Auth::id() )
            {
                    if (file_exists($path) ) 
                    {
                        return Response::download($path);
                    }
            }
        foreach ($shareds as $shared) 
        {    
        
            
            if( $shared->shared_with == Auth::id() ) { 
                
                if (file_exists($path) ) 
                {
                    
                    return Response::download($path);
                }
            }
            
        }
                return redirect('/')->with('error',"Access Denied");
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs(''.Auth::id().'/files', $fileNameToStore);
            $savefle = new Files;
            $savefle->user_id = Auth::id();
            $savefle->file = $fileNameToStore;
            $savefle->type = $extension;
            $savefle->save();
            return back()->with('success', 'Uploaded');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('files.manage');
    }
    
    public function manage()
    {
        $files = Shared::orderBy('created_at','desc')->where('owner_id',Auth::id())->paginate(10);
        return view('files.manage')->with('files',$files);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filename = Trash::find($id);
        $delete = Storage::delete(Auth::id().'/trash'.'/'.$filename->file);
        if(Auth::id() == $filename->user_id)
        {
            $filename->delete();
            return back()->with('success','Deleted permanently');
        }
        
    }
    public function m2t($id)
    {
        $filename = Files::find($id);
        $move = Storage::move(Auth::id().'/files'.'/'.$filename->file,Auth::id().'/trash'.'/'.$filename->file);
        if(Auth::id()==$filename->user_id && Storage::exists(Auth::id().'/trash'.'/'.$filename->file))
            {
                $filename->delete();
                $file = new Trash;
                $file->user_id = Auth::id();
                $file->file = $filename->file;
                $file->type = $filename->type;
                $file->save();
                return back()->with('success','Moved to trash');
            }
        return back()->with('error','Access Denied');
    }

    public function m2f($id)
    {
        $filename = Trash::find($id);
        $move = Storage::move(Auth::id().'/trash'.'/'.$filename->file,Auth::id().'/files'.'/'.$filename->file);
        if(Auth::id()==$filename->user_id && Storage::exists(Auth::id().'/files'.'/'.$filename->file))
            {
                $filename->delete();
                $file = new Files;
                $file->user_id = Auth::id();
                $file->file = $filename->file;
                $file->type = $filename->type;
                $file->save();
                return back()->with('success','Moved to My Files');
            }
        return back()->with('error','Access Denied');
    }

    public function trash()
    {
        $trash = Trash::orderBy('created_at','desc')->where('user_id',Auth::id())->paginate(10);
        return view('files.trash')->with('trash',$trash);
    }

    
    public function getPrev($id) {
        $file = Files::find($id);
        $currentuser = Auth::id();
        $file_name = $file->file;
        $user_id=$file->user_id;
        $path = storage_path().'\\app'."\\".$user_id.'\\files'.'\\'.$file_name;
        $shared = Shared::where('file_name',$file_name)->where('owner_id',$user_id)->first();
        
        if($user_id == Auth::id() )
        {
                if (file_exists($path) ) 
                {
                    return Response::file($path);
                }
        }
        else if( Auth::id() == $shared->shared_with ) { 
            
            if (file_exists($path) ) 
            {
                
                return Response::file($path);
            }
        }
        else{
            return redirect('/')->with('error',"Access Denied");
        }
    
        }
}
