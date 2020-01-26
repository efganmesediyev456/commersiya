$(document).ready(function () {
    $(".device").change(function(){
        if ($(this).val() === "1") {
            $(".mac_address").show();
        } else if ($(this).val() === "0") {
            $(".mac_address").hide();
        }
    });
});

