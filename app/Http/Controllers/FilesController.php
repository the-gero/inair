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

        return view('files.myfiles')->with('files',$files);                                                                                                           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.upload');
    }
    public function getDownload($id)
    {   
        $file = Files::find($id);
        $currentuser = Auth::id();
        $file_name = $file->file;
        $user_id=$file->user_id;
        $path = storage_path().'\\app'."\\".$user_id.'\\files'.'\\'.$file_name;
        $shared = Shared::where('file_shared',$file_name)->where('owner',$user_id)->first();
        /* ::where('status' , 0)
     ->where(function($q) {
         $q->where('type', 'private')
           ->orWhere('type', 'public');
     })
     ->get(); */
        if($user_id == Auth::id() )
        {
                if (file_exists($path) ) 
                {
                    return Response::download($path);
                }
        }
        else if( Auth::id() == $shared->shared_with ) { 
            
            if (file_exists($path) ) 
            {
                
                return Response::download($path);
            }
        }
        else{
            return redirect('/')->with('error',"Access Denied");
        }
        
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
        return view('files.manage');
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

    /* public function imgprev(Request $request)
        {
        if($request->ajax())
        {
       
        if($request->search)
        {
            $img = Image::make($request->search);
            return $img->response();
        }
        return Response($img);
        }
        } */
    public function getPrev($id) {
        $file = Files::find($id);
        $currentuser = Auth::id();
        $file_name = $file->file;
        $user_id=$file->user_id;
        $path = storage_path().'\\app'."\\".$user_id.'\\files'.'\\'.$file_name;
        $shared = Shared::where('file_shared',$file_name)->where('owner',$user_id)->first();
        /* ::where('status' , 0)
     ->where(function($q) {
         $q->where('type', 'private')
           ->orWhere('type', 'public');
     })
     ->get(); */
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
