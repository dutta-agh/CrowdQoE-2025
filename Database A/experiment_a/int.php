<!DOCTYPE html>
<html>
<head>
    <title>Internet Speed Check</title>
    <style>
        body {
            text-align: center;
        }

        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #countdown {
            font-size: 24px;
            font-weight: bold;
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
    <script type="text/javascript">
        

        function startCountdown(seconds, redirectUrl) {
            var countdownElement = document.getElementById('countdown');

            function updateCountdown() {
                countdownElement.innerHTML = seconds;
                seconds--;

                if (seconds < 0) {
                    window.location.href = redirectUrl;
                } else {
                    setTimeout(updateCountdown, 1000);
                }
            }

            updateCountdown();
        }
    </script>
</head>
<body>
    <div id="container">
        <h1>Internet Speed Check</h1>
        <p>Checking your Internet Speed...</p>
        <p id="resolution_id"></p>
        <p>Redirecting in <span id="countdown">3</span> seconds.</p>
    </div>

    <script type="text/javascript">
        // Call the resolution check function when the page loads.
       // checkResolution();    
    </script>





</body>
</html>


<!-- 
// Inside your JavaScript code when the resolution is below HD or speed is below 30 Mbps
window.location.href = "qualification.php?resolutionQualified=false&speedQualified=true"; -->


<script>
function checkInternetSpeed() {
    //var imageUrl = "images/img.jpg";
  var imageUrl = "https://arete.tele.agh.edu.pl/~dutta/QoE_Dutta/dummy/img.jpg"; // URL of a large image file
  var startTime, endTime;

  fetch(imageUrl, { method: 'HEAD' })
    .then(response => {
      startTime = new Date().getTime();
      return fetch(imageUrl);
    })
    .then(response => response.blob())
    .then(blob => {
      endTime = new Date().getTime();
      var duration = (endTime - startTime) / 1000; // in seconds
      var fileSize = blob.size; // file size in bytes

      var speedBps = fileSize * 8 / duration;
      var speedKbps = speedBps / 1024;
      var speedMbps = speedKbps / 1024;

      console.log("Duration (seconds): " + duration.toFixed(2));
      console.log("File Size (bytes): " + fileSize);
      console.log("Your internet speed is approximately:");
      console.log(speedBps.toFixed(2) + " bps");
      console.log(speedKbps.toFixed(2) + " kbps");
      console.log(speedMbps.toFixed(2) + " Mbps");
	  console.log(parseFloat(speedMbps));

      if (parseFloat(speedMbps) > 40) {
            // The resolution is above or equal to HD, proceed further after the countdown.
            document.getElementById("resolution_id").innerHTML = "<span  >Download Speed is okay for the assessment.</span>";
            startCountdown(3, "res");
        } else {
            // The resolution is below HD, show an alert and exit the experiment after the countdown.
            //alert("Your monitor's resolution is below HD (1280x720). The experiment cannot proceed.");
            document.getElementById("resolution_id").innerHTML = "<spanstyle='color:red;'>Your download speed is "+speedMbps+"/s. The assessment cannot proceed.</span>";
            startCountdown(3, "nq-int");
        }
    })
    .catch(error => {
      console.error("Error: " + error.message);
    });
}

checkInternetSpeed();


</script>

