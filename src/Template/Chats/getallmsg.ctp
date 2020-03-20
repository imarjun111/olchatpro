<h1>hello</h1>

<table>
 <tr>
    <th>Time</th>
    <th>Text</th>
    <th>Author</th> 
</tr>
</thead>
  <tbody id="newtable">
 
  </tbody>
</table>

<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script>
 var socket = io.connect('http://localhost:8082'); //create connection

   socket.on('notification', function (data) { //console.log(data);
        var usersList = "";
        var userSData = "";
        var userBdata = "";
        $.each(data.users,function(index,user){
            usersList += "<tr><td>" + user.time + "</td>\n" +
                   "<td>" + user.text + "</td>\n" +
                   "<td>" + user.author + "</td>\n" +
                         "</tr>\n";                        
            }          
        });
        $('#newtable').html(usersList);

 </script>