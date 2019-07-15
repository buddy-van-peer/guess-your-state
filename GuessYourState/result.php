<!DOCTYPE html>
<html>
<head>
<title>State/Territory Guesser 3000</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="main">
<h2>Can I guess your state or territory?</h2>

<label><?php include'values.php'; ?></label>

<form action="index.php" method="post">
<label class="heading"><br>Am I correct?<br></label>
<input type="radio" name="correct" value="yes">Yes<br>
<input type="radio" name="correct"  value="swimmers">No<br><br>

<input name="back" type="submit" value="Play Again!">
</form>
</div>
</div>
</body>
</html>