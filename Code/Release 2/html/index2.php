<?php
    
    include_once("parseHeader.php");
    
    use Parse\ParseObject;
    use Parse\ParseException;
    
    $errorMessage  = "" ;
    
    if (isset($_GET["error"])) {
        $errorMessage = "Invalid Login Credentials";
        echo $errorMessage;
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="style/index.css" />
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="//www.parsecdn.com/js/parse-1.5.0.min.js"></script>
        <script src="parse_php/parse.js"></script>
        <script src="home_jquery.js"></script>
    </head>
<body>
    <div><img src="style/images/soccer2.jpg" id="bg" alt=""></div>
    <div id="navigationBar">
        <div class="navigationButtons" id="buttonGroup">
            <button id="homeButton" onclick="location.href = 'index.php';">Home</button>
            <button id="aboutButton">About</button>
			<button id="routineButton" onclick="location.href = 'customWizard.php';">Wizard</button>
			<button id="simulatorButton" onclick="location.href = 'simulator.php';">Simulator</button>
        </div>
        <div id="text">SkillCourt</div>
    </div>
    <div id="registerNowZoom">
        <div id="zoomRectangle">
            <div id="zoomOval"></div>
            <button onclick="location.href = 'create.php';" id="registerNowButton" disabled>REGISTER NOW</button>
            <div id="registerNowHeader">and start playing!</div>
        </div>
    </div>
    <button id="logInButton" href = "javascript:void(0)" >Log In</button>
    <div id="light" class="white_content">This is the lightbox content.
        <div id="logInRectangle">
            <div id="headerLogInRectangle">Log In or Create an Account
                <button id="exitButton"> &#10006; </button>
            </div>
            <div>
                <form action="process_login.php" method="POST" name="login_form">
                    <input type="text" name="username" id="username" placeholder="Username" required ><br>
                    <input type="password" name="password" id="password" placeholder="Password" required ><br>
                    <input type="submit" id="popUplogInButton" value ="LOG IN" disabled><br>
                </form>
                <button id="changePasswordButton" onclick="change_password();">Forgot your username or password?</button>
                <div id="signUpHeader">Don&apos;t have an account?</div>
                <a id="signupButton" href=# >Sign Up</a>
            </div>
        </div>
        <div id="changePasswordRectangle">
            <div id="headerChangePasswordRectangle">Password Reset
                <button id="exitChangePasswordButton" onclick="resetLogInWindow();"> &#10006; </button>
            </div>
            <div id="passwordResetInformation">Enter your SkillCourt email address that you used to register. We&apos;ll send you an email with your username and a link to reset your password.</div>
            <form action="change_password.php" method="POST" name="change_password_form" disabled>
                <input type="text" name="emailAddressForPasswordChange" id="emailAddressForPasswordChange" placeholder="Email Address" required disabled><br>
                <input type="submit" id="submitPasswordChange" value="SEND" disabled><br>
            </form>
        </div>
    </div>
    <div id="fade" class="black_overlay"></div>
    <div id="rectangle2"> </div>
    <div id="informationRectangle"></div>
    <div id="textRectangle">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&apos;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
    </div>
    <div id="pageFooter"></div>
</body>
</html>