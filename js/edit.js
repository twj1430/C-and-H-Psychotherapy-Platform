    let btnEdit = document.querySelector('#edit');
    let a = document.querySelector('#nameFirst');
    let b = document.querySelector('#nameLast');
    let c = document.querySelector('#email');
    let d = document.querySelector('#phone');
    let e = document.querySelector('#address');
    let f = document.querySelector('#state');
    let g = document.querySelector('#postCode');
    let h = document.querySelector('#birth');
    let i = document.querySelector('#changePro');
    let j = document.querySelector('#uploadProfile');
    let k = document.querySelector('#city');
    let btnSubmit = document.querySelector('#submit');

    let infoBtn = document.querySelector('#infoBtn');
    let infoIcon = document.querySelector('#user_icon');
    let info_h4 = document.querySelector('#user_h4');

    let appointmentBtn = document.querySelector('#appointmentBtn');
    let appointmentIcon = document.querySelector('#appointment_icon');
    let appointment_h4 = document.querySelector('#appointment_h4');

    let paymentBtn = document.querySelector('#paymentBtn');
    let paymentIcon = document.querySelector('#payment_icon');
    let payment_h4 = document.querySelector('#payment_h4');

    let camera_icon = document.querySelector('#camera_icon');

    let showInfoPage = document.querySelector('#showInfo');
    let showAppointmentPage = document.querySelector('#showAppointment');
    let showPaymentPage = document.querySelector('#showPayment');

    infoBtn.addEventListener('click', () => {

      infoIcon.style.color = "black";
      info_h4.style.color = "black";
      showInfoPage.style.display = "block";

      appointmentIcon.style.color = "silver";
      appointment_h4.style.color = "silver";
      showAppointmentPage.style.display = "none";

      paymentIcon.style.color = "silver";
      payment_h4.style.color = "silver";
      showPayment.style.display = "none";

    });

    appointmentBtn.addEventListener('click', () => {

      infoIcon.style.color = "silver";
      info_h4.style.color = "silver";
      showInfoPage.style.display = "none";

      appointmentIcon.style.color = "black";
      appointment_h4.style.color = "black";
      showAppointmentPage.style.display = "block";

      paymentIcon.style.color = "silver";
      payment_h4.style.color = "silver";
      showPaymentPage.style.display = "none";



    });

    paymentBtn.addEventListener('click', () => {

      infoIcon.style.color = "silver";
      info_h4.style.color = "silver";
      showInfoPage.style.display = "none";

      appointmentIcon.style.color = "silver";
      appointment_h4.style.color = "silver";
      showAppointmentPage.style.display = "none";

      paymentIcon.style.color = "black";
      payment_h4.style.color = "black";
      showPaymentPage.style.display = "block";



    });


    //Edit
    btnEdit.addEventListener('click', () => {
      //create button

      //hide the edit button
      btnEdit.style.display = "none";
      btnSubmit.style.display = "inline-block";

      //remove all the readonly
      a.removeAttribute('readonly');
      a.setAttribute("form", "save");
      a.style.background = "white";
      a.style.border = "1px solid black";


      b.removeAttribute('readonly');
      b.setAttribute("form", "save")
      b.style.background = "white";
      b.style.border = "1px solid black";

      d.removeAttribute('readonly');
      d.setAttribute("form", "save");
      d.style.background = "white";
      d.style.border = "1px solid black";

      e.removeAttribute('readonly');
      e.setAttribute("form", "save");
      e.style.background = "white";
      e.style.border = "1px solid black";

      f.removeAttribute('readonly');
      f.setAttribute("form", "save");
      f.style.background = "white";
      f.style.border = "1px solid black";

      g.removeAttribute('readonly');
      g.setAttribute("form", "save");
      g.style.background = "white";
      g.style.border = "1px solid black";

      k.removeAttribute('readonly');
      k.setAttribute("form", "save");
      k.style.background = "white";
      k.style.border = "1px solid black";


      //show the input file
      i.style.display = "block";
      j.style.display = "block";
      camera_icon.style.display = "block";
    });

    let profile_Second = document.querySelector('#profile_iconSecond');
    let profileIcon_Second = document.querySelector('#profile_iconSecond');

    let appointment_Second = document.querySelector('#UserAppointmentSecond');
    let appointmentIcon_Second = document.querySelector('#appointment_iconSecond');

    let payment_Second = document.querySelector('#UserPaymentSecond');
    let paymentIcon_Second = document.querySelector('#payment_iconSecond');


    profile_Second.addEventListener('click', () => {
      profileIcon_Second.style.color = "black";


      appointmentIcon_Second.style.color = "white";

      paymentIcon_Second.style.color = "white";

      showInfoPage.style.display = "block";
      showAppointmentPage.style.display = "none";
      showPaymentPage.style.display = "none";
    });

    appointment_Second.addEventListener('click', () => {
      profileIcon_Second.style.color = "white";


      appointmentIcon_Second.style.color = "black";

      paymentIcon_Second.style.color = "white";

      showInfoPage.style.display = "none";
      showAppointmentPage.style.display = "block";
      showPaymentPage.style.display = "none";
    });

    payment_Second.addEventListener('click', () => {
      profileIcon_Second.style.color = "white";


      appointmentIcon_Second.style.color = "white";

      paymentIcon_Second.style.color = "black";

      showInfoPage.style.display = "none";
      showAppointmentPage.style.display = "none";
      showPaymentPage.style.display = "block";
    });

    // change image
    $(document).ready(function (e) {
      let $uploadfile = $('#uploadProfile');
      $uploadfile.change(function () {
        readURL(this);
      });

      $('#change_password').click(function () {
        $('#change_password').css({
          display: "none"
        });
        $('#password_oldPlace').css({
          display: "block"
        });
        $('#password_newPlace').css({
          display: "block"
        });

        $('#password_confPlace').css({
          display: "block"
        });
      });
      $('#change').click(function () {
        if (($('#password_new').val() == $('#password_confirm').val()) && ($('#password_new').val() != '') && ($('#password_confirm').val() != '') && ($('#password_new').val().length < 7)) {
          $('#password_feedback').css({
            display: "none"
          })
          $('#password_empty1').css({
            display: "none"
          })
          $('#password_empty2').css({
            display: "none"
          })
          $('#password_length').css({
            display: "block"
          });
          event.preventDefault();

        } else if (($('#password_new').val() == '') && ($('#password_confirm').val() != '')) {
          $('#password_feedback').css({
            display: "block"
          })
          $('#password_empty1').css({
            display: "block"
          })
          $('#password_empty2').css({
            display: "none"
          })
          $('#password_length').css({
            display: "none"
          });
          event.preventDefault();
        } else if (($('#password_confirm').val() == '') && ($('#password_new').val() != '')) {
          $('#password_feedback').css({
            display: "block"
          })
          $('#password_empty1').css({
            display: "none"
          })
          $('#password_empty2').css({
            display: "block"
          })
          $('#password_length').css({
            display: "none"
          });
          event.preventDefault();
        } else if (($('#password_confirm').val() == '') && ($('#password_new').val() == '')) {
          $('#password_feedback').css({
            display: "none"
          })
          $('#password_empty1').css({
            display: "block"
          })
          $('#password_empty2').css({
            display: "block"
          })
          $('#password_length').css({
            display: "none"
          });
          event.preventDefault();
        } else if (($('#password_new').val() != $('#password_confirm').val()) && ($('#password_new').val() != '') && ($('#password_confirm').val() != '') && ($('#password_new').val().length >= 7)) {
          $('#password_feedback').css({
            display: "block"
          })
          $('#password_empty1').css({
            display: "none"
          })
          $('#password_empty2').css({
            display: "none"
          })
          $('#password_length').css({
            display: "none"
          });
          event.preventDefault();
        } else if (($('#password_new').val() != $('#password_confirm').val()) && ($('#password_new').val() != '') && ($('#password_confirm').val() != '') && ($('#password_new').val().length < 7)) {
          $('#password_feedback').css({
            display: "block"
          })
          $('#password_empty1').css({
            display: "none"
          })
          $('#password_empty2').css({
            display: "none"
          })
          $('#password_length').css({
            display: "none"
          });
          event.preventDefault();
        }
      });

      $(".changing").click(function () {
        $("#changeThera1").val($(this).val());
        $("#cancelThera").val($(this).val());
      });

      $(".reviews").click(function () {
        $('#appointmentID').val($(this).attr('data-review'));
        $('#CurrentTherapistID').val($(this).attr('data-therapistID'));
        $('#therapist').val($(this).attr('data-therapistName'));
      });
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
          $("#user_image").attr('src', e.target.result);
          $("#camera_icon").css({
            display: "none"
          });
        }
        reader.readAsDataURL(input.files[0]);
      }
    }