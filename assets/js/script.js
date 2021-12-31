function volumeToggle(button) {
    var mutted = $(".previewVideo").prop("muted");
    $(".previewVideo").prop("muted",!mutted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnd(){
    $(".previewVideoContainer").toggle();
    $(".previewImage").toggle();
}