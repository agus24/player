var np = new Audio;
var index = -1;
function stop() {
    np.pause();
    np.currentTime = 0;
}
function resume() {
    np.play();
}

function pause() {
    np.pause();
}

function setIndexAndPlay(idx) {
    index = idx;
    play();
}

function play() {
    np.pause();
    np.src = music[index];
    np.play();
    setInterval(function() {
        var duration = parseTime(np.duration);
        var currentTime = parseTime(np.currentTime);
        $('#time').text(currentTime+"/"+duration);
        if(parseInt(np.currentTime) == parseInt(np.duration)) {
            index++;
            console.log(music.length)
            console.log(index)
            if(music.length == index) {
                index = 0;
            }

            play();
        }
    }, 1000)
    $('#nowPlaying').empty();
    var text = music[index].split('music/')[1];
    $('#nowPlaying').text(text);
    $('li').each(function() {
        $(this).removeClass('play');
        if($(this).data('index') == index) {
            $(this).addClass('play');
        }
    });
}

function parseTime(audio) {
    var mins = Math.floor(audio / 60);
    var secs = Math.floor(audio % 60);
    if (secs < 10) {
    secs = '0' + String(secs);
    }
    return (mins + ':' + secs);
}
