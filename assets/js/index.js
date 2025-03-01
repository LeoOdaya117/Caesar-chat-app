let conversationInterval;

function fetch_user_list(){
    $.ajax({ 
        url: 'fetch_user_list.php', 
        method: 'GET', 
        dataType: 'json',
        success: function(response) {                       
            const list = document.querySelector('.list-group');
            list.innerHTML = ''; 
            response.forEach(account => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = account.full_name;
                
                // Create a button element
                const button = document.createElement('button');
                button.className = 'btn btn-sm rounded-circle';
                

                // Check the status and set the innerHTML accordingly
                if (account.status === 'Active') {
                    button.innerHTML = '<img src="assets/img/online.png" alt="logo" width="15" height="15">';
                    button.title = 'Online'; // Set the type attribute to 'button'
                } else {
                    button.innerHTML = '<img src="assets/img/offline.png" alt="logo" width="15" height="15">';
                    button.title = 'Offline'; // Set the type attribute to 'button'

                }
                
                // Append the button to the list item
                listItem.appendChild(button);
                
                // Append the list item to the list
                list.appendChild(listItem);
    
                listItem.addEventListener('click', function() {
                    document.getElementById('chat-heading').textContent = account.full_name;
                    
                    hideContact();
                    showConvo();
                    fetchConversation(account.full_name);
                    clearInterval(conversationInterval);
                    conversationInterval = setInterval(function() {
                        const currentContactId = extractContactIdFromHeading();
                        fetchConversation(currentContactId);
                    }, 2000); 
    
                    scrollToBottom();
                });
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
    
            const errorMessage = document.createElement('div');
            errorMessage.textContent = 'Error fetching user data';
            document.body.appendChild(errorMessage);
        }
    });
}


fetch_user_list();
fetch_gc_list();
clearInterval(conversationInterval);
conversationInterval = setInterval(function() {
    const currentContactId = extractContactIdFromHeading();
    fetch_user_list();
    fetch_gc_list();
}, 2000);



function fetchConversation(contactId) {
    $.ajax({
        url: 'fetch_conversation.php',
        method: 'GET',
        dataType: 'json',
        data: { contactId: contactId },
        success: function(response) {
            $('.chat-container').empty();
            if (response === "No_Record") {
                $('.chat-container').html('<div class="message no-message">No message history available.</div>');
            } else {
                response.forEach(message => {
                    const messageWrapper = $('<div>').addClass('message-wrapper');
                    const messageElement = $('<div>').addClass('message');
                    const messageContent = decryptMessage(message.message, 3);
                    const messageTimestamp = new Date(message.send_datetime).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true, month: 'short', day: 'numeric' });
                    var name = message.recipient_name;
  
                    if (message.user_id === currentUserID) {
                        messageWrapper.addClass('user-message'); // Align right
                        messageElement.addClass('sent').text(messageContent);
                    } else {
                        messageWrapper.addClass('other-message'); // Align left
                        const senderNameLabel = $('<div>').addClass('sender-name').html('<strong>' + name + '</strong>');
                        messageElement.append(senderNameLabel);
                        messageElement.append($('<div>').addClass('message-content').text(messageContent));
                    }
  
                    messageElement.append($('<div>').addClass('message-timestamp').text(messageTimestamp));
                    messageWrapper.append(messageElement);
                    $('.chat-container').append(messageWrapper);
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching conversation:', error);
        }
    });
    fetch_user_list();
    fetch_gc_list();
  }
  



function decryptMessage(encryptedMessage, shift) {
    let decryptedMessage = '';
    
    for (let i = 0; i < encryptedMessage.length; i++) {
        let charCode = encryptedMessage.charCodeAt(i);
        let decryptedChar = '';

        if (/[a-zA-Z]/.test(encryptedMessage[i])) {
            let baseCharCode = encryptedMessage[i] === encryptedMessage[i].toLowerCase() ? 97 : 65;
            decryptedChar = String.fromCharCode(((charCode - baseCharCode - shift + 26) % 26) + baseCharCode);
        } else if (/[0-9]/.test(encryptedMessage[i])) {
            decryptedChar = String.fromCharCode(((charCode - 48 - shift + 10) % 10) + 48);
        } else {
            decryptedChar = encryptedMessage[i];
        }

        decryptedMessage += decryptedChar;
    }
    
    return decryptedMessage;
}



scrollToBottom();

  function extractContactIdFromHeading() {
    const chatHeading = $('#chat-heading').text(); 
    return chatHeading;
  }


  function isMobileDevice() {
    return window.innerWidth <= 768; 
  }
  
  function hideContact() {
    if (isMobileDevice()) {
      document.querySelectorAll('.sidebar').forEach(element => {
        element.style.display = 'none';
      });
      console.log("Back clicked");
    }
  }
  function showContact() {
    if (isMobileDevice()) {
      document.querySelectorAll('.sidebar').forEach(element => {
        element.style.display = 'block';
      });
      console.log("Back clicked");
      document.querySelectorAll('.chat-area').forEach(element => {
        element.style.display = 'none';

      });

      document.querySelectorAll('.Home').forEach(element => {
        element.style.display = 'none';

      });
    }
  }
  

  function showConvo() {
    document.querySelectorAll('.chat-area').forEach(element => {
        element.style.display = 'block';

      });

      document.querySelectorAll('.Home').forEach(element => {
        element.style.display = 'none';

      });
  }

  function showhome() {
    document.querySelectorAll('.chat-area').forEach(element => {
        element.style.display = 'none';

      });

      document.querySelectorAll('.Home').forEach(element => {
        element.style.display = 'block';

      });
  }



  function sendMessage() {
    const message = $('#messageInput').val().trim();
    const contactName = extractContactIdFromHeading();

    $.ajax({
        url: 'fetch_gc.php',
        method: 'POST',
        data: {
            gc_name: contactName
        },
        success: function(response) {
            if (response.trim() === 'True') { // Adjusted comparison
                // Provide user feedback in a more user-friendly way than an alert
                console.log('Sending message in a GC...');
               sendGroupChatMessage(message, contactName);
            } else {
                sendDirectMessage(message, contactName);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching group chat information:', error);
        }
    });
}

function sendGroupChatMessage(message, contactName) {
    $.ajax({
        url: 'send_message_gc.php',
        method: 'POST',
        data: {
            message: message,
            gc_name: contactName
        },
        success: function(response) {
            console.log('Message sent successfully:', response);
            $('#messageInput').val('');
        },
        error: function(xhr, status, error) {
            console.error('Error sending group chat message:', error);
        }
    });
}

function sendDirectMessage(message, contactName) {
    $.ajax({
        url: 'send_message.php',
        method: 'POST',
        data: {
            message: message,
            recipient: contactName
        },
        success: function(response) {
            console.log('Direct message sent successfully:', response);
            $('#messageInput').val('');
        },
        error: function(xhr, status, error) {
            console.error('Error sending direct message:', error);
        }
    });
}

$('#send_message').click(function() {
    sendMessage(); 
  });
  
  $('#messageInput').keypress(function(event) {
    if (event.which === 13) {
      sendMessage(); 
    }
  });


  function getCurrentDateTime() {
    const currentDateTime = new Date().toISOString();
    return currentDateTime;
  }

  function scrollToBottom() {
    var chatContainer = document.querySelector('.chat-container');
    chatContainer.scrollTop = chatContainer.scrollHeight;
}


function fetch_gc_list(){
  $.ajax({ 
      url: 'fetch_gc_list.php', 
      method: 'GET', 
      dataType: 'json',
      success: function(response) {                       
          const list = document.querySelector('#chatroomlist'); // Changed the selector to target the correct ul element
          list.innerHTML = ''; 
          response.forEach(chatRoom => {
              const listItem = document.createElement('li');
              listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
              listItem.textContent = chatRoom.gc_name; // Adjusted to use the chat room name from the response
              
              // Create a button element
              const button = document.createElement('button');
              button.className = 'btn btn-sm rounded-circle';
              button.type = 'button'; // Set the type attribute to 'button'
              button.title = 'GC Settings'; // Set the type attribute to 'button'
              button.innerHTML = '<img src="assets/img/settings.png" alt="logo" width="15" height="15">';

                button.onclick = function() {
                    toggleModalForGC(chatRoom.gc_name);
                };
              // Append the button to the list item
              listItem.appendChild(button);
              // Append the list item to the list
              list.appendChild(listItem);
  
              listItem.addEventListener('click', function() {
                  document.getElementById('chat-heading').textContent = chatRoom.gc_name; // Adjusted to use the chat room name from the response
                  
                  hideContact();
                  showConvo();
                  fetchGCConversation(chatRoom.gc_name); // Adjusted to use the chat room ID from the response
                  clearInterval(conversationInterval);
                  conversationInterval = setInterval(function() {
                      const currentContactId = extractContactIdFromHeading();
                      fetchGCConversation(currentContactId);
                  }, 2000); 
  
                  scrollToBottom();
              });
          });
      },
      error: function(xhr, status, error) {
          console.error('Error:', error);
  
          const errorMessage = document.createElement('div');
          errorMessage.textContent = 'Error fetching chat room data'; // Updated error message
          document.body.appendChild(errorMessage);
      }
  });
}

  
function fetchGCConversation(GC_NAME) {
  $.ajax({
      url: 'fetch_GC_conversation.php',
      method: 'GET',
      dataType: 'json',
      data: { GC_NAME: GC_NAME },
      success: function(response) {
          $('.chat-container').empty();
          if (response === "No_Record") {
              $('.chat-container').html('<div class="message">No message history available.</div>');
          } else {
              response.forEach(message => {
                  

                  const messageElement = $('<div>').addClass('message');
                  const messageContent = decryptMessage(message.message, 3);
                  const messageTimestamp = new Date(message.send_datetime).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true, month: 'short', day: 'numeric' });
                  var name = message.full_name;
                  if (message.user_id === currentUserID) {
     
                      messageElement.addClass('user-message').text(messageContent);
                  } else {
                      
                      const senderNameLabel = $('<div>').addClass('sender-name').html('<strong>' + name + '</strong>');
                      messageElement.append(senderNameLabel);
                      messageElement.append($('<div>').addClass('message-content').text(messageContent));
                  }
                  messageElement.append($('<div>').addClass('message-timestamp').text(messageTimestamp));
                  $('.chat-container').append(messageElement);
              });
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching conversation:', error);
      }
  });
  fetch_user_list();
fetch_gc_list();
}

function toggleModal() {
  $('#addContactModal').modal('toggle');
}

function toggleModalForCreateGC() {
    $('#createGCModal').modal('toggle');
  }

function toggleModalForGC(gc_name) {

    fillGcTable(gc_name);
    $('#addMemberModal').modal('toggle');
}

function fillGcTable(gc_name){
    $.ajax({
        url: 'fetch_GC_members.php',
        method: 'POST',
        dataType: 'json',
        data: {
            gc_name: gc_name,
        },
        success: function(response) {
            $('#membertable tbody').empty();
            if (response && response.length > 0) {
                response.forEach(function(data) {
                    var row = '<tr>';
                    row += '<td>' + data.full_name + '</td>';
                    row += '</tr>';
                    $('#membertable tbody').append(row);
                });
            } else {
                $('#membertable tbody').append('<tr><td colspan="2">No data available</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
        }
    });
    
}


// ADD FRIEND FUNCTION
$(document).ready(function () {  
  $('#addFriendForm').submit(function (event) { 
      
      event.preventDefault();                 
      var form = document.getElementById('addFriendForm'); 
      var formData = new FormData(form); 


      Swal.fire({
        title: 'Confirm Decision',
        text: `Are you sure you want to add this User?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: `Yes`
    }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({ 

              url: 'addFriend.php', 
              method: 'POST', 
              data: formData, 
              processData: false, 
              contentType: false, 
              success: function (response) {                       
                  response = response.trim();
                if(response === "Success"){
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Adding Friend Successful",
                        showConfirmButton: true,
                    });
                    $('#addContactModal').modal('toggle');
                    fetch_user_list();
                    
                }
                else{
                    Swal.fire({
                        icon: "info",
                        title: "Result",
                        text: response,
                        showConfirmButton: true,
                    });
                }
                $('#addContactModal').modal('toggle');
              }
              
          }); 
        }
    });
      
      

  }); 
}); 

// CREATE GC FUNCTION
$(document).ready(function () {  
    $('#createGcForm').submit(function (event) { 
        
        event.preventDefault();                 
        var form = document.getElementById('createGcForm'); 
        var formData = new FormData(form); 
  
  
        Swal.fire({
          title: 'Confirm Decision',
          text: `Are you sure you want to add this User?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: `Yes`
      }).then((result) => {
          if (result.isConfirmed) {
  
            $.ajax({ 
  
                url: 'createGC.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function (response) {                       
                    response = response.trim();
                  if(response === "Success"){
                      Swal.fire({
                          icon: "success",
                          title: "Success",
                          text: "Creating GC Successful",
                          showConfirmButton: true,
                      });
                      $('#createGCModal').modal('toggle');
                      fetch_gc_list();
                      
                  }
                  else{
                      Swal.fire({
                          icon: "info",
                          title: "Result",
                          text: response,
                          showConfirmButton: true,
                      });
                  }
                  $('#createGCModal').modal('toggle');
                }
                
            }); 
          }
      });
        
        
  
    }); 
  }); 
  



function addToGC(username, gc_name) {

    var inputElement = document.getElementById('nameInput_gc');
    var username = inputElement.value;

    var gc_name = extractContactIdFromHeading();


    Swal.fire({
        title: 'Confirm Decision',
        text: `Are you sure you want to add this User?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: `Yes`
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'addToGC.php',
                method: 'POST',
                data: {
                    username: username,
                    gc_name: gc_name
                },
                success: function(response) {
                    response = response.trim();
                    var form = document.getElementById('addmemberToGC');
        
        
                    
                    if (response === "Success") {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Adding to GC Successful",
                            showConfirmButton: true,
                        });
                        
                        fillGcTable(gc_name);
                        fetch_gc_list();
                    }
                    else{
                        Swal.fire({
                            icon: "info",
                            title: "Result",
                            text: response,
                            showConfirmButton: true,
                        });
                        fillGcTable();
                    }
                    form.reset();
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "info",
                        title: "Result",
                        text: error,
                        showConfirmButton: true,
                    });
                    console.error('Error adding user to group chat:', error);
                }
            });

        }
    });
      
      


}

function deleteGC(){
    var gc_name = extractContactIdFromHeading();


    Swal.fire({
        title: 'Confirm Decision',
        text: `Are you sure you want to DELETE this GC?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: `Yes`
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'deleteGC.php',
                method: 'POST',
                data: {
                    gc_name: gc_name
                },
                success: function(response) {
                    response = response.trim();
                    
                    if (response === "Success") {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Successfully Deleted",
                            showConfirmButton: true,
                        });
                        
                        $('#addMemberModal').modal('toggle');
                        showhome();
                    
                        fetch_gc_list();
                    }
                    else{
                        Swal.fire({
                            icon: "info",
                            title: "Result",
                            text: response,
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "info",
                        title: "Result",
                        text: error,
                        showConfirmButton: true,
                    });
                    console.error('Error adding user to group chat:', error);
                }
            });

        }
    });
}
