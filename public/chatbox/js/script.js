$(document).ready(function () {
    let currentEmail = '';
    let displayedMessages = new Set();

    function fetchChatUsers() {
        $.ajax({
            url: "{{ route('box.history') }}",
            method: "GET",
            dataType: "json",
            success: function (response) {
                const chatUsersList = $('#chatUsersList');
                chatUsersList.empty();

                response.chatUsersList.forEach(user => {
                    chatUsersList.append(`
                        <div class="contact-item" data-chat="${user.email}">
                            <img src="{{ url('assets/images/Medtronix/medtronix-chat.png') }}" alt="User Image" />
                            <span>${user.name}</span>
                            <span class="time">${user.created_at}</span>
                        </div>
                    `);
                });
            }
        });
    }

    function fetchMessages(email) {
        $.ajax({
            url: "/chat/messages/list",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: { email: email },
            success: function (response) {
                if (response.status === 'success') {
                    const contactList = $('.chat-messages');
                    const messages = response.message;
                    const user = messages.length ? messages[0].name : 'Chat User';
                    $('.chat-header h3').text(user);
                    $('.chat-header h3').data('email', email);

                    messages.forEach(message => {
                        if (!displayedMessages.has(message.id)) {
                            displayedMessages.add(message.id);

                            if (message.is_admin == 0) {
                                contactList.append(`
                                <div class="chat-bubble you">
                                    <span>${message.message}</span>
                                </div>`);
                            } else {
                                contactList.append(`
                                <div class="chat-bubble me">
                                    <span>${message.message}</span>
                                </div>`);
                            }
                            $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
                        }
                    });
                }
            }
        });
    }

    function sendMessage(email, name, message) {
        $.ajax({
            url: "/chat/messages/replay",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: {
                email: email,
                name: name,
                message: message,
            },
            success: function (response) {
                if (response.status === 'success') {
                    const bubble = $('<div class="chat-bubble me"></div>').text(message);
                    $('.chat-messages:visible').append(bubble);
                    $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
                } else {
                    alert('Message failed to send.');
                }
            }
        });
    }

    $(document).on('click', '.contact-item', function () {
        const email = $(this).data('chat');
        currentEmail = email;
        displayedMessages.clear();
        $('.chat-messages').empty(); // Clear previous messages from view
        fetchMessages(email);
    });

    $('.send-btn').on('click', function () {
        const message = $('.chat-footer input').val().trim();
        const email = $('.chat-header h3').data('email');
        const name = $('.chat-header h3').text();

        if (message !== "" && email) {
            sendMessage(email, name, message);
            $('.chat-footer input').val("");
        }
    });

    $('.chat-footer input').on('keypress', function (e) {
        if (e.which == 13) {
            $('.send-btn').click();
        }
    });

    setInterval(function () {
        if (currentEmail !== '') {
            fetchMessages(currentEmail);
        }
        fetchChatUsers();
    }, 2000);
});
