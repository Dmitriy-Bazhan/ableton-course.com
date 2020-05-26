(function () {
    let param =  "../../storage/video/" + $('#player').attr('data-file') + ".mp4";
    jwplayer("player").setup({
        file: param
    });
}());


