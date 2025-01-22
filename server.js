import express from 'express';
import { createServer } from 'node:http';
import { Server } from 'socket.io';


const app = express();
const expressServer = createServer(app);

const io = new Server(expressServer,{
  cors: {
    origin: '*',
  }
});

 const users = [];




// let customNamespace = io.of('/customNamespace');

io.on('connection', (socket) => {   //connect user
  console.log('a user connected: ' + socket.id);

  socket.on('joinroom' , (userId) => {
    users[userId] = socket.id;
    console.log('joinroom: ' + users);
    console.log('Current Rooms:', socket.rooms);
    socket.join(userId);
  });

  socket.on('sendChatToServer', (data) => {

    const { message, auth, receiverId, senderId, receiver, sender, userId } = data;
    console.log(`User ${auth} sent message: ${message}`);
    console.log('receiverId: ', receiverId);

    // users[id] = socket.id
    // console.log(`User logged in: ${id} message: ${msg}`);

    //send message to client
    //  io.emit('sendChatToServer', socket.id);
    // console.log("users : ",users);

    if(users[receiverId]){
      console.log('User found:', users[receiverId]);
    io.to(users[receiverId]).emit('sendChatToClient', {
      message,
      auth,
      receiverId,
      senderId,
      receiver,
      sender,
      userId,
      timestamp: new Date().toLocaleString('en-GB', {
      day: '2-digit',
      month: 'short',
      hour: '2-digit',
      minute: '2-digit',
      hour12: true
      })
    });

    } else {
      console.log('User not found:', receiverId);
    }
    console.log("Emit sent to receiver:", receiverId, message);

    // socket.broadcast.emit('sendChatToClient', {
    //   message,
    //   auth,
    //   receiverId,
    //   senderId,
    //   receiver,
    //   sender,
    //   userId,
    //   timestamp: new Date().toLocaleString('en-GB', {
    //   day: '2-digit',
    //   month: 'short',
    //   hour: '2-digit',
    //   minute: '2-digit',
    //   hour12: true
    //   })
    // });

    console.log('sfshafoshfos',socket.rooms);

  });



  //disconnect user
  socket.on('disconnect', () => {
    console.log('user disconnected: ' + socket.id);
  });
});

expressServer.listen(3001, () => {
  console.log('server running at http://localhost:3000');
});
