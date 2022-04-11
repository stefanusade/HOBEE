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
    $("#history").hide();
    $("#btn-profile").click(function(){
        $("#profile").show();
        $("#history").hide();
    });
    $("#btn-history").click(function(){
        $("#history").show();
        $("#profile").hide();
    });
});

$(document).ready(function(){
    $("#supplier").hide();
    $("#link-admin").addClass('active');
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
$(document).ready(function() {
	$('#basic-datatables').DataTable({
	});
});