<?php
session_start();

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $position = $_SESSION['position'];
// $position = fmod($_SESSION['position'],6);

$fileName = "config.xlsx";

// if($position == 1){
//   $fileName = "config-p1-sp1.xlsx";
// }elseif($position == 2){
//   $fileName = "config-p1-sp2.xlsx";
// }elseif($position == 3){
//   $fileName = "config-p1-sp3.xlsx";
// }elseif($position == 4){
//   $fileName = "config-p2-sp1.xlsx";
// }elseif($position == 5){
//   $fileName = "config-p2-sp2.xlsx";
// }else{
//   $fileName = "config-p2-sp3.xlsx";
// }

//echo "initial ".$fileName;

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName);
 
$sheet = $spreadsheet->getActiveSheet();

$sheetRow = $sheet->getHighestRow();

// $sheetRow = $sheetRow-1;

$submitText = "Submit and move on to the next video";

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

//echo "<br>pairnumberarray ".count($pairNumberArray);

//echo "<br>pair number array ".json_encode($pairNumberArray);
//echo "<br>session array ".json_encode($_SESSION['vote_pairs']);
//die();


if((count($pairNumberArray) - count($_SESSION['vote_pairs'])) == 1){
        $submitText = "Submit and Finish";
}

// echo "<pre>";
// print_r($pairNumberArray);
// print_r($_SESSION['vote_pairs']);
//die();



//echo $sheetRow;
$video = '';
$next_page_btn_txt = '';
$next_page_url = '';
$pair_id = $_GET['pair_id'];
$video_name = $_GET['video_name'];
$videoh = $_GET['videoh'];
$videow = $_GET['videow'];
//$number = $_GET['number'];
for($i=2;$i<=$sheetRow;$i++){
    if($pair_id == $i){
        //$pair_id = $sheet->getCell('A'.$i)->getValue();
          $video_a = $sheet->getCell('B'.$i)->getValue();
         //  $video_a_desc = $sheet->getCell('D'.$i)->getValue();
         //  $video_b = $sheet->getCell('B'.$i)->getValue();
         //  $video_b_desc = $sheet->getCell('E'.$i)->getValue();

          //$next_page_url = 'video.php?pair_id='.($pair_id+1).'&video=first';
          //$random_pair = rand(2,$sheetRow);
          //if(in_array($random_pair,$_SESSION['vote_pairs']))
          //$next_page_url = 'video.php?pair_id='.(rand(2,$sheetRow)).'&video=first';
        break;
    }
}


// save data

 //$_SESSION['id'] = null;
if(!isset($_SESSION['id'])){
   $_SESSION['id'] = md5(uniqid(rand(), true));

   // Path to the JSON file
	$jsonFilePath = 'config.json';
	// Read the JSON file
	$jsonData = file_get_contents($jsonFilePath);
	$data = json_decode($jsonData, true);
	// Increment the count
	$data['count']++;$_SESSION['position'] = $data['count'];
	// Encode the data back to JSON format
	$updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
	// Save the updated JSON back to the file
	file_put_contents($jsonFilePath, $updatedJsonData);
}

// print_r($_SESSION);
// die();

$error = '';

