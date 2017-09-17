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
            <h4 id="time">0:00/0:00</h4>
            <button onclick="prev()" class="btn btn-default">Prev</button>
            <button onclick="resume()" class="btn btn-success">Resume/play</button>
            <button onclick="pause()" class="btn btn-primary">Pause</button>
            <button class="btn btn-danger" onclick="stop()">Stop</button>
            <button class="btn btn-default" onclick="next()">Next</button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Playlist
                    </div>
                    <div class="panel-body">
                        <ul class="list list-group" id="playlist"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <br>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Downloader
                    </div>
                    <div class="panel-body">
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Youtube Url" id="link">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="download">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
    var music = <?=json_encode($files)?>;
    $('#download').click(function() {
        $.ajax({
            async : true,
            url : "index.php",
            data : {
                "req" : "download",
                "link" : $('#link').val()
            },
            type : "POST",
            success : function() {
                $.ajax({
                    async : true,
                    url : "index.php",
                    data : {
                        req : "getData"
                    },
                    type : "POST",
                    success : function(result) {
                        var data = JSON.parse(result);
                        music = data;
                        generateList();
                    }
                })
            }
        });
    });
</script>
<script type="text/javascript" src="js/player.js"></script>
</body>
</html>
