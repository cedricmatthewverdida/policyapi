<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\APIHelper;
use App\Models\comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = comment::all();
        $response = APIHelper::APIResponse(false,200,'',$comment);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new comment();

        $comment->postid = $request->postid;
        $comment->name = $request->name;
        $comment->body = $request->body;

        try{

            $saveComment = $comment->save();

            if($saveComment){
                $response = APIHelper::APIResponse(false,200,'Success',null);
                return response()->json($response,200);
            }else{
                $response = APIHelper::APIResponse(true,'Failed',null);
                return response()->json($response,400);
            }
            
        }catch(Exception $e){
            $response = APIHelper::APIResponse(true,'Failed known error occured',null);
            return response()->json($response,400);
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

        // $comment = comment::find($id);
        $comment = DB::table('comment')
            ->where('comment.postid', $id)
            ->get();

        // $comment = comment::where('postid','==',$id);

        if(empty($comment)){
            $response = APIHelper::APIResponse(true,200,'Cannot find ',$comment);
            return response()->json($response,200);
        }else{
            $response = APIHelper::APIResponse(false,200,'',$comment);
            return response()->json($response,200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
