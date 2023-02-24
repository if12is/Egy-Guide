@if ($post->reactions->contains('user_id', auth()->user()->id))
    <button class="btn rounded-pill btn-outline-youtube waves-effect reaction-btn liked"
        data-post-id="{{ $post->id }}" data-reaction="like">
        <i class="fas fa-heart mx-1"> </i> Like
    </button>
@else
    <button class="btn rounded-pill btn-outline-secondary waves-effect reaction-btn " data-post-id="{{ $post->id }}"
        data-reaction="like">
        <i class="fas fa-heart-o "> </i> Like
    </button>
@endif
