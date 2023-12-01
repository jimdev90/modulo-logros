<div class="ms-2 {{ $comment->parent_id ? 'mt-4' : 'pb-4' }}" id="comment-{{ $comment->id }}">
    <div class="d-flex flex-start">
        <img src="https://static-00.iconduck.com/assets.00/agent-icon-504x512-8la6av7b.png"
             alt="{{ $comment->author->idusuarios }}" class="rounded-circle shadow-1-strong me-1" width="60"
             height="60">
        <div class="container-fluid border-start ps-3">
            <div class="row">
                <h6 class="fw-bold mb-1">{{ $comment->author->nombre }}</h6>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col">
                    {{ $comment->time_ago }}
                    <span class="badge bg-{{ $comment->statusClass }}">{{ $comment->status }}"></span>
                </div>
                <div class="col-auto">
                    <a class="btn btn-sm p-1 btn-outline-primary reply" id="reply-{{ $comment->id }}">
                        <i class="bi bi-reply"></i> Responder
                    </a>
                </div>
            </div>
            <p class="mb-0 content">
                {!! $comment->content !!}
            </p>
        </div>
    </div>
    <div class="ms-5">
        @forelse($comment->children as $children)
            <x-comment :comment="$children"/>
        @empty
        @endforelse
    </div>
</div>
