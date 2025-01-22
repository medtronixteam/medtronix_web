<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat Box</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('chatbox/css/style.css') }}" />
</head>

<body>
    <div class="chat-container">
        <div class="contact-list">
            <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" placeholder="Search users..." />
            </div>
            @foreach ($chatUsersList as $key => $user)
            @php
            $userData = App\Models\ChatMessage::where('email', $user->email)->first();
            @endphp
            <div class="contact-item" data-chat="{{ $user->email }}">
                <img src="{{ url('assets/images/Medtronix/medtronix-chat.png') }}" alt="User Image" />
                <span>{{ $userData->name }}</span>
                <span class="time">{{ $userData->created_at }}</span>
            </div>
            @endforeach
        </div>
        <div class="chat-section">
            <div class="chat-header">
                <h3 class="name" data-email=''>Chat User</h3>
            </div>
            <div class="chat-messages"></div>
            <div class="chat-footer">
                <input type="text" placeholder="Type a message..." />
                <i style="cursor: pointer;" class="fas fa-paper-plane send-btn"></i>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ url('chatbox/js/script.js') }}"></script>
</body>

</html>
