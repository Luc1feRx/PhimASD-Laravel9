<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function addComment(CommentRequest $request){
        try {
            $data = $request->all();
            $comment = new Comment();
            $comment->user_id = $data['user_id'];
            $comment->movie_id = $data['movie_id'];
            $comment->content = $data['content'];
            $comment->save();

            return response()->json([
                'message' => 'Bình luận của bạn thêm thành công, chờ Admin phê duyệt'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Message: {$th->getMessage()}. Line: {$th->getLine()}");
        }
    }

    public function index(){
        $comments = Comment::with('user', 'movie')->paginate(10);
        return view('pages.comments.index',[
            'title' => 'Comments List',
            'comments' => $comments
        ]);
    }

    public function ChangeStateToApprove($id){
        $comment = Comment::findOrFail($id);
        $comment->state = 1; // change to approve state
        $comment->save();
        return redirect()->back()->with('status', 'Successfully');   
    }

    public function ChangeStateToRefuse($id){
        $comment = Comment::findOrFail($id);
        $comment->state = 0; // change to refuse state
        $comment->save();
        return redirect()->back()->with('status', 'Successfully');  
    }
}
