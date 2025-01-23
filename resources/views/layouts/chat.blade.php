@extends('layouts.app')

@section('content')
<div class="row pt-2">
    <!-- Contacts Section -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contacts</h3>
            </div>
            <div class="card-body">
                <ul class="contacts-list">
                    {{-- Example Contact --}}
                    <li>
                        <a href="#" class="contact-item" data-id="1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="/path/to/user1.jpg" class="img-circle" alt="User Image" width="40">
                                    <span class="contact-name">User 1</span>
                                </div>
                                <span class="badge badge-success">Active</span>
                            </div>
                        </a>
                    </li>
                    {{-- Add more contacts dynamically here --}}
                </ul>
            </div>
        </div>
    </div>

    <!-- Chat Section -->
    <div class="col-md-8">
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Chat with
                    <span id="receiver">Group Name</span>
                </h3>
                <div class="card-tools">
                    <!-- Video Call Button -->
                    <button type="button" class="btn btn-tool" id="videoCallBtn" title="Start Video Call">
                        <i class="fas fa-video"></i>
                    </button>
                    <!-- Audio Call Button -->
                    <button type="button" class="btn btn-tool" id="audioCallBtn" title="Start Audio Call">
                        <i class="fas fa-phone"></i>
                    </button>
                </div>
            </div>
            <!-- Chat Body -->
            <div class="card-body position-relative">
                <!-- Chat Messages -->
                <p id="loadingMessage" class="position-absolute w-100 text-center" style="display: none; transform: translateY(-50%); top:12px">Loading...</p>
                <div class="direct-chat-messages" id="conversation">

                    {{-- Messages will load dynamically here --}}
                </div>
            </div>
            <!-- Chat Footer -->
            <div class="card-footer">
                <form id="messageForm">
                    <div class="input-group">
                        <input id="chatMsg" type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                            <button id="sendBtn" type="button" class="btn btn-primary">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('chat-js')
