let bg = $("#bgPreview");
$("input[name='bgColor']").change(function () {
    let bgColor = $(this).val();
    bg.css('background-color', bgColor);
});

$("input[name='bgSize']").change(function () {
    let bgSize = $(this).val();
    bg.css('background-size', bgSize);
});

$("input[name='bgPosition']").change(function () {
    let bgPosition = $(this).val();
    bg.css('background-position', bgPosition);
});

$("input[name='bgRepeat']").change(function () {
    let bgRepeat = $(this).val();
    bg.css('background-repeat', bgRepeat);
});

$("input[name='bgPicture']").change(function() {
    readURL(this);
});

$("input[name='bgAnimation']").change(function () {
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            // $('#previewImg').attr('src', e.target.result);
            bg.css('background-image', 'url('+e.target.result+')');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

