<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Comments</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
</head>
<body>
    <div class="comment-section">
        <h2>Comments</h2>
        <div id="comments-container">
            <div class="loading">Loading comments...</div>
        </div>

        <h3>Add a New Comment</h3>
        <div class="comment">
            <textarea id="new-comment-content" placeholder="Write your comment here..." rows="3"></textarea>
            <button id="submit-comment" class="submit-reply">Post Comment</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/comments.js') }}"></script>
</body>
</html>
