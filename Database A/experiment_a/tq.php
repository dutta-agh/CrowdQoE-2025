<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if(isset($_SESSION['PROLIFIC_PID'])){
	$prolific_pid = $_SESSION['PROLIFIC_PID'];
}
?>
<!doctype html>
<html>
<head>
    <title>CrowdQoE - Subjective Long Video Quality Assessment Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <style>
        body {
            font-size: 1.75em; /* Increase font size for all text */
        }
        * {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
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

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

</head>
<body>
    <div class="container">
        <div style="text-align: left; display: flex; align-items: center;">
            <img src="./AGH.png" height="100px">
            <h2>CrowdQoE - Subjective Long Video Quality Assessment Website</h2>
        </div>
        <br>
        <div style="text-align: center;"> <!-- Center-align content -->
			<br>
			Assessment completed successfully. <br>
			<br>
            Thank you for your valuable feedback. <br>
			<!--Goodbye. -->
            <br>
			 <!--Please Close this Google Chrome Browser Window !!-->
			<br>
            <br>
            <span style="color: red;">To recieve payment, please finalize to task by clicking the button below.</span>   <!--Click the below button!! -->
			<br>
        </div>
        <?php if(isset($prolific_pid)){ ?>
        <div style="text-align: center; margin: 25px;">
	        <a href="https://app.prolific.com/submissions/complete?cc=CSBTCSY2" class="btn btn-success btn-lg">Accomplish the Task and Go to Prolific</a>
        </div>
        <?php } ?>
    </div>
</body>
</html>