if(isset($_POST["vote"]))
{

    array_push($_SESSION['vote_pairs'],$_POST["pair_id"]);

    // print_r($_SESSION);
    // die();

   if(isset($_SESSION['vote'])){
      $error = '<label class="text-success">You have already voted. Thank you for voting.</label>';
   }else{
      if($error == '')
        {
         $file_open = fopen("vote_data.csv", "a");
         $no_rows = count(file("vote_data.csv"));
         if($no_rows > 1)
         {
          $no_rows = ($no_rows - 1) + 1;
         }

         
         $form_data = array(
          'sr_no'  => $no_rows,
          'Session Id' => $_SESSION['id'],
          'timestamp' => gmdate("l jS \of F Y h:i:s A").' UTC',
          'Country' => $_SESSION['country'],
          'Age' => $_SESSION['age'],
          'Gender' => $_SESSION['gender'],
          'Education' => $_SESSION['education'],
          'Education Type' => $_SESSION['education_type'],
          'Mood' => $_SESSION['mood'],
          'Tiredness' => $_SESSION['tiredness'],
          'Interests' => $_SESSION['interests'],
          'Selection' => $_POST['video'],
          'time' => $_POST['counter'],
          'File Name' => $fileName,
          'URL' => $_POST['video_name'],
          'Video_ID' => $_POST["pair_id"]-1,
          'Browser' => $_POST['browser_details'],
          'Screen Size' => $_POST['screen_size'],
          'OS' => $_POST['os_details'],
          'height' => $_POST['videoh'], 
          'width' => $_POST['videow'],  
          'FPS' => isset($_GET['fps']) ? $_GET['fps'] : $_POST['fps'],
          'Aspect_Ratio' => isset($_GET['aspect_ratio']) ? $_GET['aspect_ratio'] : $_POST['aspect_ratio'],  
          'Bitrate_Kbps' => isset($_GET['bitrate']) ? $_GET['bitrate'] : $_POST['bitrate'],
          'File_Size_MB' => isset($_GET['file_size']) ? $_GET['file_size'] : $_POST['file_size'],
          'PROLIFIC_PID' => isset($_SESSION['PROLIFIC_PID']) ? $_SESSION['PROLIFIC_PID'] : '',
          

         );
         fputcsv($file_open, $form_data);
         $error = '<label class="text-success">Thank you for voting us.</label>';

        //  print_r($form_data);
        //  die();
         

         //$output = array_merge(array_diff($pairNumberArray, $_SESSION['vote_pairs']), array_diff($_SESSION['vote_pairs'], $pairNumberArray));
         $output = array_diff($pairNumberArray, $_SESSION['vote_pairs']);
         $outputcount = count($output);


          if(count($_SESSION['vote_pairs']) < count($pairNumberArray)){
            $outputcount = 2;
          }
         //die();
         
       shuffle($output); //RANDOM ON or OFF
      //  echo array_key_first($output);
      //  print_r($output);
      //  die();
        
        if($outputcount > 0){
          $new_pair_id = $output[array_key_first($output)];
         // echo "new pair id ".$new_pair_id;
            // $new_pair_id = array_rand($output,1);
            
            // echo "new pair id ".$new_pair_id;
            // die();
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
         // echo "<a href='".$next_page_url."'>next</a>";
        //  echo $next_page_url;
        //die();
        header('Location: '.$next_page_url);
      }
   }
     
}


// getting pair data


?>
<!DOCTYPE html>
<html>
 <head>
  <title>Voting Page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
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




<style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        /*.rating-container {
            text-align: center;
        }
        /*.form-check-label {
            font-size: 50px;
            font-weight: 400;
        }
        .form-control {
            font-size: 50px;
            height: 30px;
            width: 30px;
        }
        .btn-lg {
            font-size: 30px;
        }*/
    </style>





</head>
 <body>
  <br />
  <div class="container">
  <div class="rating-container">
    <h2 align="center">This is the voting section of the previous video.</h2>
    <br />
    <!-- <h1 align="center"><?php echo $video_a_desc; ?></h1>
    <br />
    <h1 align="center"><?php echo $video_b_desc; ?></h1> -->

        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="post" action="vote?pair_id=<?php echo $pair_id; ?>&video_name=<?php echo $video_name; ?>">
            <h3 align=>Quality of the video is<br></h3> 
            
            <!-- Please Vote!!-->
            <br />
            <?php echo $error; ?>
            <input type="hidden" id="counter" name="counter" value=0 >
            <input type="hidden" name="pair_id" value="<?php echo $pair_id; ?>">
            <input type="hidden" name="video_name" value="<?php echo $video_name; ?>">
            <input type="hidden" name="videoh" value="<?php echo $videoh; ?>">
            <input type="hidden" name="videow" value="<?php echo $videow; ?>">
            <input type="hidden" name="screen_size" value="" id="screen_size">
            <input type="hidden" name="browser_details" value="" id="browser_details">
            <input type="hidden" name="os_details" value="" id="os_details">
            <input type="hidden" name="fps" id="fps" value="<?php echo isset($_GET['fps']) ? $_GET['fps'] : ''; ?>">
            <input type="hidden" name="aspect_ratio" id="aspect_ratio" value="<?php echo isset($_GET['aspect_ratio']) ? $_GET['aspect_ratio'] : ''; ?>">
            <input type="hidden" name="bitrate" id="bitrate" value="<?php echo isset($_GET['bitrate']) ? $_GET['bitrate'] : ''; ?>">
            <input type="hidden" name="file_size" id="file_size" value="<?php echo isset($_GET['file_size']) ? $_GET['file_size'] : ''; ?>">
                <div style="justify-content: space-between;">

                    <div class="form-group">
                    <input class="from-control" type="radio" name="video" value="Excellent" required="true" id="flexRadioDefault1" style="font-size: 50px;height: 30px;width: 30px;">
                    <label class="form-check-label" for="flexRadioDefault1" style="font-size: 50px; font-weight: 400;">
                        Excellent
                    </label>
                    </div>

                    <div class="form-group">
                    <input class="from-control" type="radio" name="video" value="Good" required="true" id="flexRadioDefault2" style="font-size: 50px;height: 30px;width: 30px;">
                    <label class="form-check-label" for="flexRadioDefault2" style="font-size: 50px; font-weight: 400;">
                        Good
                    </label>
                    </div>

                    <div class="form-group">
                    <input class="from-control" type="radio" name="video" value="Fair" required="true" id="flexRadioDefault3" style="font-size: 50px;height: 30px;width: 30px;">
                    <label class="form-check-label" for="flexRadioDefault3" style="font-size: 50px; font-weight: 400;">
                        Fair
                    </label>
                    </div>

                    <div class="form-group">
                    <input class="from-control" type="radio" name="video" value="Poor" required="true" id="flexRadioDefault4" style="font-size: 50px;height: 30px;width: 30px;">
                    <label class="form-check-label" for="flexRadioDefault4" style="font-size: 50px; font-weight: 400;">
                        Poor
                    </label>
                    </div>

                    <div class="form-group">
                        <input class="from-control" type="radio" name="video" value="Bad" required="true" id="flexRadioDefault5" style="font-size: 50px;height: 30px;width: 30px;">
                        <label class="form-check-label" for="flexRadioDefault5" style="font-size: 50px; font-weight: 400;">
                            Bad
                        </label>
                    </div>

                    <div class="form-group"  style="display:none;">
                        <div style="text-align: center; margin: 25px;">
                            <input type="submit" name="vote" class="btn btn-success btn-lg" value="<?php echo $submitText; ?>" />
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

<script>
    var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;

    document.getElementById("screen_size").value=screenWidth + " X " + screenHeight;

    // Send data to PHP script using AJAX
    // var xhttp = new XMLHttpRequest();
    // xhttp.open("POST", "screensize.php", true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // xhttp.send("width=" + screenWidth + "&height=" + screenHeight);
</script>

<script>
  var browserInfo = {
    name: "",
    version: "",
    userAgent: navigator.userAgent
  };

  if (/Firefox/i.test(navigator.userAgent)) {
    browserInfo.name = "Firefox";
    browserInfo.version = navigator.userAgent.match(/Firefox\/([0-9.]+)/)[1];
  } else if (/Chrome/i.test(navigator.userAgent)) {
    browserInfo.name = "Chrome";
    browserInfo.version = navigator.userAgent.match(/Chrome\/([0-9.]+)/)[1];
  } else if (/Safari/i.test(navigator.userAgent)) {
    browserInfo.name = "Safari";
    browserInfo.version = navigator.userAgent.match(/Version\/([0-9.]+)/)[1];
  } else if (/Opera|OPR\//i.test(navigator.userAgent)) {
    browserInfo.name = "Opera";
    browserInfo.version = navigator.userAgent.match(/(?:Opera|OPR)\/([0-9.]+)/)[1];
  } else if (/Edge/i.test(navigator.userAgent)) {
    browserInfo.name = "Microsoft Edge";
    browserInfo.version = navigator.userAgent.match(/Edge\/([0-9.]+)/)[1];
  } else if (/Trident/i.test(navigator.userAgent)) {
    browserInfo.name = "Internet Explorer";
    var rv = navigator.userAgent.match(/rv:([0-9.]+)/);
    browserInfo.version = rv ? rv[1] : "";
  } else {
    browserInfo.name = "Unknown";
  }

  document.getElementById("browser_details").value=browserInfo.name + ' ' + browserInfo.version;

  var operatingSystem = navigator.platform;

  if (operatingSystem.indexOf("Win") !== -1) {
    operatingSystem = "Windows";
  } else if (operatingSystem.indexOf("Mac") !== -1) {
    operatingSystem = "Mac";
  } else if (operatingSystem.indexOf("Linux") !== -1) {
    operatingSystem = "Linux";
  } else if (operatingSystem.indexOf("Android") !== -1) {
    operatingSystem = "Android";
  } else if (operatingSystem.indexOf("iOS") !== -1) {
    operatingSystem = "iOS";
  } else {
    operatingSystem = "Unknown";
  }

  document.getElementById("os_details").value=operatingSystem
</script>

<script>
  // Get the form element
  var form = document.querySelector('form');

  // Add event listeners to form elements
  form.addEventListener('change', function() {
    // Check if all required fields are filled
    if (form.checkValidity()) {
      // Generate a click event on the submit button
      var submitButton = document.querySelector('input[type="submit"]');
      submitButton.click();
    }
  });
</script>

<script>
    $(document).ready(function() {
      var counter = 0;

      setInterval(function() {
        counter+= 100;
        $('#counter').val(counter+ ' ms');
      }, 100);
    });
</script>

 </body>
</html>
