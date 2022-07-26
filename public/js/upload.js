function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$("#uploadPhoto").change(function () {
    readURL(this);
});
