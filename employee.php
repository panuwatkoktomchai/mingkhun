<meta charset="UTF-8">
<?php include 'navbar-employee.php';?>
<title>Employee</title>
<head>
</head>


<style>@import url("https://fonts.googleapis.com/css?family=Righteous|Montserrat");
.header-text {
  color: #fff;
  text-align: center;
  font-family: "Righteous", cursive;
  font-size: 4em;
  letter-spacing: 0.5rem;
}

.content-text {
  color: #444;
  text-align: center;
  font-family: "Montserrat", sans-serif;
  font-size: 1.3em;
}

*, ::before, ::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  width: 100%;
}

.container {
  width: 100%;
}
.container div {
  min-height: 100vh;
}

.header {
  position: relative;
  display: block;
  width: 100%;
  overflow-x: hidden;
}

.box {
  display: flex;
  flex: 1;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.colorful {
  position: relative;
  background: linear-gradient(to right, #fddd10, #ff6c2c, #e5e, #2fabe1);
  background-size: 2000%;
  animation: gradientBackground 10s alternate ease-in-out;
  animation-iteration-count: infinite;
}

.content {
  position: relative;
  display: block;
  padding: 0 15%;
}
.content p {
  text-align: left;
  line-height: 1.3em;
}
.content p::first-letter {
  font-size: 230%;
}

@keyframes gradientBackground {
  0% {
    background-position: left;
  }
  100% {
    background-position: right;
  }
}

</style>


<body>

<?php
session_start();

if (empty($_SESSION['username']) == true || (int)$_SESSION['status'] != 1) {
    header('Location:index.php?url=login');
    // echo "Ascess denine";
}	
?>


  <div class="header header-text">
	<div class="box colorful">Hello employee !! &nbsp;<h1><?php  echo $_SESSION['fullname']; ?> </h1> </div>
	
  </div>
  


	
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>