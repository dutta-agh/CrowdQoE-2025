<?php
session_start();

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $position = $_SESSION['position'];

// $position = fmod($_SESSION['position'],6);

// echo "position ".$position;

$fileName = "config.xlsx";

// if($position == 1){
//     $fileName = "config-p1-sp1.xlsx";
// }elseif($position == 2){
//     $fileName = "config-p1-sp2.xlsx";
// }elseif($position == 3){
//     $fileName = "config-p1-sp3.xlsx";
// }elseif($position == 4){
//     $fileName = "config-p2-sp1.xlsx";
// }elseif($position == 5){
//     $fileName = "config-p2-sp2.xlsx";
// }else{
//     $fileName = "config-p2-sp3.xlsx";
// }

//echo "filename ".$fileName;

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName);

$sheet = $spreadsheet->getActiveSheet();

$sheetRow = $sheet->getHighestRow();

// $sheetRow = $sheetRow-1;

//echo "highest sheet - ".$sheetRow;
//die();
$video = '';
$videoh = 50;
$videow = 50;
$next_page_btn_txt = '';
$next_page_btn_a_or_b = '';
$next_page_url = '';
$copyright_url = '';
$timer = 10;
$pair_id = $_GET['pair_id'];
if($pair_id && ($pair_id != 1)){

    if (in_array($pair_id, $_SESSION['vote_pairs']))
    {
        header('Location: video?pair_id=0');
    }
    
    for($i=2;$i<=$sheetRow;$i++){
        if($pair_id == $i){
            $video = $sheet->getCell('B'.$i)->getValue();
            $videoh = $sheet->getCell('D'.$i)->getValue();
            $videow = $sheet->getCell('C'.$i)->getValue();
            $next_page_url = 'vote?pair_id='.$pair_id.'&video_name='.$video.'&videoh='.$videoh.'&videow='.$videow;
            
            // //$next_page_url = 'video.php?pair_id='.$pair_id.'&video=last&number='.$number;
            //     $next_page_btn_txt = 'Go to Vote';
            //     //$next_page_btn_a_or_b = 'A';

            ////echo $video;
    
            break;
        }
    }
}else{

    if(!isset($_SESSION['vote_pairs'])){
        $_SESSION['vote_pairs'] = array();
     }else{
         if(count($_SESSION['vote_pairs']) >= ($sheetRow-1) ){
             header('Location: tq');
         }
     
     }

    $pairNumberArray = array();
    for($i=2;$i<=$sheetRow;$i++){
        // array_push($pairNumberArray,$sheet->getCell('A'.$i)->getValue());
        array_push($pairNumberArray,$i);
    }

    $output = array_diff($pairNumberArray, $_SESSION['vote_pairs']);
    $outputcount = count($output);


    if(count($_SESSION['vote_pairs']) < count($pairNumberArray)){
        $outputcount = 2;
    }

    if($outputcount > 0){
        if($fileName=="config-p2-sp3.xlsx" || $fileName=="config-p1-sp3.xlsx"){
          $new_pair_id = $output[0];
        }else{
          $new_pair_id = $output[0];
        }
        //echo "new pair id ".$new_pair_id;
          //$new_pair_id = array_rand($output,1); //RANDOM ON or OFF
          
          // echo "new pair id ".$new_pair_id;
          //die();
          //echo $new_pair_id;
          if($new_pair_id || $new_pair_id == 0){
              $next_page_url = 'video?pair_id='.$new_pair_id;
           }else{
              $next_page_url = 'tq';
           }


           if(count($output) == 1){
              $submitText = "Submit and finish";
           }
      }else{
          $next_page_url = 'tq';
      }

      //echo "<a href='".$next_page_url."'>next</a>";
      //  echo $next_page_url;
      //sdie();







    // if($fileName=="config-p2-sp3.xlsx" || $fileName=="config-p1-sp3.xlsx"){
    //     $next_page_url = 'video?pair_id='.rand(2,$sheetRow);
    // }else{
    //     // $next_page_url = 'video?pair_id=2';
    //     $next_page_url = 'video?pair_id='.rand(2,$sheetRow/2);
    // }
    // $next_page_url = 'video?pair_id='.rand(2,$sheetRow);
    
    header('Location: '.$next_page_url);
}

?>





<!doctype html>
<html>
<head>
<title>CrowdQoE - Video Quality Assessment Website</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
        Push a new state to the history when the page loads
        window.onload = function() {
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, window.location.href);
            }
        };

        Listen for the popstate event (triggered by the back button)
        window.onpopstate = function(event) {
            Prevent the default behavior of the popstate event
            event.preventDefault();

             Optionally, you can push another state to keep the current page in the history
             window.history.pushState(null, null, window.location.href);
        };
    </script>


