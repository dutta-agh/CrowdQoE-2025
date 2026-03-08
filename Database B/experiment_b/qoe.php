<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality of Experience Assessment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px; /* Larger base font size */
        }
        .container {
            max-width: 800px;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 32px; /* Larger heading */
            margin-bottom: 20px;
        }
        p {
            font-size: 20px; /* Larger paragraph font size */
            line-height: 1.6; /* Better line spacing */
            margin-bottom: 20px;
        }
        .next-page {
            margin-top: 30px;
        }
        .next-page a {
            display: inline-block;
            padding: 15px 30px; /* Larger padding */
            font-size: 20px; /* Larger font size for the button */
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .next-page a:hover {
            background-color: #0056b3;
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
</head>
<body>
    <div class="container">
        <h1>Quality of Experience (QoE) Assessment</h1>
        <p>In this session, you will watch a series of video sequences. After each video, you will be asked to evaluate your experience.</p>
        <p>You will use a 5-point scale to provide your assessment, where "Bad" indicates the lowest quality and "Excellent" indicates the highest quality.</p>
        <p>Your feedback is valuable and will help us improve our content delivery.</p>
        <p>Please complete this assessment within <strong> maximum 55 minutes</strong> to avoid the risk of rejection.</p>

        <div class="next-page">
            <a href="video">Start the video sequences</a>
        </div>
    </div>
</body>
</html>
