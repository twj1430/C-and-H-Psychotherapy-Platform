$(document).ready(function (e) {
    $(".thera").click(function () {
        var theraID = $(this).attr('data-theraid');
        var theraFName = $(this).attr('data-therafname');
        var theraLName = $(this).attr('data-theralname');
        var theraAbout = $(this).attr('data-theraabout');
        var theraGender = $(this).attr('data-theragender');
        var theraAge = $(this).attr('data-theraage');
        var theraEmail = $(this).attr('data-theraemail');
        var theraPhone = $(this).attr('data-theraphone');
        var theraIC = $(this).attr('data-theraic');
        var theraAddress = $(this).attr('data-theraaddress');
        var theraCity = $(this).attr('data-theracity');
        var theraPost = $(this).attr('data-therapost');
        var theraState = $(this).attr('data-therastate');
        var data_education = $(this).attr('data-education');
        var theraResume = $(this).attr('data-theraresume');
        var theraProfile = $(this).attr('data-theraprofile');
        // var theraMalay = $(this).attr('data-theraMalay');
        // var theraMandarin = $(this).attr('data-theraMandarin');
        // var theraEnglish = $(this).attr('data-theraEnglish');


        $("#image").attr('src', theraProfile);
        $('#id').val(theraID);
        $('#firstname').val(theraFName);
        $('#lastName').val(theraLName);
        $('#email').val(theraEmail);
        $('#about').val(theraAbout);
        $('#gender').val(theraGender);
        $('#age').val(theraAge);
        $('#phone').val(theraPhone);
        $('#ic').val(theraIC);
        $('#address').val(theraAddress);
        $('#city').val(theraCity);
        $('#postCode').val(theraPost);
        $('#state').val(theraState);
        $('#education').val(data_education);
        $("#resume").attr('href', theraResume);
        $("#resume").html(theraResume);
    });


    $('#searchText').keyup(function () {
        var txt = $('#searchText').val();
        $.ajax({
            url: "insert.php",
            method: "post",
            data: {
                search: txt
            },
            dataType: "text",
            success: function (data) {
                $('#results').html(data);
            }
        });

    });

    $(".custom-select").change(function () {
        var education = $(this).val();
        $.ajax({
            url: "insert.php",
            method: "post",
            data: {
                getEdu: education
            },
            dataType: "text",
            success: function (data) {
                $('#results').html(data);
            }
        });

    });

    $(".client").click(function () {
        var clientID = $(this).attr('data-clientid');
        var clientFName = $(this).attr('data-clientfname');
        var clientLName = $(this).attr('data-clientlname');
        var clientBirth = $(this).attr('data-clientbirth');
        var clientPhone = $(this).attr('data-clientphone');
        var clientAddress = $(this).attr('data-clientaddress');
        var clientCity = $(this).attr('data-clientcity');
        var clientPost = $(this).attr('data-clientpost');
        var clientState = $(this).attr('data-clientstate');
        var clientEmail = $(this).attr('data-clientemail');
        var clientImage = $(this).attr('data-clientimage');


        $("#image").attr('src', clientImage);
        $('#id').val(clientID);
        $('#firstname').val(clientFName);
        $('#lastName').val(clientLName);
        $('#birth').val(clientBirth);
        $('#email').val(clientEmail);
        $('#phone').val(clientPhone);
        $('#address').val(clientAddress);
        $('#city').val(clientCity);
        $('#postCode').val(clientPost);
        $('#state').val(clientState);
        $('#clientDetail').modal("show");
    });


    var total = 1;
    $('.custom-control-input').click(function () {
        var radioValue = $(this).val();

        switch (total) {
            case 1:
                var id = $('.choice1');
                var ques = $('.question1');
                if ($('#check1').val() == radioValue) {
                    $('#check1').prop('checked', true);
                } else {
                    $('#check2').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question2').css({
                    display: "block"
                });
                $('.choice2').css({
                    display: "block"
                });
                break;
            case 2:
                var id = $('.choice2');
                var ques = $('.question2');
                if ($('#check3').val() == radioValue) {
                    $('#check3').prop('checked', true);
                } else {
                    $('#check4').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                var checkChoice = $('#theraCheck').attr('data-value');
                if (checkChoice == "1") {
                    ++total;
                    $('.question3').css({
                        display: "block"
                    });
                    $('.choice3').css({
                        display: "block"
                    });
                } else {
                    total = 5;
                    $('.question5').css({
                        display: "block"
                    });
                    $('.choice5').css({
                        display: "block"
                    });
                }
                break;
            case 3:
                var id = $('.choice3');
                var ques = $('.question3');
                if ($('#check5').val() == radioValue) {
                    $('#check5').prop('checked', true);
                } else if ($('#check6').val() == radioValue) {
                    $('#check6').prop('checked', true);
                } else {
                    $('#check7').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question4').css({
                    display: "block"
                });
                $('.choice4').css({
                    display: "block"
                });
                break;
            case 4:
                var id = $('.choice4');
                var ques = $('.question4');
                if ($('#check8').val() == radioValue) {
                    $('#check8').prop('checked', true);
                } else if ($('#check9').val() == radioValue) {
                    $('#check9').prop('checked', true);
                } else {
                    $('#check10').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question5').css({
                    display: "block"
                });
                $('.choice5').css({
                    display: "block"
                });
                break;

            case 5:
                var id = $('.choice5');
                var ques = $('.question5');
                if ($('#check11').val() == radioValue) {
                    $('#check11').prop('checked', true);
                } else {
                    $('#check12').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question6').css({
                    display: "block"
                });
                $('.choice6').css({
                    display: "block"
                });
                break;

            case 6:
                var id = $('.choice6');
                var ques = $('.question6');
                if ($('#check13').val() == radioValue) {
                    $('#check13').prop('checked', true);
                } else if ($('#check14').val() == radioValue) {
                    $('#check14').prop('checked', true);
                } else {
                    $('#check15').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question7').css({
                    display: "block"
                });
                $('.choice7').css({
                    display: "block"
                });
                break;

            case 7:
                var id = $('.choice7');
                var ques = $('.question7');
                if ($('#check16').val() == radioValue) {
                    $('#check16').prop('checked', true);
                } else if ($('#check17').val() == radioValue) {
                    $('#check17').prop('checked', true);
                } else if ($('#check18').val() == radioValue) {
                    $('#check18').prop('checked', true);
                } else if ($('#check19').val() == radioValue) {
                    $('#check19').prop('checked', true);
                } else {
                    $('#check20').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question8').css({
                    display: "block"
                });
                $('.choice8').css({
                    display: "block"
                });
                break;

            case 8:
                var id = $('.choice8');
                var ques = $('.question8');
                if ($('#check21').val() == radioValue) {
                    $('#check21').prop('checked', true);
                } else {
                    $('#check22').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question9').css({
                    display: "block"
                });
                $('.choice9').css({
                    display: "block"
                });
                break;

            case 9:
                var id = $('.choice9');
                var ques = $('.question9');
                if ($('#check23').val() == radioValue) {
                    $('#check23').prop('checked', true);
                } else if ($('#check24').val() == radioValue) {
                    $('#check24').prop('checked', true);
                } else {
                    $('#check25').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question10').css({
                    display: "block"
                });
                $('.choice10').css({
                    display: "block"
                });
                break;

            case 10:
                var id = $('.choice10');
                var ques = $('.question10');
                if ($('#check26').val() == radioValue) {
                    $('#check26').prop('checked', true);
                } else if ($('#check27').val() == radioValue) {
                    $('#check27').prop('checked', true);
                } else {
                    $('#check28').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question11').css({
                    display: "block"
                });
                $('.choice11').css({
                    display: "block"
                });
                break;

            case 11:
                var id = $('.choice11');
                var ques = $('.question11');
                if ($('#check29').val() == radioValue) {
                    $('#check29').prop('checked', true);
                } else if ($('#check30').val() == radioValue) {
                    $('#check30').prop('checked', true);
                } else {
                    $('#check31').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question12').css({
                    display: "block"
                });
                $('.choice12').css({
                    display: "block"
                });
                $('#over').css({
                    display: "block"
                });
                break;

            case 12:
                var id = $('.choice12');
                var ques = $('.question12');
                if ($('#check32').val() == radioValue) {
                    $('#check32').prop('checked', true);
                } else if ($('#check33').val() == radioValue) {
                    $('#check33').prop('checked', true);
                } else if ($('#check34').val() == radioValue) {
                    $('#check34').prop('checked', true);
                } else {
                    $('#check35').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question13').css({
                    display: "block"
                });
                $('.choice13').css({
                    display: "block"
                });
                break;

            case 13:
                var id = $('.choice13');
                var ques = $('.question13');
                if ($('#check36').val() == radioValue) {
                    $('#check36').prop('checked', true);
                } else if ($('#check37').val() == radioValue) {
                    $('#check37').prop('checked', true);
                } else if ($('#check38').val() == radioValue) {
                    $('#check38').prop('checked', true);
                } else {
                    $('#check39').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question14').css({
                    display: "block"
                });
                $('.choice14').css({
                    display: "block"
                });
                break;

            case 14:
                var id = $('.choice14');
                var ques = $('.question14');
                if ($('#check40').val() == radioValue) {
                    $('#check40').prop('checked', true);
                } else if ($('#check41').val() == radioValue) {
                    $('#check41').prop('checked', true);
                } else if ($('#check42').val() == radioValue) {
                    $('#check42').prop('checked', true);
                } else {
                    $('#check43').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question15').css({
                    display: "block"
                });
                $('.choice15').css({
                    display: "block"
                });
                break;

            case 15:
                var id = $('.choice15');
                var ques = $('.question15');
                if ($('#check44').val() == radioValue) {
                    $('#check44').prop('checked', true);
                } else if ($('#check45').val() == radioValue) {
                    $('#check45').prop('checked', true);
                } else if ($('#check46').val() == radioValue) {
                    $('#check46').prop('checked', true);
                } else {
                    $('#check47').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question16').css({
                    display: "block"
                });
                $('.choice16').css({
                    display: "block"
                });
                break;

            case 16:
                var id = $('.choice16');
                var ques = $('.question16');
                if ($('#check48').val() == radioValue) {
                    $('#check48').prop('checked', true);
                } else if ($('#check49').val() == radioValue) {
                    $('#check49').prop('checked', true);
                } else if ($('#check50').val() == radioValue) {
                    $('#check50').prop('checked', true);
                } else {
                    $('#check51').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question17').css({
                    display: "block"
                });
                $('.choice17').css({
                    display: "block"
                });
                break;

            case 17:
                var id = $('.choice17');
                var ques = $('.question17');
                if ($('#check52').val() == radioValue) {
                    $('#check52').prop('checked', true);
                } else if ($('#check53').val() == radioValue) {
                    $('#check53').prop('checked', true);
                } else if ($('#check54').val() == radioValue) {
                    $('#check54').prop('checked', true);
                } else {
                    $('#check55').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question18').css({
                    display: "block"
                });
                $('.choice18').css({
                    display: "block"
                });
                break;

            case 18:
                var id = $('.choice18');
                var ques = $('.question18');
                if ($('#check56').val() == radioValue) {
                    $('#check56').prop('checked', true);
                } else if ($('#check57').val() == radioValue) {
                    $('#check57').prop('checked', true);
                } else if ($('#check58').val() == radioValue) {
                    $('#check58').prop('checked', true);
                } else {
                    $('#check59').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question19').css({
                    display: "block"
                });
                $('.choice19').css({
                    display: "block"
                });
                break;

            case 19:
                var id = $('.choice19');
                var ques = $('.question19');
                if ($('#check60').val() == radioValue) {
                    $('#check60').prop('checked', true);
                } else if ($('#check61').val() == radioValue) {
                    $('#check61').prop('checked', true);
                } else if ($('#check62').val() == radioValue) {
                    $('#check62').prop('checked', true);
                } else {
                    $('#check63').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question20').css({
                    display: "block"
                });
                $('.choice20').css({
                    display: "block"
                });
                break;

            case 20:
                var id = $('.choice20');
                var ques = $('.question20');
                if ($('#check64').val() == radioValue) {
                    $('#check64').prop('checked', true);
                } else if ($('#check65').val() == radioValue) {
                    $('#check65').prop('checked', true);
                } else if ($('#check66').val() == radioValue) {
                    $('#check66').prop('checked', true);
                } else {
                    $('#check67').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question21').css({
                    display: "block"
                });
                $('.choice21').css({
                    display: "block"
                });
                $('#over').css({
                    display: "none"
                });
                break;

            case 21:
                var id = $('.choice21');
                var ques = $('.question21');
                if ($('#check68').val() == radioValue) {
                    $('#check68').prop('checked', true);
                } else if ($('#check69').val() == radioValue) {
                    $('#check69').prop('checked', true);
                } else if ($('#check70').val() == radioValue) {
                    $('#check70').prop('checked', true);
                } else {
                    $('#check71').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question22').css({
                    display: "block"
                });
                $('.choice22').css({
                    display: "block"
                });
                break;

            case 22:
                var id = $('.choice22');
                var ques = $('.question22');
                if ($('#check72').val() == radioValue) {
                    $('#check72').prop('checked', true);
                } else {
                    $('#check73').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question23').css({
                    display: "block"
                });
                $('.choice23').css({
                    display: "block"
                });
                break;

            case 23:
                var id = $('.choice23');
                var ques = $('.question23');
                if ($('#check74').val() == radioValue) {
                    $('#check74').prop('checked', true);
                } else {
                    $('#check75').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question24').css({
                    display: "block"
                });
                $('.choice24').css({
                    display: "block"
                });
                break;

            case 24:
                var id = $('.choice24');
                var ques = $('.question24');
                if ($('#check76').val() == radioValue) {
                    $('#check76').prop('checked', true);
                } else {
                    $('#check77').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question25').css({
                    display: "block"
                });
                $('.choice25').css({
                    display: "block"
                });
                break;

            case 25:
                var id = $('.choice25');
                var ques = $('.question25');
                if ($('#check78').val() == radioValue) {
                    $('#check78').prop('checked', true);
                } else if ($('#check79').val() == radioValue) {
                    $('#check79').prop('checked', true);
                } else if ($('#check80').val() == radioValue) {
                    $('#check80').prop('checked', true);
                } else if ($('#check81').val() == radioValue) {
                    $('#check81').prop('checked', true);
                } else {
                    $('#check82').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question26').css({
                    display: "block"
                });
                $('.choice26').css({
                    display: "block"
                });
                break;

            case 26:
                var id = $('.choice26');
                var ques = $('.question26');
                if ($('#check83').val() == radioValue) {
                    $('#check83').prop('checked', true);
                } else {
                    $('#check84').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question27').css({
                    display: "block"
                });
                $('.choice27').css({
                    display: "block"
                });
                break;

            case 27:
                var id = $('.choice27');
                var ques = $('.question27');
                if ($('#check85').val() == radioValue) {
                    $('#check85').prop('checked', true);
                } else if ($('#check86').val() == radioValue) {
                    $('#check86').prop('checked', true);
                } else if ($('#check87').val() == radioValue) {
                    $('#check87').prop('checked', true);
                } else if ($('#check88').val() == radioValue) {
                    $('#check88').prop('checked', true);
                } else if ($('#check89').val() == radioValue) {
                    $('#check89').prop('checked', true);
                } else {
                    $('#check90').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question28').css({
                    display: "block"
                });
                $('.choice28').css({
                    display: "block"
                });
                break;

            case 28:
                var id = $('.choice28');
                var ques = $('.question28');
                if ($('#check91').val() == radioValue) {
                    $('#check91').prop('checked', true);
                } else {
                    $('#check92').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question29').css({
                    display: "block"
                });
                $('.choice29').css({
                    display: "block"
                });
                break;

            case 29:
                var id = $('.choice29');
                var ques = $('.question29');
                if ($('#check93').val() == radioValue) {
                    $('#check93').prop('checked', true);
                } else {
                    $('#check94').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                ++total;
                $('.question30').css({
                    display: "block"
                });
                $('.choice30').css({
                    display: "block"
                });
                break;

            case 30:
                var id = $('.choice30');
                var ques = $('.question30');
                if ($('#check95').val() == radioValue) {
                    $('#check95').prop('checked', true);
                } else if ($('#check96').val() == radioValue) {
                    $('#check96').prop('checked', true);
                } else {
                    $('#check97').prop('checked', true);
                }
                var checkChoice = $('#theraCheck').attr('data-value');
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                if (checkChoice == "1") {
                    ++total;
                    $('.question31').css({
                        display: "block"
                    });
                    $('.choice31').css({
                        display: "block"
                    });
                } else {
                    $('#finish1').css({
                        display: "block"
                    });
                    $('#complete').css({
                        display: "block"
                    });
                }
                break;

            case 31:
                var id = $('.choice31');
                var ques = $('.question31');
                if ($('#check98').val() == radioValue) {
                    $('#check98').prop('checked', true);
                } else if ($('#check99').val() == radioValue) {
                    $('#check99').prop('checked', true);
                } else {
                    $('#check100').prop('checked', true);
                }
                id.css({
                    display: "none"
                });
                ques.css({
                    display: "none"
                });
                $('#complete').css({
                    display: "block"
                });
                $('#finish').css({
                    display: "block"
                });
                break;
        }
    });
});

var controller = new ScrollMagic.Controller();
var scene1 = new ScrollMagic.Scene({
    triggerElement: '.arti-contentWhole1'
}).setClassToggle('.arti-contentWhole1', 'show').addTo(controller);

var scene2 = new ScrollMagic.Scene({
    triggerElement: '.arti-contentWhole2'
}).setClassToggle('.arti-contentWhole2', 'show').addTo(controller);

var scene3 = new ScrollMagic.Scene({
    triggerElement: '.arti-contentWhole3'
}).setClassToggle('.arti-contentWhole3', 'show').addTo(controller);