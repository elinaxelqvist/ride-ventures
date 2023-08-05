$(document).ready(function() {
    // Fetch comments from the server
    $.getJSON('getComments.php', function(data) {
        console.log(data);
        // Iterate over the comments and append them to the textarea
        var textarea = $('#comments');
        data.forEach(function(comment) {
            textarea.val(textarea.val() + comment.email + ": " + comment.comment + "\n");
        });
    }).fail(function(jqXHR, textStatus, errorThrown) { console.log("Failed:", errorThrown);});
});