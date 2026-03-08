<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

// PROLIFIC_PID=646dc687a1795f4f1fcd7ba4&STUDY_ID=6645ebfc215f6c0c423fb122&SESSION_ID=0pmj3t93yy9o

if(!isset($_SESSION['id'])){
  $_SESSION['id'] = md5(uniqid(rand(), true));

    // Path to the JSON file
	$jsonFilePath = 'config.json';
	// Read the JSON file
	$jsonData = file_get_contents($jsonFilePath);
	$data = json_decode($jsonData, true);
	// Increment the count
	$data['count']++;
	$_SESSION['position'] = $data['count'];
	// Encode the data back to JSON format
	$updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
	// Save the updated JSON back to the file
	file_put_contents($jsonFilePath, $updatedJsonData);
}

if(isset($_GET['PROLIFIC_PID'])){
	$_SESSION['PROLIFIC_PID'] = $_GET['PROLIFIC_PID'];
}
if(isset($_GET['STUDY_ID'])){
	$_SESSION['STUDY_ID'] = $_GET['STUDY_ID'];
}
if(isset($_GET['SESSION_ID'])){
	$_SESSION['PRO_SESSION_ID'] = $_GET['SESSION_ID'];
}

?>
<!doctype html>
<html>
<head>
<title>CrowdQoE - Video Quality Assessment Website</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<style>
        .warning {
            background-color: red;
            color: white;
            text-align: center;
            padding: 10px;
        }
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
<script>
    // Disable back button
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        window.history.pushState(null, null, window.location.href);
    };
    
    // Disable backspace key navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' && !e.target.matches('input, textarea')) {
            e.preventDefault();
        }
    });
</script>
</head>
<body>
<div class="container">
	<div style="text-align:left;display: flex;align-items: center;">
	<img src="./AGH.png" height="100px" >
	<h2> CrowdQoE - Subjective Long Video Quality Assessment Website </h2>
	</div>
	Greetings,<br>
	Welcome to the Video Quality Assessment Test. Your participation in this study will greatly contribute to our ongoing research into video quality algorithms.<br>
	To ensure optimal performance and accurate results, we recommend using the latest version of the Google Chrome web browser in Incognito mode <a href="https://support.google.com/chromebook/answer/95464?hl=en" target="_blank">(instructions).</a><br>  
	If you don't have access to this browser, you can download it by following <a href="https://www.google.com/intl/en/chrome/" target="_blank"> this link </a><br>
	<br>
	All information collected during this test will be used solely for the purpose of evaluating video quality. <br>
	We prioritize your privacy and do not collect or share personal information with third parties.<br>
	<br>
	<strong>Please note the following guidelines before proceeding:</strong><br>
	1. <strong>Browser Recommendation:</strong> We highly recommend using the latest version of Google Chrome in Incognito mode. <br>
	2. <strong>System Requirements:</strong> Your system should have a minimum internet speed of 40 Mbps and a monitor with Full HD (1920x1080) resolution. <br>
	3. <strong>Test Duration:</strong> The test comprises sequentially viewing one video (without audio) for minimum 20 seconds to maximum 60 seconds, totaling approximately 55 minutes. <br>
	4. <strong>Assessment Task:</strong> Your task is to evaluate the quality of each video presented. <br>
	5. <strong>Quality Assessment:</strong> You will be asked to choose the quality level (Excellent, Good, Fair, Poor or Bad) you believe best describes each video's viewing experience.<br>
	6. <strong>Criteria for Assessment:</strong> You are free to use any criteria you deem relevant to determine the superiority of one video variant over the other.<br>
	7. <strong>Device Usage:</strong> Please refrain from using mobile phones during the test.<br>
	8. <strong>Navigation:</strong> Avoid using the "Back Button" during the test to maintain continuity.<br>
	9. <strong>Full Screen Mode:</strong> Press F11 for a better viewing experience in full-screen mode.<br>
	10. Upon completion of the test, you will receive a confirmation message.<br>
	<br>
	Thank you for your voluntary participation and valuable contribution to our research.<br>
	Sincerely,<br>
	<a href="https://qoe.agh.edu.pl/pl/" target="_blank"> AGH Video Quality of Experience (QoE) Team</a><br>
	For any inquiries related to this test, feel free to reach out to us via email at: <a href="mailto:https://poczta.agh.edu.pl/rcm-1.4/#NOP" target="_blank">avrajyoti.dutta@agh.edu.pl</a><br>
	<div class="warning">
        <strong>Warning:</strong> For this test, please use a PC, desktop or laptop.<br>
		<span style="color: white;">Please complete this assessment within <strong>maximum 55 minutes</strong> to avoid the risk of rejection.</span>
    </div>
	<div style="text-align: center; margin: 25px;">
	<a id="startButton" href="int" class="btn btn-success btn-lg">Start</a>

	
		<!-- <a id="startButton" href="int" class="btn btn-success btn-lg">Start</a> -->

		<!-- <a href="int" class="btn btn-success btn-lg">Start</a> -->

	</div>
</div>


</body>
</html>