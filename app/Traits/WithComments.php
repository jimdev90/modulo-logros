<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Problem;
use App\Models\Suggestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait WithComments
{
    public function getComments(Suggestion $model): Collection
    {
        return Comment::tree()
            ->whereMorphRelation('commentable', get_class($model), 'id', '=', $model->id)
            ->with('author')
            ->latest()
            ->get()
            ->toTree();
    }

    public function storeComment(Request $request, Suggestion $model): JsonResponse
    {
        $comment = $model->comments()->create([
            'author_id' => auth()->user()->idusuarios,
            'parent_id' => $request->input('parent_id') > 0 ? $request->input('parent_id') : null,
            'content' => clean($request->input('content')),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment created successfully.',
            'comment' => $comment,
        ]);
    }
}
