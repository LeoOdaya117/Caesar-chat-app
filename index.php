<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}
$Fullname ="";
if(isset( $_SESSION['full_name'])){
    $Fullname = $_SESSION['full_name'];
}


include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Caesar Chat App</title>
  <link href="assets/img/chat-icon.png" rel="icon">
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" /> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
  
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/all.min.index.css">
  <script src="assets/js/sweetalert2@10.js"></script>

  <link rel="stylesheet" href="assets/css/index.css">
  <style>

  </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top nav-shadow mb-5 ">
  <div class="container">
    <a class="navbar-brand" href="index.php"><strong>Caesar Chat App</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="logout.php" class="btn"><strong><?php echo $Fullname;?></strong></a>
        </li>
        <li class="nav-item" title="Logout Button">
          <a href="logout.php" class="btn">
          <img src="assets/img/logout.png" alt="logo" width="20" height="20">
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid mt-5">
  <div class="row full-height mb-n5">
    <div class="col-md-3 sidebar p-0">
      <div class=" d-flex flex-column">

      <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Contact List</h5>
            <div>

                <button class="btn  btn-sm rounded-circle" onclick="toggleModal()" title="Add new Friend">
                  <img src="assets/img/realadd.png" alt="logo" width="30" height="30">
                </button>
            </div>
        </div>
        <div class="flex-grow-1 overflow-auto mb-0">
          <ul class="list-group list-group-flush text-dark" id="contactsList">
          </ul>
        </div>

        <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chat Rooms</h5>
            <div>
                <button class="btn btn-sm rounded-circle" title="Create new GC" onclick="toggleModalForCreateGC()">
                  <img src="assets/img/realadd.png" alt="logo" width="30" height="30">
                </button>
            </div>
        </div>

        <div class="overflow-auto mb-0">
        <ul class="list-group list-group-flush text-dark" id="chatroomlist">
                
            </ul>
        </div>
      </div>
      
    </div>

    <div class="col-md-9 Home p-0 mt-5">
        <div class="h-100 d-flex flex-column align-items-center">
            <!-- Logo Image -->
            <div class="p-3 border-bottom">
            <img src="assets/img/chat-icon.png" alt="logo" width="50" height="50">
            </div>
            <!-- Show Contact List Button -->
            <div class="p-3 border-bottom">
            <button class="btn btn-primary" onclick="showContact()">Show Contact List</button>
            </div>
            
        </div>
    </div>


    <div class="col-md-9 chat-area p-0">
      <div class="h-100 d-flex flex-column">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
            <div class="backbtn" >
                <button class="btn" onclick="showContact()">
                <img src="assets/img/back.png" alt="logo" width="30" height="30">

                </button>
            </div>
            <h5 class="mb-0" id="chat-heading">Loading...</h5>

        </div>

        <div class="flex-grow-1 chat-container p-3 overflow-auto mb-4 bg-light">
        </div>

        <div class="p-2 mt-n5 mb-n5">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Type your message..." id="messageInput">
            <div class="input-group-append">
              <button class="btn btn-primary" id="send_message"><i class="fas fa-paper-plane"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Friend</h5>
      </div>
      <form id="addFriendForm">
        <div class="modal-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Type Friend's Name..." id="nameInput" name="nameInput">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="toggleModal()">Close</button>
          <button type="submit" class="btn btn-primary">Add to Contact List</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ADD MEMBER IN IN GC -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">GC Settings</h5>
      </div>
      
        <div class="modal-body">
        <form id="addmemberToGC">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Type Friend's Name..." id="nameInput_gc" name="nameInput_gc">
            <button type="button" class="btn btn-primary" onclick="addToGC()">Add to GC</button>

          </div>
        </form>

          <div>
            <div class="card mt-3">
              <div class="card-header">
                <h5>Members</h5>
              </div>
              <div class="card-body">
                <table class="table table-borderless table-hover table-striped" id="membertable">
                   
                    <tbody>
                    

                    </tbody>
                </table>
              </div>
            </div>
            <div class="input-group mt-2">
                <button type="button" class="btn btn-danger btn-block" onclick="deleteGC()">DELETE GC</button>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="toggleModalForGC()">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL FOR CREATING NEW GC -->
<div class="modal fade" id="createGCModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New GC</h5>
      </div>
      <form id="createGcForm">
        <div class="modal-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Type GC Name..." id="name_of_gc" name="name_of_gc">
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="toggleModalForCreateGC()">Close</button>
          <button type="submit" class="btn btn-primary">Add to GC</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- jQuery -->


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- Bootstrap JavaScript -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script> -->

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/all.min.index.js"></script>
<script src="assets/js/index.js"></script>

<script>
  const currentUserID = <?php echo $_SESSION['id']; ?>;
</script>
</body>
</html>

