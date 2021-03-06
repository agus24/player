var np = new Audio;
var index = -1;
var shuffle = false;

function generateList() {
    var html = "";
    $.each(music,function(key,music) {
        music = music.split('music/')[1];
        html += '<li class="list-group-item" data-index="'+key+'" onclick="setIndexAndPlay('+key+')"><span>'+(parseInt(key)+1)+'. '+music+'</span></li>';
    });
    $('#playlist').empty();
    $('#playlist').append(html);
}

generateList();

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

function next() {
    stop();
    index++;
    play();
}

function prev() {
    stop();
    index--;
    play();
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
        var percentage = np.currentTime / np.duration * 100;
        $('#time').text(currentTime+"/"+duration);
        if(parseInt(np.currentTime) == parseInt(np.duration)) {
            if(shuffle) {
                index = shuffleIndex();
            }
            else {
                index++;
            }
            console.log(music.length)
            console.log(index)
            if(music.length == index) {
                index = 0;
            }

            play();
        }

        $('#range').val(percentage)
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

$('#range').change(function() {
    var value = $(this).val();
    np.currentTime = np.duration * value / 100;
});

function shuffleIndex()
{
    var rand = Math.floor(Math.random() * (25 - 0) + 0);

    if(rand == index) {
        shuffleIndex();
    }
    else {
        return rand;
    }
}
function shuffleToggle() {
    if(shuffle) {
        shuffle = false;
    } else {
        shuffle = true;
    }
}
