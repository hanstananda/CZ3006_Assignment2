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
    // Get the data and sanitize it, discard any non-digit characters
	$num_apples = preg_replace("/[^0-9]/", "",$_POST["num-apples"]);
	$num_oranges = preg_replace("/[^0-9]/", "",$_POST["num-oranges"]);
	$num_bananas = preg_replace("/[^0-9]/", "",$_POST["num-bananas"]);
	$payment_type = $_POST["card"];
	// If any of the quantities are blank, set them to zero
	if ($num_apples == "") $num_apples = 0;
	if ($num_oranges == "") $num_oranges = 0;
	if ($num_bananas == "") $num_bananas = 0;
	// Compute item costs and total cost
	$apples_cost = 69 * $num_apples;
	$oranges_cost = 59 * $num_oranges;
	$bananas_cost = 39 * $num_bananas;
	$total_cost = $apples_cost + $oranges_cost + $bananas_cost;
	$file = 'order.txt';
	//read the entire file and put it into an array
    $file_content = file($file);
    //Get only the digits from the file content, discard any non-digit characters
    $apples_prev = preg_replace("/[^0-9]/", "", $file_content[0]);
	$oranges_prev = preg_replace("/[^0-9]/", "", $file_content[1]);
	$bananas_prev = preg_replace("/[^0-9]/", "", $file_content[2]);
	//sums the existing value in the text file and the newly entered value
	$apples_total = $num_apples + (int)$apples_prev;
	$oranges_total = $num_oranges + (int)$oranges_prev;
	$bananas_total = $num_bananas + (int)$bananas_prev;

	//Create the content to be written back to the file
	$apples_file_content = "Total number of apples: $apples_total\r\n";
	$oranges_file_content = "Total number of oranges: $oranges_total\r\n";
	$bananas_file_content = "Total number of bananas: $bananas_total\r\n";

	//writes back into the file
	$file = fopen($file, "w");
	fwrite($file, $apples_file_content);
	fwrite($file, $oranges_file_content);
	fwrite($file, $bananas_file_content);
	fclose($file);
?>
<div class="ui fluid container" style="height:150vh">
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
                            <td data-label="Product"><img src="assets/images/apple.png" class="ui tiny image"> Apples</td>
                            <td data-label="Unit Price"> ¢ 69</td>
                            <td data-label="Quantity"> <?php print ("$num_apples"); ?> </td>
                            <td data-label="Item Cost"> <?php printf("¢ %d", $apples_cost); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td data-label="Product"><img src="assets/images/orange.png" class="ui tiny image"> Oranges</td>
                            <td data-label="Unit Price"> ¢ 59</td>
                            <td data-label="Quantity"> <?php print ("$num_oranges"); ?> </td>
                            <td data-label="Item Cost"> <?php printf("¢ %d", $oranges_cost); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td data-label="Product"> <img src="assets/images/banana.png" class="ui tiny image"> Bananas</td>
                            <td data-label="Unit Price"> ¢ 39</td>
                            <td data-label="Quantity"> <?php print ("$num_bananas"); ?> </td>
                            <td data-label="Item Cost"> <?php printf("¢ %d", $bananas_cost); ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2"><i class="credit card icon"></i><strong>Payment method: </strong>
                            </td>
                            <td colspan="2"> <?php printf($payment_type); ?>
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