<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="semantic/semantic.min.js"></script>
<?php
	// Get order data values
	$name = $_POST["name"];
	$apples = $_POST["num-apples"];
	$oranges = $_POST["num-oranges"];
	$bananas = $_POST["num-bananas"];
	$payment = $_POST["card"];
	// If any of the quantities are blank, set them to zero
	if ($apples == "") $apples = 0;
	if ($oranges == "") $oranges = 0;
	if ($bananas == "") $bananas = 0;
	// Compute item costs and total cost
	$apples_cost = 69 * $apples;
	$oranges_cost = 59 * $oranges;
	$bananas_cost = 39 * $bananas;
	$total_cost = $apples_cost + $oranges_cost + $bananas_cost;
?>
<?php
	$apple = $_POST["num-apples"];
	$orange = $_POST["num-oranges"];
	$banana = $_POST["num-bananas"];
	$file = 'order.txt';
	//checks if file exists
	if (file_exists($file)) {
		if ($fhandle = fopen($file, "r")) {
			//tests if at EOF, break if at EOF
			while (!feof($fhandle)) {
				$contents[] = fgets($fhandle);
			}
			fclose($fhandle);
		}
	} else {
		fopen($file, "c+");//create file if does not exist
	}

	//opens the file and read line by line
	$myfile_line = file("order.txt");

	//if it is an empty text file, fills every row with empty space to prevent error
	for ($x = 0; $x <= 10; $x++) {
		if (empty($myfile_line[$x]))
			$myfile_line[$x] = " ";
	}
	//replaces anything which is not a number with "" line by line
	$apples_cumulative = preg_replace("/[^0-9]/", "", $myfile_line[0]);
	$oranges_cumulative = preg_replace("/[^0-9]/", "", $myfile_line[1]);
	$bananas_cumulative = preg_replace("/[^0-9]/", "", $myfile_line[2]);
	//sums the existing value in the text file and the newly entered value
	$apples_total = $apple + (int)$apples_cumulative;
	$oranges_total = $orange + (int)$oranges_cumulative;
	$bananas_total = $banana + (int)$bananas_cumulative;

	//contents to be written back to the file
	$apples_content = "Total number of apples: $apples_total\r\n";
	$oranges_content = "Total number of oranges: $oranges_total\r\n";
	$bananas_content = "Total number of bananas: $bananas_total\r\n";

	//writes back into the file
	$file = fopen("order.txt", "c");
	fwrite($file, $apples_content);
	fwrite($file, $oranges_content);
	fwrite($file, $bananas_content);
	fclose($file);
?>
<div class="ui fluid container" style="height:100vh">
    <div class="ui borderless inverted main menu" style="margin: 0;border-radius: 0;">
        <a class="item" href="index.php">
            Orders
        </a>
        <a class="active item">
            Receipts
        </a>
    </div>
    <div class="ui main text container">
        <div class="ui container">
            <div class="ui grid">
                <div class="column">
                    <p>
                    <h2> Order Receipt </h2></p>
					<?php print ("<strong>Customer Name :</strong> $name <br />"); ?>

                    <table class="ui large celled striped fixed table">
                        <caption><strong> Order Information </strong></caption>
                        <thead>
                        <tr>
                            <th> Product</th>
                            <th> Unit Price</th>
                            <th> Quantity</th>
                            <th> Item Cost</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr align="center">
                            <td data-label="Product"> Apples</td>
                            <td data-label="Unit Price"> ¢ 69</td>
                            <td data-label="Quantity"> <?php print ("$apples"); ?> </td>
                            <td data-label="Item Cost"> <?php printf("¢ %d", $apples_cost); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td data-label="Product"> Oranges</td>
                            <td data-label="Unit Price"> ¢ 59</td>
                            <td data-label="Quantity"> <?php print ("$oranges"); ?> </td>
                            <td data-label="Item Cost"> <?php printf("¢ %d", $oranges_cost); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td data-label="Product"> Bananas</td>
                            <td data-label="Unit Price"> ¢ 39</td>
                            <td data-label="Quantity"> <?php print ("$bananas"); ?> </td>
                            <td data-label="Item Cost"> <?php printf("¢ %d", $bananas_cost); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2"><i class="credit card icon"></i><strong>Payment method: </strong>
                            </td>
                            <td colspan="2"> <?php printf($payment); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2"><strong> Total : </strong>
                            </td>
                            <td colspan="2"> <?php printf("¢ %d", $total_cost); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <h3><a href="index.php" class="item">Back to Orders</a></h3>
        <div class="ui inverted section divider"></div>
        <img src="assets/images/logo.jpg" class="ui centered mini image">
        <h4 class="ui inverted header">Created by Hans Tananda</h4>
    </div>
</div>
</body>
</html>