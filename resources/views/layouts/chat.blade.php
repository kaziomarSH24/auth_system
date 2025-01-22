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
            <div class="card-body">
                <!-- Chat Messages -->
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

    $(document).ready(() => {
        loadContacts();

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

        $('.contacts-list').on('click', 'a.contact-item', function (e) {
            e.preventDefault();

            $('.contacts-list li').removeClass('bg-warning');
            $(this).parent().addClass('bg-warning');

            const conversationId = $(this).data('conversationid');
            const receiverId = $(this).data('receiverid');
            const receiverName = $(this).data('name');


             // Join the room based on the conversation ID
            socket.emit('joinRoom', { userId, receiverId });


            $('#receiver').text(receiverName);
            //mark conversation as read
            $.ajax({
                url: `http://localhost:8000/api/conversation/${conversationId}`,
                type: 'PUT',
                headers: { 'Authorization': token },
                success: () => {
                    const unreadMsg = $('.unreadMsg-' + conversationId);
                    unreadMsg.remove();
                    console.log('Conversation marked as read.');
                },
                error: () => alert('Failed to mark conversation as read.')
            });
            loadConversation(conversationId);
        });

        function loadConversation(conversationId) {
            const chatMessages = $('.direct-chat-messages');
            chatMessages.empty();

            //add class to ChatMessages
            $('.direct-chat-messages').removeClass(function (index, className) {
                return (className.match(/(^|\s)conversation-\S+/g) || []).join(' ');
            });
            chatMessages.addClass('conversation-' + conversationId);

            $.ajax({
                url: `http://localhost:8000/api/conversation/${conversationId}`,
                type: 'GET',
                headers: { 'Authorization': token },
                success: (response) => {
                    response.messages.forEach((msg) => appendMessage(msg.is_sender, msg.sender.name, msg.created_at_formatted, msg.message, conversationId));
                },
                error: () => alert('Failed to load conversation.')
            });
        }

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
                    // appendMessage(true, 'You', response.data.created_at_formatted, response.data.message);
                    contactsListMsg.text(response.data.message);
                    contactsListDate.text(response.data.created_at_formatted);
                    console.log(response.data);


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
            isYou = data.senderId == userId ? true : false;
            appendMessage(isYou, data.sender, data.timestamp, data.message, data.conversationId);
        });
    });
</script>
@endpush

