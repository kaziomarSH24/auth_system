@extends('layouts.app')

@section('content')
<div class="pt-2 row">
  <div class="col-md-4">
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Contacts</h3>
          </div>
          <div class="card-body">
              <ul class="contacts-list">
                  
                {{-- conversation contact  --}}
                  
              </ul>
          </div>
      </div>
  </div>
  <div class="col-md-8">
      <div class="card direct-chat direct-chat-primary">
          <div class="card-header">
              <h3 class="card-title">Chat with
                  <span id="recevicer">
                     
                  </span>
              </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" id="conversation">
                 
                {{-- Messages load --}}



              </div>
              <!--/.direct-chat-messages-->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
              <form action="#">
                  <div class="input-group">
                      <input id="chatMsg" type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-append">
                          <button id="sendBtn" type="button" class="btn btn-primary">Send</button>
                      </span>
                  </div>
              </form>
          </div>
          <!-- /.card-footer-->
      </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      let ip_address = '127.0.0.1';
      let socket_port = '3000';
      let socket = io(ip_address + ':' + socket_port);
      let _token = 'Bearer ' + localStorage.getItem('user_token');
      showContacts();
      

      
      //AJAX Setup
      function showContacts() {
       
        $.ajax({
          url: 'http://localhost:8000/api/conversation',
          type: 'GET',
          headers: {
            'Authorization': _token
          },
          success: function(response) {
            console.log(response);
            if(response.length > 0){ 
              let user_id = response[0].auth;
              
              
              let contactsList = $('.contacts-list');
              response.forEach(contact => {
                contactsList.append(`
                  <li class=" ">
                      <a href="#" data-conversationId = "${contact.id}">
                          <img class="contacts-list-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="User Avatar">
                          <div class="contacts-list-info">
                              <span class="contacts-list-name text-dark">
                                  ${contact.auth == contact.sender_id ? contact.receiver : contact.sender}
                                  <small class="float-right contacts-list-date text-muted">${contact.created_at}</small>
                              </span>
                              <span class="contacts-list-msg text-secondary">${contact.last_message}</span>
                          </div>
                      </a>
                  </li>
                `);
              });

          socket.on('connect', () => {
            console.log(user_id);
            console.log('connected');
            socket.emit('sendChatToServer', user_id);
          });
 
            }else{
              $('.contacts-list').append(`
                <li class="">
                    <a href="#">
                        <img class="contacts-list-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="User Avatar">
                        <div class="contacts-list-info">
                            <span class="contacts-list-name text-dark">
                                No Contacts
                            </span>
                        </div>
                    </a>
                </li>
              `);
            }
          }
        });
      }

      //view conversation
      $('.contacts-list').on('click','li a',function(e) {
        e.preventDefault();
        $('.contacts-list li').removeClass('bg-warning');
        $(this).parent().addClass('bg-warning');
        let conversationId = $(this).data('conversationid');
        viewConversation(conversationId);
      });

      function viewConversation(conversationId) {
        let receiver = $('#recevicer');
        $('.direct-chat-messages').html('');
        $.ajax({
          url: 'http://localhost:8000/api/conversation/' + conversationId,
          type: 'GET',
          headers: {
            'Authorization': _token
          },
          success: function(response) {
            // console.log(response);
            
            response.messages.forEach(message => {
              receiver.text(response.receiver);
              $('.direct-chat-messages').append(`
         <div class="direct-chat-msg ${message.auth == message.user_id ? 'right' : ''}">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-${message.auth == message.user_id ? 'right' : 'left'}">${message.sender_id == message.user_id ? message.sender : message.receiver}</span>
                    <span class="direct-chat-timestamp float-${message.auth == message.user_id ? 'left' : 'right'}">${message.created_at}</span>
                  </div>
                  <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="message user image">
                  <div class="direct-chat-text">
                    ${message.body}
                  </div>
                </div>
        `);
        $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
            });
          }
        });
      }

      //send message catch
      $('#sendBtn').on('click',function(e) {
        e.preventDefault();
        let conversationId = $('.contacts-list li.bg-warning a').data('conversationid');
        let message = $('#chatMsg').val();
        if (message.length > 0) {
          console.log(conversationId);
          
          
           // send message to socket server

          //  socket.on('connect', () => {
          //   console.log('connected');
          //   socket.emit('sendChatToServer', conversationId, message);
          // });


          sendMessage(message, conversationId);
          $('#chatMsg').val('');
        }

        socket.on('sendChatToClient', (message) => {
      $('.direct-chat-messages').append(`
        <div class="direct-chat-msg">
      <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-left">Other User</span>
        <span class="direct-chat-timestamp float-right">Just now</span>
      </div>
      <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user1-128x128.jpg" alt="message user image">
      <div class="direct-chat-text">
        ${message}
      </div>
        </div>
      `);
      $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    });


      });

      //send message
      function sendMessage(message, conversationId) {
        $.ajax({
          url: 'http://localhost:8000/api/send-message',
          type: 'POST',
          headers: {
            'Authorization': _token
          },
          data: {
            body: message,
            conversation_id: conversationId
          },
          success: function(response) {
            // console.log(response);
            
            if (response.status == 'success') {

              console.log(response.message.body);
              
              $('.direct-chat-messages').append(`
         <div class="direct-chat-msg ${response.message.receiver_id == response.message.user_id ? 'right' : ''}">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-${response.message.receiver_id == response.message.user_id ? 'right' : 'left'}">${response.message.sender_id == response.message.user_id ? response.message.sender : response.message.receiver}</span>
                    <span class="direct-chat-timestamp float-${response.message.receiver_id == response.message.user_id ? 'left' : 'right'}">${response.message.created_at}</span>
                  </div>
                  <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="message user image">
                  <div class="direct-chat-text">
                    ${response.message.body}
                  </div>
                </div>
        `);
        $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
        
            }
            
          }
        });
      }


      








      

      // let chatInput = $('#chatMsg');
      // let sendBtn = $('#sendBtn');
      // let chatInput = $('#chatMsg');
      // sendBtn.on('click',function(e) {
      //   let message = chatInput.val();

        // console.log(message);
      //   if (message.length > 0) {
      //     socket.emit('sendChatToServer', message);
      //     chatInput.val('');
      //     $('.direct-chat-messages').append(`
      //   <div class="direct-chat-msg right">
      // <div class="direct-chat-infos clearfix">
      //   <span class="direct-chat-name float-right">You</span>
      //   <span class="direct-chat-timestamp float-left">Just now</span>
      // </div>
      // <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user3-128x128.jpg" alt="message user image">
      // <div class="direct-chat-text">
      //   ${message}
      //       </div>
      //     </div>
      //   `);
      //   $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
      //     e.preventDefault();
      //   }
      // });


      socket.on("private-channel:App\\Events\\PrivateMessageEvent", (data) => {
        console.log(data);
      });






    // socket.on('sendChatToClient', (data) => {
    //   console.log(data);
      
    //   const { id, msg } = data;
    //   console.log(msg);
      
    //   $('.direct-chat-messages').append(`
    //     <div class="direct-chat-msg">
    //   <div class="direct-chat-infos clearfix">
    //     <span class="direct-chat-name float-left">Other User</span>
    //     <span class="direct-chat-timestamp float-right">Just now</span>
    //   </div>
    //   <img class="direct-chat-img" src="{{asset('backend')}}/dist/img/user1-128x128.jpg" alt="message user image">
    //   <div class="direct-chat-text">
      
    //   </div>
    //     </div>
    //   `);
    //   $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    // });
    });
  </script>
@endpush