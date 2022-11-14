<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css">
  <meta http-equiv="refresh" content="60" charset="utf-8">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
</head>

<body>
  <h1 style="text-align:center; font-family: 'Brush Script MT', cursive; font-size:50px; margin-bottom:0px;">Audiovisual Tool</h1>
  <div class="center-screen">
    <div class="float-container">
      <div class="first-box">
        <form action="/audiovisual.php">
          <input type="text" id="ylink" name="ylink" placeholder="https://www.youtube.com/watch..." required>
          <input type="submit" value="Add" name="add" class="btn">
        </form>
        <br>
        <iframe src="youtube-dl.txt" width=360 height=400></iframe>
        <br>
        <a href="audiovisual.php?clear">
          <button class="btn" style="padding-left: 20px;padding-right: 20px;">Clear</button>
        </a>
        <div style="display:flex; float:right; margin-bottom: 4px; margin-right: 4px; margin-left: 0px;">
          <form action="/audiovisual.php">
            <input type="hidden" id="video" name="video" value="0">
            <input type="checkbox" id="video" name="video" value="1" checked>
            <label for="video"> Video</label>
            <input type="hidden" id="audio" name="audio" value="0">
            <input type="checkbox" id="audio" name="audio" value="1" checked>
            <label for="audio"> Audio</label>
            <input style="margin-left:10px;" type="submit" value="Download" name="job" class="btn">
          </form>
        </div>
        <br>
        <iframe src="/config.json" width=360 height=100></iframe>
      </div>
      <div class="second-box">
        <form action="/audiovisual.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file">
          <input type="submit" value="Convert" name="convert" class="btn">
        </form>
        <br>
        <div>
          <a href="audiovisual.php?mp4">
            <button class="btn">MP4</button>
          </a>
          <a href="audiovisual.php?mov">
            <button class="btn">MOV</button>
          </a>
          <a href="audiovisual.php?mkv">
            <button class="btn">MKV</button>
          </a>
          <a href="audiovisual.php?avi">
            <button class="btn">AVI</button>
          </a>
        </div>
        <br>
        <div class="btn-group">
          <a href="audiovisual.php?wav">
            <button class="btn">WAV</button>
          </a>
          <a href="audiovisual.php?ogg">
            <button class="btn">OGG</button>
          </a>
          <a href="audiovisual.php?mp3">
            <button class="btn">MP3</button>
          </a>
          <a href="audiovisual.php?flac">
            <button class="btn">FLAC</button>
          </a>
        </div>
        <iframe src="/audiovisual.txt" width=360 height=325 style="margin-top:6px;"></iframe>
        <br>
        <a href="audiovisual.php?stop">
          <button style="width: 44%; margin-top: 4px;" class="btn">Stop running jobs</button>
        </a>
        <a href="Downloads/">
          <button style="width: 44%; margin-top: 4px;" class="btn">Downloads</button>
        </a>
        <form action="/audiovisual.php">
          <input style="width: 35%;" type="text" id="telegram" name="telegram" placeholder="Telegram Token..." required>
          <input style="width: 35%;" type="text" id="telegram_chat" name="telegram_chat" placeholder="Telegram Chat ID" required>
          <input type="submit" value="Save" class="btn">
        </form>
      </div>
    </div>
  </div>
  <a target="_blank" href="https://www.buymeacoffee.com/Prochadzka">
    <button class=btn-coffee>Buy me a coffee!</button>
  </a>
</body>

</html>
<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
function add()
{
  $ylinks = $_GET['ylink'];
  $myfile = fopen("youtube-dl.txt", "a+") or die("Unable to open file!");
  fwrite($myfile, $ylinks . PHP_EOL);
  fclose($myfile);
  header('Location: /audiovisual.php');
}
function job()
{
  $video = $_GET['video'];
  $audio = $_GET['audio'];
  if ($video == 0 && $audio == 0) {
    echo '<script> alert("You did this on purpose ? Tick off the check box Video or Audio !")</script>';
  } else {
    $jsonString = file_get_contents('config.json');
    $data = json_decode($jsonString, true);
    $data[0]['job'] = "running";
    $data[0]['video'] = "$video";
    $data[0]['audio'] = "$audio";
    $newJsonString = json_encode($data);
    file_put_contents('config.json', $newJsonString);
    echo exec('sudo bash youtube-dl.sh > /dev/null 2>&1 &');
    header('Location: /audiovisual.php');
  }
}

if (isset($_GET['add'])) {
  add();
}
if (isset($_GET['job'])) {
  job();
}

function mp4()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "mp4";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['mp4'])) {
  mp4();
}

function mov()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "mov";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['mov'])) {
  mov();
}

function mkv()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "mkv";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['mkv'])) {
  mkv();
}

function avi()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "avi";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['avi'])) {
  avi();
}

function wav()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "wav";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['wav'])) {
  wav();
}

function ogg()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "ogg";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['ogg'])) {
  ogg();
}

function mp3()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "mp3";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['mp3'])) {
  mp3();
}

function flac()
{
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['format'] = "flac";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
}

if (isset($_GET['flac'])) {
  flac();
}

function convert()
{
  $filename = $_FILES['file']['name'];
  $filename  = preg_replace('/\s+/', '_', $filename );
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['job'] = "running";
  $data[0]['filename'] = "$filename";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  $location = "Convert/" . $filename;
  if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
    echo exec('sudo bash ffmpeg.sh > /dev/null 2>&1 &');
    header('Location: /audiovisual.php');
  } else {
    echo '<script> alert("There is nothing to convert...")</script>';
  }
}

if (isset($_POST['convert'])) {
  convert();
}

function stop()
{
  echo exec('sudo pkill -f youtube-dl > /dev/null 2>&1 &');
  sleep(1);
  echo exec('sudo pkill -f ffmpeg > /dev/null 2>&1 &');
  sleep(1);
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['job'] = "stopped";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
}

if (isset($_GET['stop'])) {
  stop();
}

function telegram()
{
  $telegram = $_GET['telegram'];
  $telegram_chat = $_GET['telegram_chat'];
  $jsonString = file_get_contents('config.json');
  $data = json_decode($jsonString, true);
  $data[0]['telegram_token'] = "$telegram";
  $data[0]['telegram_chat'] = "$telegram_chat";
  $newJsonString = json_encode($data);
  file_put_contents('config.json', $newJsonString);
  usleep(500000);
  header('Location: /audiovisual.php');
}

if (isset($_GET['telegram'])) {
  telegram();
}

function clear()
{
  echo exec('sudo true > youtube-dl.txt > /dev/null 2>&1 &');
  echo exec('sudo true > audiovisual.txt > /dev/null 2>&1 &');
  usleep(500000);
  header('Location: /audiovisual.php');
}

if (isset($_GET['clear'])) {
  clear();
}
?>