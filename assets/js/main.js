$(document).ready(function () {
  $("#showHide").click(function () {
      if ($("#password").attr("type") == "password"){
          $("#password").attr("type", "text");
      }else{
          $("#password").attr("type", "password");
      }
  });
});

$(document).ready(function() {
    $('#select-data').select2({theme: 'bootstrap-5'});
});

$(document).ready(function(){
    var hash = window.location.hash;
    if(hash===''){
        $("#profile").hide();
        $("#order").hide();
    }else if(hash=='#dashboard'){
        $("#dashboard").show();
        $("#profile").hide();
        $("#order").hide();
    }else if(hash=='#profile'){
        $("#dashboard").hide();
        $("#profile").show();
        $("#order").hide();
    }else if(hash=='#order'){
        $("#dashboard").hide();
        $("#profile").hide();
        $("#order").show();
    }
    $("#btn-dashboard").click(function(){
        $("#dashboard").show();
        $("#profile").hide();
        $("#order").hide();
    });
    $("#btn-profile").click(function(){
        $("#dashboard").hide();
        $("#profile").show();
        $("#order").hide();
    });
    $("#btn-order").click(function(){
        $("#dashboard").hide();
        $("#profile").hide();
        $("#order").show();
    });
});

$(document).ready(function(){
    var hash = window.location.hash;
    if(hash===''){
        $("#supplier").hide();
        $("#link-admin").addClass('active');
    }
    $("#btn-admin").click(function(){
        $("#admin").show();
        $("#supplier").hide();
        $("#link-admin").addClass('active');
        $("#link-supplier").removeClass('active');
    });
    $("#btn-supplier").click(function(){
        $("#supplier").show();
        $("#admin").hide();
        $("#link-supplier").addClass('active');
        $("#link-admin").removeClass('active');
    });
});