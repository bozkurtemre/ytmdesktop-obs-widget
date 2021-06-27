<!-- Youtube Music Desktop App Now Playing Widget created by Emre Bozkurt -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YTMusic Now Playing</title>
    <style>
        #container {
            width: 100vw;
            height: 100vh;
            display: flex;
        }

        #holder {
            position: relative;
            width: 250px;
            height: 330px;
            overflow: hidden;
        }

        #holder.active > img {
            transform: translateY(260px);
            transition: 0.2s cubic-bezier(0.62, 0.28, 0.23, 0.99);
        }

        #holder.active .info_box img {
            transform: translateX(-4px);
            transition: 0.2s cubic-bezier(0.62, 0.28, 0.23, 0.99);
        }

        #holder.active .info_box .info {
            transform: translateX(7px) translateY(2px);
            transition: 0.2s cubic-bezier(0.62, 0.28, 0.23, 0.99);
        }

        #holder #before {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 5;
            width: 26px;
            height: 26px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            transition: 0.2s;
        }

        #holder #before:hover {
            opacity: 1;
            transition: 0.2s;
        }

        #holder #before.hide {
            opacity: 0;
        }

        #holder #before:before {
            content: "";
            position: absolute;
            top: 8px;
            left: 9px;
            width: 1px;
            height: 12px;
            background-color: white;
            transform: rotate(-40deg);
        }

        #holder #before:after {
            content: "";
            position: absolute;
            top: 8px;
            left: 16px;
            width: 1px;
            height: 12px;
            background-color: white;
            transform: rotate(40deg);
        }

        #holder #small_before {
            position: absolute;
            top: 18px;
            left: 46px;
            z-index: 5;
            width: 18px;
            height: 18px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            transition: 0.2s;
        }

        #holder #small_before:hover {
            opacity: 1;
            transition: 0.2s;
        }

        #holder #small_before.hide {
            opacity: 0;
        }

        #holder #small_before:before {
            content: "";
            position: absolute;
            top: 4px;
            left: 6px;
            width: 1px;
            height: 8px;
            background-color: white;
            transform: rotate(40deg);
        }

        #holder #small_before:after {
            content: "";
            position: absolute;
            top: 4px;
            left: 11px;
            width: 1px;
            height: 8px;
            background-color: white;
            transform: rotate(-40deg);
        }

        #holder > img {
            position: absolute;
            top: 0;
            width: 250px;
            height: 250px;
            z-index: 1;
            transition: 0.2s cubic-bezier(0.62, 0.28, 0.23, 0.99);
        }

        #holder > img:hover + #before {
            opacity: 1;
            transition: 0.2s;
        }

        #holder .info_box {
            display: flex;
            flex-direction: row;
            bottom: 0;
            width: 250px;
            height: 65px;
            padding: 5px 17px 2px;
            background: #333;
            z-index: 2;
        }

        #holder .info_box img {
            width: 56px;
            height: 56px;
            transform: translateX(-80px);
            transition: 0.2s cubic-bezier(0.62, 0.28, 0.23, 0.99);
        }

        #holder .info_box img:hover + #small_before {
            opacity: 1;
            transition: 0.2s;
        }

        #holder .info_box .info {
            transform: translateX(-55px) translateY(2px);
            transition: 0.2s cubic-bezier(0.62, 0.28, 0.23, 0.99);
        }

        #holder .info_box .info h1 {
            font-family: "Hind Guntur", sans-serif;
            font-weight: 300;
            font-size: 17px;
            line-height: 10px;
            color: #fff;
        }

        #holder .info_box .info h1 span {
            position: relative;
            margin-left: 12px;
            top: 2px;
        }

        #holder .info_box .info h1 span:before {
            content: "";
            background-color: lightgreen;
            width: 1px;
            height: 14px;
            position: absolute;
            transform: rotate(40deg) translateY(-10px);
        }

        #holder .info_box .info h1 span:after {
            content: "";
            background-color: lightgreen;
            width: 1px;
            height: 6px;
            position: absolute;
            transform: rotate(-40deg);
        }

        #holder .info_box .info h2 {
            font-family: "Hind Guntur", sans-serif;
            font-weight: 200;
            font-size: 14px;
            color: #ddd;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        var refreshInterval = 30000;

        function checkUpdate() {
            setTimeout(function () {
                location.reload();
            }, refreshInterval);
        }

        $(document).ready(function () {
            checkUpdate();
        });
    </script>
</head>
<body>
<?php
$line = '';
$accname = 'Emre'; // Change this to your pc user name
$f = fopen('file:///C:/Users/' . $accname . '/AppData/Roaming/youtube-music-desktop-app/logs/main.log', 'r');
$cursor = -1;
fseek($f, $cursor, SEEK_END);
$char = fgetc($f);
//Trim trailing newline characters in the file
while ($char === "\n" || $char === "\r") {
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
}
//Read until the next line of the file begins or the first newline char
while ($char !== false && $char !== "\n" && $char !== "\r") {
    //Prepend the new character
    $line = $char . $line;
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
}
$full = substr($line, 41, strlen($line));
preg_match_all('@(.*?) -@', $full, $matches);
$song = $matches[1][0];
$artist = str_replace($matches[0][0], '', $full);
?>
<div id="container">
    <div id="holder">
        <div class="info_box">
            <img/>
            <div id="small_before"></div>
            <div class="info">
                <h1><?php echo mb_strimwidth($song, 0, 25, "..."); ?></h1>
                <h2 style="color: #1DB954;"><?php echo mb_strimwidth($artist, 0, 30, "..."); ?></h2>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("before").addEventListener("click", function () {
        document.getElementById("small_before").classList.remove("hide");
        document.getElementById("before").classList.add("hide");
        document.getElementById("holder").classList.add("active");
    });
    document.getElementById("small_before").addEventListener("click", function () {
        document.getElementById("small_before").classList.add("hide");
        document.getElementById("before").classList.remove("hide");
        document.getElementById("holder").classList.remove("active");
    });
</script>
</body>
</html>