$(document).ready(function() {
    function toggle_modal(e) {
        if(e == "on") {
            $(".modal").css("background-color", "rgba(0,0,0,0.25)");
        }
        else if(e == "off") {
            $(".modal").css("background-color", "rgba(0,0,0,0)");
            $(".new-recipe-container").css("bottom", "-43em");
            $("#add-recipe-button").show();
        }
    }

    // Make sure the modal is scrolled to the top when it loads
    $(".new-recipe-container").scrollTop();

    // Close the modal when it is clicked outside of
    $(".modal").click(function() {
        toggle_modal("off");
    });

    // Close the modal when the X is clicked
    $(".exit").click(function() {
        toggle_modal("off");
    });

    // Turn on the modal dimmer when the new recipe button is clicked
    $("#add-recipe-button").click(function(e) {
        e.preventDefault();
        toggle_modal("on");
        $(".new-recipe-container").css("bottom", "0");
        $(this).hide();
    });

    // Submit form data via AJAX when  new recipe form is submitted
    $("#new-recipe-form").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);

        /*$.post("new.php",
                formData,
                function(data) {
                    if(data == "Recipe successfully added to database!") {
                        $("#new-recipe-form")[0].reset();
                        $(".recipe-form-container .success").text(data).show();
                    } else {
                        $(".recipe-form-container .failure").text(data).show();
                    }
                }
        );*/

        $.ajax({
            url: "new.php",
            type: "POST",
            data: formData,
            success: function(data) {
                if(data == "Recipe successfully added to database!") {
                    $("#new-recipe-form")[0].reset();
                    $(".recipe-form-container .success").text(data).show();
                } else {
                    $(".recipe-form-container .failure").text(data).show();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    // Clear the form when the "Clear Recipe" button is clicked
    $(".cancel").click(function() {
        $(this).parent("form")[0].reset();

        // Clear the TinyMCE editors
        var editors = tinymce.get();
        for(var i = 0; i < editors.length; i++) {
            editors[i].setContent('');
        }
    });
});