<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentSaveRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(){
        return view('comment.create');
    }

    public function store(CommentSaveRequest $request){
        try {
            $data = $request->validated();
            
            Comment::create(
                [
                    'content' => $data['content'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'user_id' => $request->user()->id ?? null,
                ]
            );

            return redirect()->route('comment.create')->with([
                'status' => 'success',
                'message' => 'Gracias, tu comentario ha sido enviado'
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('comment.create')->with([
                'status' => 'danger',
                'message' => 'No se pudo guardar la información, por favor intente de nuevo'
            ]);
        }
    }
}
