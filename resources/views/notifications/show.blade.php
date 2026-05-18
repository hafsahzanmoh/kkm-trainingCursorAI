@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <span>{{ __('Notification') }}</span>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('Back to list') }}</a>
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm({{ json_encode(__('Delete this notification?')) }});">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">{{ __('Status') }}</dt>
                        <dd class="col-sm-9">
                            @if ($notification->read_at)
                                <span class="badge bg-secondary">{{ __('Read') }}</span>
                                <small class="text-muted ms-2">{{ $notification->read_at->diffForHumans() }}</small>
                            @else
                                <span class="badge bg-primary">{{ __('Unread') }}</span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">{{ __('Type') }}</dt>
                        <dd class="col-sm-9"><code>{{ $notification->type }}</code></dd>

                        <dt class="col-sm-3">{{ __('Received') }}</dt>
                        <dd class="col-sm-9">{{ $notification->created_at->format('Y-m-d H:i:s') }} <small class="text-muted">({{ $notification->created_at->diffForHumans() }})</small></dd>

                        <dt class="col-sm-3">{{ __('Message') }}</dt>
                        <dd class="col-sm-9">{{ $notification->data['message'] ?? '—' }}</dd>

                        <dt class="col-sm-3">{{ __('Data') }}</dt>
                        <dd class="col-sm-9">
                            <pre class="bg-light border rounded p-3 small mb-0" style="max-height: 320px; overflow: auto;">{{ json_encode($notification->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
