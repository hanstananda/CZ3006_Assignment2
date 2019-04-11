<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
</head>
<body>

<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="semantic/semantic.min.js"></script>
<div class="ui fluid container" style="height:100vh">
    <div class="ui borderless inverted main menu" style="margin: 0;border-radius: 0;">
        <a class="active item">
            Orders
        </a>
        <a class="item" href="receipt.php">
            Receipts
        </a>
    </div>
    <div class="ui main text container">
        <div class="ui container">
            <p>
            <h1 class="ui header">Order Form</h1></p>
            <p>Fill your orders here</p>
            <div class="ui grid">
                <div class="column">
                    <form class="ui large form" name="myForm" method="POST" onsubmit="mySubmit();" action="receipt.php">
                        <div class="required field">
                            <label>Costumer Name</label>
                            <input type="text" name="name" placeholder="Name" required>
                        </div>
                        <div class="required field" id="num-org-field">
                            <label>Number of Oranges</label>
                            <input type="text" name="num-oranges" placeholder="Number of Oranges" onchange="calculateRes()"
                                   required>
                            <p id="error-org"></p>
                        </div>
                        <div class="required field"  id="num-app-field">
                            <label>Number of Apples</label>
                            <input type="text" name="num-apples" placeholder="Number of Apples" onchange="calculateRes()"
                                   required>
                            <p id="error-app"></p>
                        </div>
                        <div class="required field"  id="num-ban-field">
                            <label>Number of Bananas</label>
                            <input type="text" name="num-bananas" placeholder="Number of Bananas" onchange="calculateRes()"
                                   required>
                            <p id="error-ban"></p>
                        </div>
                        <div class="required field">
                            <label>Total Price(in cents)</label>
                            <input type="text" name="price" placeholder="Total Price" readonly onfocus="blurtotal()">
                        </div>

                        <div class="inline fields">
                            <div class="required field">
                                <label>Payment methods:</label>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="card" tabindex="0" value="Visa" required>
                                    <label><i class="cc visa icon"></i> Visa</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="card" tabindex="0" value="Mastercard" required>
                                    <label><i class="cc mastercard icon"></i>Mastercard</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="card" tabindex="0" value="Discover" required>
                                    <label><i class="cc discover icon"></i>Discover</label>
                                </div>
                            </div>
                        </div>
                        <p id="error-cnt"></p>
                        <button class="ui button" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui inverted section divider"></div>
        <img src="assets/images/logo.jpg" class="ui centered mini image">
        <h4 class="ui inverted header">Created by Hans Tananda</h4>
    </div>
</div>
<script>


    function blurtotal() {
        let total = document.querySelector('input[name="price"]').blur()
    }

    function calculateRes() {
        const str_or = document.forms["myForm"]["num-oranges"].value;
        let num_or = Number(str_or);
        const str_ap = document.forms["myForm"]["num-apples"].value;
        let num_ap = Number(str_ap);
        const str_ban = document.forms["myForm"]["num-bananas"].value;
        let num_ban = Number(str_ban);
        const valid = validateForm();
        console.log(valid);
        if (!valid) {
            document.forms["myForm"]["price"].value = "NaN"
        }
        else{
            document.forms["myForm"]["price"].value = num_or * 59 + num_ap * 69 + num_ban * 39
        }

    }

    function validateForm() {
        const str_or = document.forms["myForm"]["num-oranges"].value;
        let num_or = Number(str_or);
        const str_ap = document.forms["myForm"]["num-apples"].value;
        let num_ap = Number(str_ap);
        const str_ban = document.forms["myForm"]["num-bananas"].value;
        let num_ban = Number(str_ban);
        let org_valid = true;
        let app_valid = true;
        let ban_valid = true;
        let cnt_valid = true;
        if (str_or !== "") {
            if (!(Number.isInteger(num_or))) {
                document.getElementById("error-org").textContent = "Value must be an integer!";
                org_valid = false
            }
            else if (num_or < 0) {
                document.getElementById("error-org").textContent = "Value cannot be smaller than 0!";
                org_valid = false
            }
        }
        if (str_ap !== "") {
            if (!(Number.isInteger(num_ap))) {
                document.getElementById("error-app").textContent = "Value must be an integer!";
                app_valid = false
            }
            if (num_ap < 0) {
                document.getElementById("error-app").textContent = "Value cannot be smaller than 0!";
                app_valid = false
            }
        }
        if (str_ban !== "") {
            if (!(Number.isInteger(num_ban))) {
                document.getElementById("error-ban").textContent = "Value must be an integer!";
                ban_valid = false
            }
            if (num_ban < 0) {
                document.getElementById("error-ban").textContent = "Value cannot be smaller than 0!";
                ban_valid = false
            }
        }
        if(org_valid){
            document.getElementById("num-org-field").className="required field";
            document.getElementById("error-org").textContent = "";
        }
        else{
            document.getElementById("num-org-field").className="required error field";
        }
        if(app_valid){
            document.getElementById("num-app-field").className="required field";
            document.getElementById("error-app").textContent = "";
        }
        else{
            document.getElementById("num-app-field").className="required error field";
        }
        if(ban_valid){
            document.getElementById("num-ban-field").className="required field";
            document.getElementById("error-ban").textContent = "";
        }
        else{
            document.getElementById("num-ban-field").className="required error field";
        }
        if(num_ap+num_ban+num_or<=0){
            if (org_valid & app_valid & ban_valid & str_or!== "" & str_ap !== "" & str_ban !== ""){
                document.getElementById("num-org-field").className="required error field";
                document.getElementById("num-app-field").className="required error field";
                document.getElementById("num-ban-field").className="required error field";
                document.getElementById("error-cnt").textContent = "At least one of the fields above must not equal to zero!";
            }
            cnt_valid = false;
        }
        else{
            document.getElementById("error-cnt").textContent = "";
        }
        return org_valid & app_valid & ban_valid & cnt_valid
    }

    function mySubmit() {
        const valid = validateForm();
        if (!valid) {
            event.preventDefault()
        }

    }
</script>
</body>
</html>