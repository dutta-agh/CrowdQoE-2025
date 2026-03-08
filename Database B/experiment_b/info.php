<?php
session_start();

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

if(isset($_POST["info"]))
{
  $_SESSION['age'] = $_POST['age'];
  $_SESSION['gender'] = $_POST['gender'];
  $_SESSION['education'] = $_POST['education'];
  $_SESSION['country'] = $_POST['country'];
  $_SESSION['education_type'] = $_POST['education_type'];
  $_SESSION['mood'] = $_POST['mood'];
  $_SESSION['tiredness'] = $_POST['tiredness'];
  $_SESSION['interests'] = $_POST['interests'];

  // print_r($_SESSION);
  // die();

  header('Location: qoe');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Information</title>
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
    body {
      margin: 0;
      padding: 0;
    }

    .container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      /* height: 100vh; */
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f2f2f2;
    }

    .form-wrapper {
      max-width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      background-image: url('./AGH.png');
      background-repeat: no-repeat;
      background-position: top left;
      background-size: 80px;
      padding-left: 100px;
    }

    .box {
      margin-bottom: 20px;
    }

    h2 {
      margin-bottom: 20px;
      text-align: left;
      font-size: 30px;
    }

    form {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-size: 25px;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 20px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 20px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    /* Align radio buttons and labels in the middle */
    .radio-group {
      display: flex;
      align-items: baseline;
      font-size: 24px;
    }

    .radio-group input[type="radio"] {
      margin-right: 10px;
      transform: scale(1.5);
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: 50%;
      border: 2px solid #999;
      padding: 5px;
    }

    /* Fill the radio button when checked */
    .radio-group input[type="radio"]:checked {
      background-color: #4caf50;
    }

    /* Style the label text color when radio button checked */
    .radio-group input[type="radio"]:checked + label {
      color: #4caf50;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-wrapper">
      <h2>User Information</h2>
      <form method="post" action="info">

      <div class="box">
        <h2>Country:</h2>
        <select id="country" name="country" class="form-control" required="true" onchange="changeCountry()">
                <option value="">Choose</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
          <p style="color:red" id="country-warning">Please select your country</p>
        </div>

        <div class="box">
          <h2>Age:</h2>
          <div class="radio-group">
            <input type="radio" id="Below 18" name="age" value="Below 18" required>
            <label for="Below 18">Below 18</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="19 to 30" name="age" value="19 to 30" required>
            <label for="19 to 30">19 to 30</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="31 to 45" name="age" value="31 to 45" required>
            <label for="31 to 45">31 to 45</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Above 45" name="age" value="Above 45" required>
            <label for="Above 45">Above 45</label>
          </div>
        </div>

        <div class="box">
          <h2>Gender:</h2>
          <div class="radio-group">
            <input type="radio" id="Male" name="gender" value="Male" required>
            <label for="Male">Male</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Female" name="gender" value="Female" required>
            <label for="Female">Female</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Other" name="gender" value="Other" required>
            <label for="Other">Other</label>
          </div>
        </div>

        <div class="box">
          <h2>Education Group:</h2>
          <div class="radio-group">
            <input type="radio" id="Primary School" name="education" value="Primary School" required>
            <label for="Primary School">Primary School</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="GCSEs" name="education" value="GCSEs" required>
            <label for="GCSEs">GCSEs or Equivalent</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Undergraduate" name="education" value="Undergraduate" required>
            <label for="Undergraduate">University Undergraduate Programme</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Post-Graduate" name="education" value="Post-Graduate" required>
            <label for="Post-Graduate">University Post-Graduate Programme</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Doctoral" name="education" value="Doctoral" required>
            <label for="Doctoral">Doctoral Degree</label>
          </div>
        </div>

        <div class="box">
          <h2>Education Type:</h2>
          <div class="radio-group">
            <input type="radio" id="Administrative" name="education_type" value="Administrative" required>
            <label for="Administrative">Administrative</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Agricultural/ Forestry" name="education_type" value="Agricultural/ Forestry" required>
            <label for="Agricultural/ Forestry">Agricultural/ Forestry</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Artistic" name="education_type" value="Artistic" required>
            <label for="Artistic">Artistic</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Economic" name="education_type" value="Economic" required>
            <label for="Economic">Economic</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Engineering and Technology" name="education_type" value="Engineering and Technology" required>
            <label for="Engineering and Technology">Engineering and Technology</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Humanistic" name="education_type" value="Humanistic" required>
            <label for="Humanistic">Humanistic</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Legal" name="education_type" value="Legal" required>
            <label for="Legal">Legal</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Medical" name="education_type" value="Medical" required>
            <label for="Medical">Medical</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Military and Naval" name="education_type" value="Military and Naval" required>
            <label for="Military and Naval">Military and Naval</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Pedagogical" name="education_type" value="Pedagogical" required>
            <label for="Pedagogical">Pedagogical</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Psychological" name="education_type" value="Psychological" required>
            <label for="Psychological">Psychological</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Social" name="education_type" value="Social" required>
            <label for="Social">Social</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Tourism and sports" name="education_type" value="Tourism and sports" required>
            <label for="Tourism and sports">Tourism and sports</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Other" name="education_type" value="Other" required>
            <label for="Other">Other</label>
          </div>
        
          <div class="box">
          <h2>Subjective Mood Assessment:</h2>
          <div class="radio-group">
            <input type="radio" id="Positive (+)" name="mood" value="Positive (+)" required>
            <label for="Positive (+)">Positive (+)</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Neutral (0)" name="mood" value="Neutral (0)" required>
            <label for="Neutral (0)">Neutral (0)</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Negative (-)" name="mood" value="Negative (-)" required>
            <label for="Negative (-)">Negative (-)</label>
          </div>
          
          <div class="box">
          <h2>Subjective Feeling of Tiredness:</h2>
          <div class="radio-group">
            <input type="radio" id="High" name="tiredness" value="High" required>
            <label for="High">High</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Medium" name="tiredness" value="Medium" required>
            <label for="Medium">Medium</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Low" name="tiredness" value="Low" required>
            <label for="Low">Low</label>
          </div>

          <div class="box">
          <h2>Interests:</h2>
          <div class="radio-group">
            <input type="radio" id="Art" name="interests" value="Art" required>
            <label for="Art">Art</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Beauty" name="interests" value="Beauty" required>
            <label for="Beauty">Beauty</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Cars, automotive" name="interests" value="Cars, automotive" required>
            <label for="Cars, automotive">Cars, automotive</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Cinema, movies" name="interests" value="Cinema, movies" required>
            <label for="Cinema, movies">Cinema, movies</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Cooking, food" name="interests" value="Cooking, food" required>
            <label for="Cooking, food">Cooking, food</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Electronics" name="interests" value="Electronics" required>
            <label for="Electronics">Electronics</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Entertainment" name="interests" value="Entertainment" required>
            <label for="Entertainment">Entertainment</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Gaming" name="interests" value="Gaming" required>
            <label for="Gaming">Gaming</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Health" name="interests" value="Health" required>
            <label for="Health">Health</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="History" name="interests" value="History" required>
            <label for="History">History</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="IT, Computers" name="interests" value="IT, Computers" required>
            <label for="IT, Computers">IT, Computers</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Literature" name="interests" value="Literature" required>
            <label for="Literature">Literature</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Multimedia" name="interests" value="Multimedia" required>
            <label for="Multimedia">Multimedia</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Music" name="interests" value="Music" required>
            <label for="Music">Music</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Nature" name="interests" value="Nature" required>
            <label for="Nature">Nature</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Photography" name="interests" value="Photography" required>
            <label for="Photography">Photography</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Science" name="interests" value="Science" required>
            <label for="Science">Science</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Sport" name="interests" value="Sport" required>
            <label for="Sport">Sport</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Theatre" name="interests" value="Theatre" required>
            <label for="Theatre">Theatre</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="Travelling" name="interests" value="Travelling" required>
            <label for="Travelling">Travelling</label>
          </div>
        </div>

        

        <input type="submit" name="info" value="Submit" style="display:none;">
      </form>
    </div>
  </div>

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

  function changeCountry(){
    document.getElementById("country-warning").style.display = "none";
  }
  </script>




</body>
</html>