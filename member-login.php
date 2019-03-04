<!doctype html>
<html lang="en" class="no-js">
<?php include 'navbar.php';?>
<title>เข้าสู่ระบบ</title>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
</head>
<style>
*
{
    outline: none;
}


body, input, button
{
    font-family: 'Muli', sans-serif;
}

#cover
{
    width: 722px;
    height: 522px;
    padding: 45px;
    margin: 0 auto;
}

#form-ui,form , #close-form
{
    position: relative;
}

form
{
    width: 280px;
    height: 520px;
    padding: 25px;
    background-color: #fff;
    box-shadow: 0px 0px 0px #fff;
    border-radius: 20px 20px 20px 20px;
}

#close-form
{
    position: absolute;
    top: 23px;
    right: 25px;
    width: 24px;
    height: 24px;
    cursor: pointer;
}

#close-form:before, #close-form:after
{
    content: '';
    position: absolute;
    top: -2px;
    left: 10px;
    width: 5px;
    height: 28px;
    background-color: rgba(0, 0, 0, 0.06);
    border-radius: 10px;
}

#close-form:before
{
    transform: rotateZ(-45deg);
}

#close-form:after
{
    transform: rotateZ(45deg);
}

#form-body
{
    position: absolute;
    top: 50%;
    right: 25px;
    left: 25px;
    width: 230px;
    margin: -156px auto 0 auto;
}

#welcome-lines
{
    text-align: center;
    line-height: 1;
}

#w-line-1
{
    color: #7f7f7f;
    font-size: 40px;
}

#w-line-2
{
    color: #9c9c9c;
    font-size: 28px;
    margin-top: 17px;
}

#input-area
{
    margin-top: 40px;
}

.f-inp
{
    padding: 11px 25px;
    border: 1px solid #e3e3e3;
    line-height: 1;
    border-radius: 20px;
}

.f-inp:first-child
{
    margin-bottom: 15px;
}

.f-inp input
{
    width: 100%;
    font-size: 13.4px;
    padding: 0;
    margin: 0;
    border: 0;
}

.f-inp input::placeholder
{
    color: #b9b9b9;
}

#submit-button-cvr
{
    margin-top: 20px;
}

#submit-button
{
    display: block;
    width: 100%;
    color: #fff;
    font-size: 14px;
    margin: 0;
    padding: 14px 13px 12px 13px;
    border: 0;
    background-color: #FF9933;
    border-radius: 25px;
    line-height: 1;
    cursor: pointer;
}

#forgot-pass
{
    text-align: center;
    margin-top: 10px;
}

#forgot-pass a
{
    color: #868686;
    font-size: 12px;
    text-decoration: none;
}

#bar
{
    position: absolute;
    left: 50%;
    bottom: -50px;
    width: 28px;
    height: 8px;
    margin-left: -33px;
    background-color: #dfdfdf;
    border-radius: 10px;
}

#bar:before, #bar:after
{
    content: '';
    position: absolute;
    width: 8px;
    height: 8px;
    background-color: #ececec;
    border-radius: 50%;
}

#bar:before
{
    right: -20px;
}

#bar:after
{
    right: -38px;
}

#img-box
{
    position: absolute;
    top: 50%;
    left: 255px;
    width: 394px;
    height: 475px;
    margin-top: -237.5px;
    padding-right: 16px;
    background-color: #fff;
    border-radius: 0 20px 20px 0;
    overflow: hidden;
}

#img-box img
{
    display: block;
}
</style>


<body>
<div id="cover">
        <div id="form-ui">
            <form method="post" action="check-member.php">
            
                <div id="form-body">
                    <div id="welcome-lines"> 
                        <div id="w-line-1">MINGKHUN</div>
                        <div id="w-line-2">Member</div>
                    </div>
                    <div id="input-area">
                        <div class="f-inp">
                            <input autofocus type="text" placeholder="Email Address" name="username">
                        </div>
                        <div class="f-inp">
                            <input type="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div id="submit-button-cvr">
                        <button type="submit" id="submit-button">LOGIN</button>
                    </div>
                    <div id="forgot-pass">
                        <a href="register.php">สมัครสมาชิก</a>
                    </div>
                   
            </form>
            <div id="img-box">
                <img src="img/i.png" >
            </div>
        </div>
    </div>


</body>