<script>
         //Disable context menu
        document.addEventListener("contextmenu", function(event){
            event.preventDefault();
        });

        // Disable keyboard shortcuts
        document.onkeydown = function(event) {
            // Disable Ctrl+Shift+I and Ctrl+U
            if (event.ctrlKey && event.shiftKey && event.keyCode === 73) {
                return false; // Prevent default action
            }
            if (event.ctrlKey && event.keyCode === 85) {
                return false; // Prevent default action
            }
        };
    </script>



<style>
	video {
		/*margin-left: auto;
		margin-right: auto;*/

		display: block;
        pointer-events: none;
        /* transform: translate(-50%, -50%);
        top: 50%;
        left: 50%; */
        position: relative;
        max-height: 100%;
	}

    video::-webkit-media-controls-timeline {
        display: none;
    }

    video::-webkit-media-controls-play-button {
        display: none;
    }
</style>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<script>
    // Disable context menu (right click)
    document.addEventListener("contextmenu", function(event) {
        event.preventDefault();
    });

    // Disable keyboard shortcuts and inspect element
    document.addEventListener("keydown", function(event) {
        // Disable Ctrl+Shift+I (inspect element)
        if (event.ctrlKey && event.shiftKey && event.keyCode === 73) {
            event.preventDefault();
        }
        // Disable Ctrl+U (view source)
        if (event.ctrlKey && event.keyCode === 85) {
            event.preventDefault();
        }
        // Disable F12
        if (event.keyCode === 123) {
            event.preventDefault();
        }
    });

    // Disable devtools detection
    window.addEventListener('devtoolschange', function(event) {
        if (event.detail.open) {
            window.location.reload();
        }
    });
</script>
</head>
<body>

<style type="text/css">

    /* video{
        height:475px;
    } */

    #clock {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: lightgrey;
        margin: auto;
    }

    span {
        display: block;
        width: 100%;
        margin: auto;
        padding-top: 3px;
        text-align: center;
        font-size: 35px;
    }

    /* .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; 
    } */

    .video-container {
        display: flex;
        height: 100vh;
        align-items: center;
        justify-content: center;
        background-color: lightgrey;
    }    
        /*width: 100%;
        /* position: absolute;
        top: 0;
        left: 0;
        width: <?php // echo $videow.'px'; ?>;
        height: <?php // echo $videoh.'px'; ?>;
    }


    /* @media only screen and (max-width: 768px) {
        video{
            height:350px;
        }
    }

    @media only screen and (max-width: 800px) {
        video{
            height:300px;
        }
    }

    @media only screen and (max-width: 480px) {
        video{
            height:200px;
        }
    } */

    
</style>

<script>
    // Disable context menu (right click)
    document.addEventListener("contextmenu", function(event) {
        event.preventDefault();
    });

    // Disable keyboard shortcuts and inspect element
    document.addEventListener("keydown", function(event) {
        // Disable Ctrl+Shift+I (inspect element)
        if (event.ctrlKey && event.shiftKey && event.keyCode === 73) {
            event.preventDefault();
        }
        // Disable Ctrl+U (view source)
        if (event.ctrlKey && event.keyCode === 85) {
            event.preventDefault();
        }
        // Disable F12
        if (event.keyCode === 123) {
            event.preventDefault();
        }
    });

    // Disable devtools detection
    window.addEventListener('devtoolschange', function(event) {
        if (event.detail.open) {
            window.location.reload();
        }
    });
</script>









  <!-- <h2>Video</h2> -->
  <div class="video-container" style="display:none;">
  <?php// echo $video; ?>
    <!-- <video controls autoplay="autoplay" id="myVideo"> -->
    <video controls autoplay="autoplay" muted id="myVideo" preload="auto">
      <source src="https://arete.tele.agh.edu.pl/~dutta/QoE_Tomasz/qoe7.0/videos/<?php echo $video; ?>" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div id="countdown" style="text-align:center;">
    <img src="images/download.gif" alt="A GIF example">
    <!-- <p>loading.....</p> -->
  </div>
  <!-- display:none; -->
  <div style="text-align: center; margin: 25px;display: none;"> <!--change display:none; -->
    <div id="clock" style="display:none;">
      <span id="seconds"></span>
    </div>
    <!-- style="display: none;" -->
    <div id="next-page-btn" style="display: none;"> <!--change display:none; -->
      <a href="<?php echo $next_page_url; ?>" class="btn btn-success btn-lg"><?php echo $next_page_btn_txt; ?></a>
    </div>
  </div>

