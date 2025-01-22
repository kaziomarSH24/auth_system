import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

const app = express();
const server = createServer(app);

const baseUrl = 'http://127.0.0.1:8000/api'; // Laravel API URL

const io = new Server(server, {
    cors: {
        origin: '*', // Allow all origins
    },
});

const users = {}; // User-to-socket mapping

io.on('connection', (socket) => {
    console.log(`User connected: ${socket.id}`);

    // Join a private room
    socket.on('joinRoom', ({ userId, receiverId }) => {
        users[userId] = socket.id;
        const roomId = [userId, receiverId].sort().join('-'); // Unique room ID
        socket.join(roomId);
        console.log(`User ${userId} joined room ${roomId}`);
        console.log('Current Rooms:', socket.rooms);
        updateUserStatus(userId, true); // Update user status to active
    });

    // Handle private messages
    socket.on('send_message', ({conversationId, userId, receiverId, message, sender, receiver, timestamp }) => {
        const roomId = [userId, receiverId].sort().join('-');
        console.log(`Message from ${userId} in room ${roomId}: ${message}`);
        io.to(roomId).emit('receive_message', {
            message,
            conversationId,
            senderId: userId,
            receiverId,
            sender,
            receiver,
            timestamp,
        });
    });

    // Handle group joining
    socket.on('joinGroup', ({ userId, groupId }) => {
        socket.join(groupId);
        console.log(`User ${userId} joined group ${groupId}`);
    });

    // Handle group messages
    socket.on('sendGroupMessage', ({ groupId, userId, message }) => {
        io.to(groupId).emit('receiveGroupMessage', {
            senderId: userId,
            message,
            timeStamp: new Date().toLocaleString('en-GB', {
                day: '2-digit',
                month: 'short',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            }),
        });
        console.log(`Message in group ${groupId} from ${userId}: ${message}`);
    });

    // Handle user disconnection
    socket.on('disconnect', () => {
        console.log(`User disconnected: ${socket.id}`);
        const userId = getKeyByValue(users, socket.id);
        if (userId) {
            delete users[userId];
            console.log(`User ${userId} disconnected`);
            updateUserStatus(userId, false); // Update user status to inactive
        }
    });

    // Helper function to get key by value
    function getKeyByValue(object, value) {
        return Object.keys(object).find((key) => object[key] === value);
    }
});

// Start server
server.listen(3000, () => {
    console.log('Server running on port 3000');
});

// Function to update user status in Laravel API
function updateUserStatus(userId, isActive) {
    try {
        fetch(`${baseUrl}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                userId,
                is_active: isActive,
            }),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                console.log('Status updated:', data);
            })
            .catch((error) => {
                console.error('Error updating status:', error);
            });
    } catch (error) {
        console.error('Error in updateUserStatus:', error);
    }
}
