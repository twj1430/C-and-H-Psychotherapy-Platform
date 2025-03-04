<section id="edit">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLongTitle">Edit Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="inverse">
            <img class="camera-icon" src="images/camera-solid.svg" alt="camera">
            <img src="<?php echo $_SESSION['profileImage'] ?>" style="width: 200px; height: 200px;margin-bottom:10px;" class="img rounded-circle" alt="profile" id="image">
            <small class="form-text text-black-50" style="text-align:center;padding-right:10px;">Choose Image</small>
            <input type="file" class="form-control-file" name="profileUpload" id="edit-profile" form="edit-form">
          </div>
          <form id="edit-form" method="post" enctype="multipart/form-data">
            <div class="row" style="margin-top:30px;">
              <div class="col">
                <h4 style="color:rgb(34, 19, 48);margin-left: 18px;">First Name</h4>
                <input type="text" required name="name" id="name" class="form-control" placeholder="username" style="max-width: 250px;margin-left: 15px;">
              </div>

              <div class="col">
                <h4 style="color:rgb(34, 19, 48)">Last Name</h4>
                <input type="text" required name="lastName" id="lastName" class="form-control" placeholder="username" style="max-width: 250px;">
              </div>
            </div>

            <div class="col">
              <h4>Birthday</h4>
              <input type="date" required name="birth" id="birth" class="form-control" value="<?php echo $_SESSION['birth'] ?>">
            </div>

            <div class="col">
              <h4>Phone</h4>
              <input type="tel" required name="phone" id="phone" class="form-control" placeholder="010-12345678" pattern="[0-9]{3}-[0-9]{7}" value="<?php echo $_SESSION['phone'] ?>">
            </div>

            <div class="col" style="margin-bottom:10px;">
              <h4>Address</h4>
              <input type="text" required name="address" id="address" class="form-control" placeholder="address" value="<?php echo $_SESSION['address'] ?>">
            </div>

            <div class="col" style="margin-bottom:10px;">
              <h4 style="color:rgb(34, 19, 48)">State</h4>
              <input type="text" required name="state" id="state" class="form-control" placeholder="address">
            </div>

            <div class="col" style="margin-bottom:10px;">
              <h4 style="color:rgb(34, 19, 48)">Post Code</h4>
              <input type="text" required name="postCode" id="postCode" class="form-control" placeholder="address">
            </div>

            <div class="col">
              <h4>Password</h4>
              <input type="password" required name="password" id="password" class="form-control" placeholder="password">
            </div>

            <div class="col" style="margin-bottom:10px;">
              <h4>Confirm Password</h4>
              <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="confirm password">
              <small id="confirm_error" class="text-danger"></small>
            </div>


            <div class="modal-footer">
              <input type="submit" class="form-control" name="edit" value="Save" id="edit" onclick="return confirm('Confirm to change?')">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(e) {

      let $uploadfile = $('#edit .modal .modal-dialog .modal-content .modal-body input[type="file"]');

      $uploadfile.change(function() {
        readURL(this);
      });
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
          $("#edit .modal .modal-dialog .modal-content .modal-body .img").attr('src', e.target.result);
          $("#edit .modal .modal-dialog .modal-content .modal-body .camera-icon").css({
            display: "none"
          });
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

  <section>