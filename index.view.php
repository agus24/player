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
                                <li class="list-group-item" data-index="<?=$key?>" onclick="setIndexAndPlay(<?=$key?>)"><span><?=($key+1).". ".$music?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>var music = <?=json_encode($files)?>;</script>
<script type="text/javascript" src="js/player.js"></script>
</body>
</html>
