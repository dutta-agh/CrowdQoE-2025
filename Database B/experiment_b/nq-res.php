<!DOCTYPE html>
<html>
<head>
    <title>Assessment Qualification</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #FF0000; /* Red color for emphasis */
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Not Qualified for the Assessment</h1>
        <?php
        $resolutionQualified = isset($_GET['resolutionQualified']) ? $_GET['resolutionQualified'] : false;
        $speedQualified = isset($_GET['speedQualified']) ? $_GET['speedQualified'] : false;

        if (!$resolutionQualified) {
            echo "<p>Your monitor's screen resolution is below Full HD (1920x1080).</p> <br> If you are sure that this is not the case, please make sure your Windows Display Scale is not higher than 100%.</p>";
        }

        if (!$speedQualified) {
            echo "<p>Try again with the required settings.</p>";
        }
        ?>
        <p>Thank you for participating in this assessment. Please close this Google Chrome Browser Window</p>
    </div>
</body>
</html>
