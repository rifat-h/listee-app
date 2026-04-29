@extends('layouts.app')

@section('title', 'Messages - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Messages',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard', 'url' => route('user.dashboard')],
        ['name' => 'Messages']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4">
                <div class="dashboard-sidebar">
                    <div class="sidebar-user-info text-center">
                        <div class="user-avatar">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                                 alt="{{ auth()->user()->name }}">
                        </div>
                        <h5>{{ auth()->user()->name }}</h5>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>
                    <ul class="dashboard-nav">
                        <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                        <li><a href="{{ route('user.my-listings') }}"><i class="fas fa-list"></i> My Listings</a></li>
                        <li><a href="{{ route('user.bookmarks') }}"><i class="fas fa-heart"></i> Bookmarks</a></li>
                        <li class="active"><a href="{{ route('user.messages') }}"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li><a href="{{ route('user.reviews') }}"><i class="fas fa-star"></i> Reviews</a></li>
                        <li><a href="{{ route('user.add-listing') }}"><i class="fas fa-plus-circle"></i> Add Listing</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">
                <div class="messages-container">
                    <div class="row g-0">

                        {{-- Conversations List --}}
                        <div class="col-md-4">
                            <div class="conversations-panel">
                                <div class="conv-header">
                                    <h5>Conversations</h5>
                                    <span class="badge bg-danger">{{ $unreadCount ?? 0 }}</span>
                                </div>
                                <div class="conv-search">
                                    <input type="text" class="form-control" placeholder="Search conversations..." id="searchConversations">
                                </div>
                                <div class="conv-list">
                                    @forelse($conversations ?? [] as $conversation)
                                        <a href="{{ route('user.messages', ['conversation' => $conversation->id]) }}" 
                                           class="conv-item {{ ($activeConversation ?? null) == $conversation->id ? 'active' : '' }} {{ $conversation->unread ? 'unread' : '' }}">
                                            <div class="conv-avatar">
                                                <img src="{{ $conversation->otherUser->avatar ? asset('storage/' . $conversation->otherUser->avatar) : asset('images/default-avatar.png') }}" 
                                                     alt="{{ $conversation->otherUser->name }}">
                                                @if($conversation->otherUser->is_online ?? false)
                                                    <span class="online-dot"></span>
                                                @endif
                                            </div>
                                            <div class="conv-info">
                                                <div class="conv-top">
                                                    <strong>{{ $conversation->otherUser->name }}</strong>
                                                    <span class="conv-time">{{ $conversation->lastMessage->created_at->shortRelativeDiffForHumans() }}</span>
                                                </div>
                                                <p class="conv-preview">
                                                    {{ Str::limit($conversation->lastMessage->message ?? '', 40) }}
                                                </p>
                                                @if($conversation->listing)
                                                    <span class="conv-listing-tag">
                                                        <i class="fas fa-tag"></i> {{ Str::limit($conversation->listing->title, 20) }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if($conversation->unread_count > 0)
                                                <span class="unread-badge">{{ $conversation->unread_count }}</span>
                                            @endif
                                        </a>
                                    @empty
                                        <div class="conv-empty text-center py-4">
                                            <i class="far fa-comment-dots fa-2x text-muted mb-2"></i>
                                            <p class="text-muted">No conversations yet</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Chat Area --}}
                        <div class="col-md-8">
                            @if($activeConversation ?? false)
                                <div class="chat-panel">
                                    {{-- Chat Header --}}
                                    <div class="chat-header">
                                        <div class="chat-user-info">
                                            <img src="{{ $chatUser->avatar ? asset('storage/' . $chatUser->avatar) : asset('images/default-avatar.png') }}" 
                                                 alt="{{ $chatUser->name }}">
                                            <div>
                                                <strong>{{ $chatUser->name }}</strong>
                                                <small class="d-block {{ ($chatUser->is_online ?? false) ? 'text-success' : 'text-muted' }}">
                                                    {{ ($chatUser->is_online ?? false) ? 'Online' : 'Offline' }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="chat-actions">
                                            <button class="btn btn-sm btn-outline-secondary" title="More">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Chat Messages --}}
                                    <div class="chat-messages" id="chatMessages">
                                        @foreach($messages ?? [] as $message)
                                            <div class="message {{ $message->sender_id == auth()->id() ? 'message-sent' : 'message-received' }}">
                                                @if($message->sender_id != auth()->id())
                                                    <div class="message-avatar">
                                                        <img src="{{ $chatUser->avatar ? asset('storage/' . $chatUser->avatar) : asset('images/default-avatar.png') }}" alt="">
                                                    </div>
                                                @endif
                                                <div class="message-bubble">
                                                    <p>{{ $message->message }}</p>
                                                    @if($message->attachment)
                                                        <div class="message-attachment">
                                                            <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank">
                                                                <i class="fas fa-paperclip"></i> Attachment
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <span class="message-time">
                                                        {{ $message->created_at->format('h:i A') }}
                                                        @if($message->sender_id == auth()->id())
                                                            <i class="fas fa-check{{ $message->is_read ? '-double text-primary' : ' text-muted' }}"></i>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Chat Input --}}
                                    <div class="chat-input">
                                        <form action="{{ route('user.messages.send') }}" method="POST" enctype="multipart/form-data" class="chat-form">
                                            @csrf
                                            <input type="hidden" name="conversation_id" value="{{ $activeConversation }}">
                                            <label for="chatAttachment" class="btn-attach" title="Attach File">
                                                <i class="fas fa-paperclip"></i>
                                            </label>
                                            <input type="file" name="attachment" id="chatAttachment" class="d-none">
                                            <input type="text" name="message" class="form-control" 
                                                   placeholder="Type a message..." autocomplete="off" required>
                                            <button type="submit" class="btn-send" title="Send">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                {{-- No Conversation Selected --}}
                                <div class="chat-empty text-center">
                                    <i class="far fa-comments fa-4x text-muted mb-3"></i>
                                    <h5>Select a Conversation</h5>
                                    <p class="text-muted">Choose a conversation from the left to start messaging.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.messages-container {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    overflow: hidden;
    min-height: 600px;
}
.conversations-panel {
    border-right: 1px solid #e8e8e8;