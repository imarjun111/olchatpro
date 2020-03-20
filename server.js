var app = require('http').createServer(handler),
  io = require('socket.io').listen(app),
  fs = require('fs'),
  connectionsArray = [],
  POLLING_INTERVAL = 3000,
  pollingTimer;


// creating the server ( localhost:8000 )
app.listen(8082);

function handler(req, res) {
}

 var http = require('http');

var pollingLoop = function() {
var url = "http://localhost/cakenewtest/Chats/getallmsg/123456789";
  // Doing the database query


http.get(url, function(query){  var body = '';
    users = []; // this array will contain the result of our db query

  // setting the query listeners
  query
    .on('error', function(err) {
      // Handle error, and 'end' event will be emitted after this as well
      console.log(err);
      updateSockets(err);
    })
     .on('data', function(chunk){
        body += chunk;
    })
    .on('result', function(user) {
      // it fills our array looping on each user row inside the db
  
   
      //users.push(user);
    })
    .on('end', function() {
       var fbResponse = JSON.parse(body);
       //console.log("Got a response: ", fbResponse);
        for (var ke in fbResponse) {
       if (fbResponse.hasOwnProperty(ke)) {
           var objc = {
                    time: fbResponse[ke].time,
                    text: fbResponse[ke].text,
                    author: fbResponse[ke].author,
                    color: fbResponse[ke].color
                };
                 users.push(objc);
            // console.log(fbResponse[ke].color);
       }
     }

        if (connectionsArray.length) {


          pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);

          updateSockets({
            selldata: selldata
          });
        } else {

          console.log('The server timer was stopped because there are no more socket connections on the app')

        }
    });
   });


}


// creating a new websocket to keep the content updated without any AJAX request
io.sockets.on('connection', function(socket) {

  console.log('Number of connections:' + connectionsArray.length);
  // starting the loop only if at least there is one user connected
  if (!connectionsArray.length) {
    pollingLoop();
  }

  socket.on('disconnect', function() {
    var socketIndex = connectionsArray.indexOf(socket);
    console.log('socketID = %s got disconnected', socketIndex);
    if (~socketIndex) {
      connectionsArray.splice(socketIndex, 1);
    }
  });

  console.log('A new socket is connected!');
  connectionsArray.push(socket);


});

var updateSockets = function(data) {
  // adding the time of the last update
  data.time = new Date();
  console.log('Pushing new data to the clients connected ( connections amount = %s ) - %s', connectionsArray.length , data.time);
  // sending new data to all the sockets connected
  connectionsArray.forEach(function(tmpSocket) {
    tmpSocket.volatile.emit('notification', data);
  });
};