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

 const users = {};

// let customNamespace = io.of('/customNamespace');

io.on('connection', (socket) => {   //connect user
  console.log('a user connected: ' + socket.id);

  socket.on('sendChatToServer', ({id, msg}) => {
    users[id] = socket.id
    console.log(`User logged in: ${id}`);
    
    //send message to client
     io.emit('sendChatToServer', socket.id);
    console.log("users : ",users);
    
    // socket.broadcast.emit(`sendChatToClient${conversationId}`, msg);

  });

  socket.on('sendChatToClient', ({id, msg}) => {
    console.log(`Sending private message to User ${id} to ${msg}`);
    // console.log('message: ' + id + ': ' + msg);
    if(users[id]){
      console.log("users : ",users)
      io.to(users[id]).emit('sendChatToClient', {
        senderId: id,
        msg
      });
      io.to(socket.id).emit('sendChatToClient', {
        senderId: id,
        msg
      });
      console.log(users[id])
    }else{
      console.log(`User ${id} not found or offline.`);
    }
    
  });

  //disconnect user
  socket.on('disconnect', (socket) => {
    console.log(`User disconnected: ${socket.id}`);
    for (const [id] of Object.entries(users)) {
      console.log("des : user id ", id)
      if (id){
          delete users[id];
          break;
      }
  }

  console.log(users)
  });
});

expressServer.listen(3000, () => {
  console.log('server running at http://localhost:3000');
});