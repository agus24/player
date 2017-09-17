<!DOCTYPE html>
<html>
<head>
    <title>
        Music Player
    </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        .list {
            height : 400px;
            overflow : auto;
            cursor:pointer;
        }
        .play{
            background-color:#a7fda3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12 text-center">
            <b><span id="nowPlaying">&nbsp;</span></b>
            <h4 id="time">0/0</h4>
            <button onclick="resume()" class="btn btn-primary">Resume/play</button>
            <button onclick="pause()" class="btn btn-default">Pause</button>
            <button class="btn btn-danger" onclick="stop()">Stop</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Playlist
                    </div>
                    <div class="panel-body">
                        <ul class="list list-group">
                            <?php foreach($files as $key => $music): ?>
                                <?php $music = explode("music/", $music)[1];?>
                                <li class="list-group-item" data-index="<?=$key?>" onclick="play(<?=$key?>)"><span><?=($key+1).". ".$music?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
    var music = <?=json_encode($files)?>;
    var np = new Audio;
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

    function play(index) {
        np.pause();
        np.src = music[index];
        np.play();
        setInterval(function() {
            var duration = parseTime(np.duration);
            var currentTime = parseTime(np.currentTime);
            $('#time').text(currentTime+"/"+duration);
            if(np.currentTime == np.duration) {
                if(music.length == index+1) {
                    play(0);
                } else {
                    play(index+1);
                }
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
</script>
</body>
</html>
