<!DOCTYPE html>
<html>
<head>
    <title>
        Music Player
    </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <style>
        .list {
            height : 400px;
            overflow : auto;
            cursor:pointer;
        }

        .list li:hover {
            background-color:rgba(154, 246, 251, 0.14);
        }
        .play{
            background-color:#a7fda3;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12 text-center">
            <b><span id="nowPlaying">&nbsp;</span></b>
            <input type="range" class="slider form-control" id="range" value=0>
            <h4 id="time">0:00/0:00</h4>
            <button onclick="prev()" class="btn btn-default fa fa-fast-backward"></button>
            <button onclick="resume()" class="fa fa-play btn btn-default"></button>
            <button onclick="pause()" class="btn btn-primary fa fa-pause"></button>
            <button class="btn btn-danger fa fa-stop" onclick="stop()"></button>
            <button class="btn btn-default fa fa-fast-forward" onclick="next()"></button>
            <button class="btn btn-warning fa fa-random" onclick="shuffleToggle()"></button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <br>
                <div class="panel panel-primary">
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
