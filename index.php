<?php

include 'functions.php';

$mystream = new SimpleStream();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>SofaRadio| Official SHIT</title>
    <meta name="description" content="Free Radio, YAGWUD, HipHop">
    <meta name="google-site-verification" content="2KC6nTlKXS1xgG15jEm0F67bnvosRzSYjOXX8G4eCGM" />

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/icons/favicon-16x16.png">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 


    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <style>
        body{
            font-family: 'Noto Sans Mono', monospace;
        }
        h2{
            margin-bottom: 20px;
        }
        .jumbotron{
            background-color: black;
            color:  white;
        }
        .tracklist{
            max-height: 600px;
            overflow: scroll;
        }
/*
        .btn{
            font-size: 18px;
        }
*/
        .btn-large{
            font-size: 24px;
            /*padding: 5px 40px;*/
        }

        footer{
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <header class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">        
                    <div class="pagetitle"><h1>Sofa:Radio</h1></div>
                </div>
            </div>
        </div>
    </header>

    <!--div class="container">
        <div class="row">
            <div class="col-md-12">
                <img class="img-responsive" src="/assets/images/desk2.jpeg" />
            </div>
        </div>
    </div-->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Stream:</h2>
            </div>
            <?php if( $mystream->is_stream_running('radio.odowok.com','8000') ): ?>

            <?php $streaminfo = $mystream->get_stream_info('radio.odowok.com','8000'); ?>
            
                <div class="col-md-12">
                    <h3><?= $streaminfo['server_name']; ?></h3>
                    <p><?= $streaminfo['server_description']; ?></p>
                </div>
                <div class="col-md-12">
                    <p>Start: <?= $streaminfo['stream_start']; ?></p>
                </div>
                <div class="col-md-6">
                    <audio src="https://radio.odowok.com:9005/stream" controls ></audio>
                </div>
                <div class="col-md-6">
                    <p>Problem streaming <a target="_blank" href="<?= $streaminfo['listenurl']; ?>">click here</a></p>

                    <!--p><a class="btn btn-success btn-large" target="_blank" href="<?= $streaminfo['listenurl']; ?>">PLAY</a></p-->
                </div>
            <?php else: ?>
                <div class="col-md-12">
                    <h3>Stream is offline</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Tracklist:</h2>
                <div class="tracklist">
                <?php
                $tracklist = $mystream->get_stream_log("/var/log/icecast/playlist.log");
                foreach( array_reverse($tracklist) as $track ){
                    echo $track['date'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $track['title'] . '</br>';
                }

                ?>
                </div>

            </div>
        </div>
    </div>


    <footer class="container">
        <small>Built by <a href="https://www.sofasurfer.org" title="Sofasurfer.org" target="_blank">sofasurfer.org</a></small>
    </footer>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>


    </script>
</body>
</html>