<script>
    const userId = localStorage.getItem('user_id');
    const socket = io('http://127.0.0.1:3000');
    let token = `Bearer ${localStorage.getItem('user_token')}`;
    const loadingMessage = $('#loadingMessage');
    let isLoading = false;
    let page = 1;
    let hasMoreMessages = true;

    $(document).ready(() => {
        loadContacts();


        /**@argument
         * Load contacts from the server
         */
        function loadContacts() {
            $.ajax({
                url: 'http://localhost:8000/api/conversation',
                type: 'GET',
                headers: { 'Authorization': token },
                success: (contacts) => {
                    const contactsList = $('.contacts-list');
                    contactsList.empty();

                    if (contacts.length) {
                        contacts.forEach((contact) => {
                            //emiting joinRoom event to join the room of the conversation
                            const receiverId = userId == contact.receiver_id ? contact.sender_id : contact.receiver_id;
                            socket.emit('joinRoom', { userId, receiverId });

                            contactsList.append(`
                                <li>
                                    <a href="#"
                                        class="contact-item"
                                        data-conversationId="${contact.id}"
                                        data-receiverId="${contact.receiver_id}"
                                        data-name="${contact.name}">
                                        <img class="contacts-list-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="User Avatar">
                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name text-dark">
                                                ${contact.name}
                                                ${contact.unread_messages ? `<span class="unreadMsg-${contact.id} float-right badge badge-danger">${contact.unread_messages}</span>` : ''}
                                            </span>
                                            <span class="contacts-list-msg${contact.id} text-secondary">${contact.last_message}</span>
                                            <small class="contacts-list-date${contact.id} text-muted float-right">${contact.created_at}</small>
                                        </div>

                                    </a>
                                </li>
                            `);
                        });
                    } else {
                        contactsList.append('<li>No Contacts</li>');
                    }
                },
                error: () => alert('Failed to load contacts.')
            });
        }


        /**@argument
         * Load conversation when a contact is clicked
         */
        $('.contacts-list').on('click', 'a.contact-item', function (e) {
            e.preventDefault();

            $('.contacts-list li').removeClass('bg-warning');
            $(this).parent().addClass('bg-warning');

            const conversationId = $(this).data('conversationid');
            const receiverId = $(this).data('receiverid');
            const receiverName = $(this).data('name');

            // socket.emit('joinRoom', { userId, receiverId });

            $('#receiver').text(receiverName);

           markAsRead(conversationId);
           loadConversation(conversationId);
        });

        function markAsRead(conversationId) {
            $.ajax({
                url: `http://localhost:8000/api/markAsRead/${conversationId}`,
                type: 'PUT',
                headers: { 'Authorization': token },
                success: () => {
                    const unreadMsg = $('.unreadMsg-' + conversationId);
                    unreadMsg.remove();
                },
                error: () => alert('Failed to mark conversation as read.')
            });
        }

        function loadConversation(conversationId) {
            const chatMessages = $('.direct-chat-messages');
            chatMessages.empty();

            page = 1;
            hasMoreMessages = true;

            chatMessages.removeClass(function (index, className) {
                return (className.match(/(^|\s)conversation-\S+/g) || []).join(' ');
            });
            chatMessages.addClass('conversation-' + conversationId);

            loadOlderMessages(conversationId);
        }

        $('.direct-chat-messages').on('scroll', function () {
            if ($(this).scrollTop() === 0 && hasMoreMessages && !isLoading) {

                const activeContact = $('.contacts-list li.bg-warning a');
                const conversationId = activeContact.data('conversationid');
                loadingMessage.show();
                loadOlderMessages(conversationId);
            }else{
                loadingMessage.hide();
            }
        });

        function loadOlderMessages(conversationId) {
            isLoading = true;

            $.ajax({
                url: `http://localhost:8000/api/conversation/${conversationId}?page=${page}`,
                type: 'GET',
                headers: { 'Authorization': token },
                success: (response) => {
                    if (response.messages.length === 0) {
                        hasMoreMessages = false;
                    } else {
                        page++;

                        const chatMessages = $('.direct-chat-messages');
                        const scrollHeightBefore = chatMessages[0].scrollHeight;
                        console.log(response);

                        response.messages.data.forEach((msg) => prependMessage(msg.is_sender, msg.sender.name, msg.created_at_formatted, msg.message, conversationId));

                        chatMessages.scrollTop(chatMessages[0].scrollHeight - scrollHeightBefore);
                    }
                },
                error: () => alert('Failed to load older messages.'),
                complete: () => {
                    isLoading = false;
                    loadingMessage.hide();
                }
            });
        }

        function prependMessage(isSender, senderName, timestamp, message, conversationId) {
            const position = isSender ? 'right' : 'left';
            const displayName = isSender ? 'You' : senderName;

            $(`.conversation-${conversationId}`).prepend(`
                <div class="direct-chat-msg ${position}">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-${position}">${displayName}</span>
                        <span class="direct-chat-timestamp float-${position === 'right' ? 'left' : 'right'}">${timestamp}</span>
                    </div>
                    <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="User Avatar">
                    <div class="direct-chat-text">${message}</div>
                </div>
            `);
        }

        $('#sendBtn').on('click', (e) => {
            e.preventDefault();

            const activeContact = $('.contacts-list li.bg-warning a');
            const conversationId = activeContact.data('conversationid');
            const receiverId = activeContact.data('receiverid');
            const message = $('#chatMsg').val();

            if (message.trim()) {
                sendMessage(message, receiverId, conversationId);
                $('#chatMsg').val('');
            }
        });

        function sendMessage(message, receiverId, conversationId) {
            const contactsListMsg = $(`.contacts-list-msg${conversationId}`);
            const contactsListDate = $(`.contacts-list-date${conversationId}`);

            $.ajax({
                url: 'http://localhost:8000/api/send-message',
                type: 'POST',
                headers: { 'Authorization': token },
                data: { message, receiver_id: receiverId },
                success: (response) => {
                    contactsListMsg.text(response.data.message);
                    contactsListDate.text(response.data.created_at_formatted);

                    socket.emit('send_message', {
                        conversationId: conversationId,
                        userId: response.data.sender_id,
                        receiverId: response.data.receiver_id,
                        message: response.data.message,
                        sender: response.data.sender_name,
                        timestamp: response.data.created_at_formatted
                    });
                },
                error: () => alert('Failed to send message.')
            });
        }

        socket.on('receive_message', (data) => {
            const contactsListMsg = $(`.contacts-list-msg${data.conversationId}`);
            const contactsListDate = $(`.contacts-list-date${data.conversationId}`);
            contactsListMsg.text(data.message);
            contactsListDate.text(data.timestamp);
            isYou = data.senderId == userId;
            appendMessage(isYou, data.sender, data.timestamp, data.message, data.conversationId);
        });

        function appendMessage(isSender, senderName, timestamp, message, conversationId) {
            const position = isSender ? 'right' : 'left';
            const displayName = isSender ? 'You' : senderName;

            $(`.conversation-${conversationId}`).append(`
                <div class="direct-chat-msg ${position}">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-${position}">${displayName}</span>
                        <span class="direct-chat-timestamp float-${position === 'right' ? 'left' : 'right'}">${timestamp}</span>
                    </div>
                    <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="User Avatar">
                    <div class="direct-chat-text">${message}</div>
                </div>
            `);

            $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
        }
    });
</script>
@endpush
