$(function() {
    $(document).ready(function() {
        //Convert to iCheck checkboxes
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: "icheckbox_minimal-blue",
            radioClass: "iradio_minimal-blue",
        });

        $("img").on("error", function() {
            $(this).attr("src", baseUrl + "/uploads/default.png");
        });
    });
});