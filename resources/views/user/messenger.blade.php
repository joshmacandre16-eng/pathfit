@extends('layouts.masterathlete')

@section('title')
    Messenger
@endsection

@section('content')
<div class="content">
    <style>
        .messenger-container {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
        }

        .messenger-header {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .messenger-header h1 {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .messenger-main {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.5rem;
        }

        .contacts-list,
        .chat-window {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .contacts-list h3,
        .chat-window h3 {
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 3px solid #667eea;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .contact-item:hover {
            background-color: #f0f0f0;
        }

        .contact-item.active {
            background-color: #667eea;
            color: white;
        }

        .contact-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #333;
        }

        .contact-item.active .contact-avatar {
            background-color: white;
            color: #667eea;
        }

        .contact-info h4 {
            margin: 0;
            font-size: 0.9rem;
        }

        .contact-info p {
            margin: 0;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .unread-badge {
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }

        .chat-messages {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .message.sent {
            background-color: #667eea;
            color: white;
            margin-left: auto;
        }

        .message.received {
            background-color: #f0f0f0;
            color: #333;
        }

        .message-time {
            font-size: 0.7rem;
            opacity: 0.7;
            margin-top: 0.25rem;
        }

        .message.sent .message-time {
            text-align: right;
        }

        .message-input {
            display: flex;
            gap: 0.5rem;
        }

        .message-input input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-send {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-send:hover {
            background-color: #5a67d8;
        }

        .no-contacts {
            text-align: center;
            color: #666;
            padding: 2rem;
        }

        .no-chat {
            text-align: center;
            color: #666;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .messenger-container {
                padding: 1rem;
            }

            .messenger-main {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="messenger-container">
        <div class="messenger-header">
            <h1>
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Messenger
            </h1>
        </div>

        <div class="messenger-main">
            <div class="contacts-list">
                <h3>Contacts</h3>
                @if($contactsWithLatestMessage->count() > 0)
                    @foreach($contactsWithLatestMessage as $contactData)
                        <a href="{{ route('messages.show', $contactData['contact']->id) }}" class="contact-item {{ request()->route('contact') == $contactData['contact']->id ? 'active' : '' }}">
                            <div class="contact-avatar">
                                {{ strtoupper(substr($contactData['contact']->name, 0, 2)) }}
                            </div>
                            <div class="contact-info" style="flex: 1;">
                                <h4>{{ $contactData['contact']->name }}</h4>
                                <p>{{ $contactData['contact']->role }}</p>
                            </div>
                            @if($contactData['unread_count'] > 0)
                                <div class="unread-badge">{{ $contactData['unread_count'] }}</div>
                            @endif
                        </a>
                    @endforeach
                @else
                    <div class="no-contacts">
                        <p>No contacts yet. Start a conversation!</p>
                    </div>
                @endif
            </div>

            <div class="chat-window">
                @if(request()->route('contact'))
                    @php
                        $contact = $contactsWithLatestMessage->where('contact.id', request()->route('contact'))->first()['contact'] ?? null;
                    @endphp
                    @if($contact)
                        <h3>Chat with {{ $contact->name }}</h3>
                        <div class="chat-messages" id="chat-messages">
                            @if(isset($messages) && $messages->count() > 0)
                                @foreach($messages as $message)
                                    <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                        <p>{{ $message->content }}</p>
                                        <div class="message-time">{{ $message->created_at->format('M j, g:i A') }}</div>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-chat">
                                    <p>No messages yet. Start the conversation!</p>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('messages.store', $contact->id) }}" method="POST" class="message-input">
                            @csrf
                            <input type="text" name="content" placeholder="Type your message..." required maxlength="1000">
                            <button type="submit" class="btn-send">Send</button>
                        </form>
                    @else
                        <div class="no-chat">
                            <p>Contact not found.</p>
                        </div>
                    @endif
                @else
                    <div class="no-chat">
                        <p>Select a contact to start chatting.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Auto scroll to bottom of chat
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</div>
@endsection
