@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <span>{{ __('Notifications') }}</span>
                    <div class="d-flex flex-wrap gap-2">
                        <form action="{{ route('notifications.markAllRead') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('Mark all as read') }}</button>
                        </form>
                        <form action="{{ route('notifications.destroyAll') }}" method="POST" class="d-inline"
                              onsubmit="return confirm({{ json_encode(__('Delete all notifications? This cannot be undone.')) }});">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete all') }}</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-3" role="alert">{{ session('status') }}</div>
                    @endif

                    @if ($notifications->isEmpty())
                        <p class="text-muted mb-0">{{ __('You have no notifications yet.') }}</p>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Message') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('When') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
                                        <tr class="{{ $notification->read_at ? '' : 'table-light' }}">
                                            <td>
                                                @if ($notification->read_at)
                                                    <span class="badge bg-secondary">{{ __('Read') }}</span>
                                                @else
                                                    <span class="badge bg-primary">{{ __('Unread') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('notifications.show', $notification->id) }}">
                                                    {{ $notification->data['message'] ?? class_basename($notification->type) }}
                                                </a>
                                            </td>
                                            <td><small class="text-muted">{{ class_basename($notification->type) }}</small></td>
                                            <td><small>{{ $notification->created_at->diffForHumans() }}</small></td>
                                            <td class="text-end">
                                                <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline"
                                                      onsubmit="return confirm({{ json_encode(__('Delete this notification?')) }});">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
