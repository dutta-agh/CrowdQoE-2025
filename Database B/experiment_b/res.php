<!DOCTYPE html>
<html>
<head>
    <title>Resolution Check</title>
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
        function checkResolution() {
            var minWidth = 1920;
            var minHeight = 1080;

            if (screen.width >= minWidth && screen.height >= minHeight) {
                // The resolution is above or equal to HD, proceed further after the countdown.
                document.getElementById("resolution_id").innerHTML = "<span>Monitor's screen resolution is okay for the assessment</span>";
                startCountdown(3, "info");
            } else {
                // The resolution is below HD, show an alert and exit the experiment after the countdown.
                //alert("Your monitor's resolution is below HD (1280x720). The experiment cannot proceed.");
                document.getElementById("resolution_id").innerHTML = "<spanstyle='color:red;'>Your monitor's screen resolution is below Full HD (1920x1080). The assessment can not proceed further. </span>";
                startCountdown(3, "nq-res");
            }
        }

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
        <h1>Monitor's Resolution Check</h1>
        <p>Checking your monitor's resolution automatically...</p>
        <p id="resolution_id"></p>
        <p>Redirecting in <span id="countdown">3</span> seconds.</p>
    </div>

    <script type="text/javascript">
        // Call the resolution check function when the page loads.
        checkResolution();
    </script>




</body>
</html>
