@php
$poll = $post->getPollData();
$options = $poll['options'];
$totalVotes = collect($options)->sum('votes');
@endphp

<div class="text-dark row"> 
<div class="col-11">
    <h4 class="mb-4">{{ $post->text }}</h4>

    @foreach ($options as $option)
        @php
            $percent = $totalVotes === 0 ? 0 : ($option['votes'] / $totalVotes) * 100;
        @endphp

        @if (!empty($option['option_text']))
            <div class="mb-3">
                <button class="btn btn-outline-danger w-100 vote-btn"
                    data-option="{{ $option['option_text'] }}"
                    data-post="{{ $post->slug_id }}">
                    {{ $option['option_text'] }}
                </button>
                <div class="progress mt-2">
                    <div class="progress-bar bg-danger" style="width: {{ $percent }}%;">
                        {{ round($percent) }}%
                    </div>
                </div>
                <span class="vote-count">{{ $option['votes'] }} {{ __('vote') }}</span>
            </div>
        @endif
    @endforeach

    <p class="mt-3 text-muted">📊 {{ __('totalVotes') }} <strong>{{ $totalVotes }}</strong></p>
    <p class="mt-4 text-muted">⏳ {{ __('voteEnds') }} {{ $poll['expires_at'] }}</p>
</div>
</div>