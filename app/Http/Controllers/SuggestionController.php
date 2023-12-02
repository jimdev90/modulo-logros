<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Suggestion;
use App\Traits\WithComments;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SuggestionController extends Controller
{
    use WithComments;

    public function index()
    {
        $suggestions = Suggestion::paginate(10);
        return view('suggestions.index', compact('suggestions'));
    }

    public function create()
    {
        return view('suggestions.create');
    }

    public function show(int $id): View
    {
        $suggestion = Suggestion::query()
            ->withCount('comments')
            ->findOrFail($id);
        $comments = $this->getComments($suggestion);
        $editorId = 'suggestion-editor';
        $route = route('suggestions.comment.store', ['id' => $suggestion->id]);

        return view('suggestions.suggestion', compact('suggestion', 'route', 'comments', 'editorId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        Suggestion::create([
            'title' => $request->input('title'),
            'content' => clean( $request->input('content')),
            'author_id' => auth()->user()->idusuarios,
            'slug' => Str::slug($request->input('title')),
        ]);

        return redirect()->route('suggestions.index');

    }

    public function edit(Suggestion $suggestion)
    {
        return view('suggestions.edit', compact('suggestion'));
    }

    public function update(Request $request, Suggestion $suggestion)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        $suggestion->title = $request->input('title');
        $suggestion->content = clean( $request->input('content'));
        $suggestion->slug = Str::slug($request->input('title'));
        $suggestion->save();

        return redirect()->route('suggestions.index');
    }

    public function delete(Suggestion $suggestion)
    {
        $suggestion->delete();
        return redirect()->route('suggestions.index');
    }

    public function storeComments(CommentRequest $request)
    {
        abort_if( ! $request->ajax(), 403);
        $suggestion = Suggestion::findOrFail($request->input('model_id'));
        return $this->storeComment($request, $suggestion);
    }
}