<input type="hidden" name="fps" id="fps" value="">
<input type="hidden" name="aspect_ratio" id="aspect_ratio" value="">
<input type="hidden" name="token" value="<?php echo md5(uniqid(rand(), true)); ?>">
<input type="hidden" name="bitrate" id="bitrate" value="">
<input type="hidden" name="file_size" id="file_size" value="">

<script type="text/javascript">
//timeLeft = <?php echo $timer; ?>;
//timeLeft = 2;
console.log(document.getElementById("myVideo"));
timeLeft = document.getElementById("myVideo").duration;
console.log(timeLeft);

function countdown() {
	timeLeft--;
	document.getElementById("seconds").innerHTML = String( timeLeft );
	if (timeLeft > 0) {
		setTimeout(countdown, 1000);
	} else {
		document.getElementById("clock").style.display = "none";
		// Get all the values
		var fpsValue = document.getElementById('fps').value;
		var aspectRatio = document.getElementById('aspect_ratio').value;
		var bitrate = document.getElementById('bitrate').value;
		var fileSize = document.getElementById('file_size').value;
		// Append all values to the next page URL
		var nextUrl = '<?php echo $next_page_url; ?>' + '&fps=' + fpsValue + 
					 '&aspect_ratio=' + aspectRatio + '&bitrate=' + bitrate +
					 '&file_size=' + fileSize;
		window.location.href = nextUrl;
	}
};


// setTimeout(countdown, 1000);

var video = document.getElementById('myVideo');
video.addEventListener('loadeddata', function() {
   // Video is loaded and can be played
   console.log("video loaded");
   document.getElementById("myVideo").play();
   document.getElementById("countdown").style.display = "none";
   document.querySelector('.video-container').style.display = 'flex'; // Show the video-container
   document.getElementById("clock").style.display = "block";
   timeLeft = Math.round(document.getElementById("myVideo").duration);
   console.log(timeLeft);
   setTimeout(countdown, 1000);
}, false);

let fps = 0;

// Function to calculate FPS
function calculateFPS() {
    if (!video) return;
    
    let times = [];
    let fps = 0;

    function ticker() {
        if (!video.paused && !video.ended) {
            times.push(performance.now());
            if (times.length > 50) { // Measure over 50 frames
                const period = (times[times.length - 1] - times[0]) / (times.length - 1);
                fps = Math.round(1000 / period);
                document.getElementById('fps').value = fps;
                //console.log(fps);
                times = [];
            }
            requestAnimationFrame(ticker);
        }
    }

    video.addEventListener('play', function() {
        times = [];
        requestAnimationFrame(ticker);
    });
}

calculateFPS();
</script>

<script>
const videoElement = document.getElementById('myVideo');

function calculateAspectRatio() {
    if (!videoElement) return;
    
    videoElement.addEventListener('loadedmetadata', function() {
        const width = this.videoWidth;
        const height = this.videoHeight;
        const gcd = (a, b) => b ? gcd(b, a % b) : a; // Calculate Greatest Common Divisor
        const divisor = gcd(width, height);
        const aspectRatio = (width/divisor) + ':' + (height/divisor);
        document.getElementById('aspect_ratio').value = aspectRatio;
    });
}

calculateAspectRatio();
</script>

<script>
const videoEl = document.getElementById('myVideo');

function calculateBitrate() {
    if (!videoEl) return;
    
    videoEl.addEventListener('loadedmetadata', function() {
        // Get video duration in seconds
        const duration = this.duration;
        
        // Create a URL for the video source
        const videoURL = this.currentSrc;
        
        // Fetch video file to get its size
        fetch(videoURL, { method: 'HEAD' })
            .then(response => {
                const fileSize = response.headers.get('content-length');
                if (fileSize) {
                    // Calculate bitrate in Kbps
                    // Formula: (fileSize * 8) / (duration * 1000)
                    const fileSizeInBits = fileSize * 8;
                    const bitrateKbps = Math.round(fileSizeInBits / (duration * 1000));
                    document.getElementById('bitrate').value = bitrateKbps;
                }
            })
            .catch(error => console.error('Error calculating bitrate:', error));
    });
}

calculateBitrate();
</script>

<script>
function calculateFileSize() {
    if (!videoEl) return;
    
    videoEl.addEventListener('loadedmetadata', function() {
        const videoURL = this.currentSrc;
        
        fetch(videoURL, { method: 'HEAD' })
            .then(response => {
                const fileSizeBytes = response.headers.get('content-length');
                if (fileSizeBytes) {
                    // Convert bytes to MB with 2 decimal places
                    const fileSizeMB = (fileSizeBytes / (1024 * 1024)).toFixed(2);
                    document.getElementById('file_size').value = fileSizeMB;
                }
            })
            .catch(error => console.error('Error calculating file size:', error));
    });
}

calculateFileSize();
</script>
</body>
</html>