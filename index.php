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
<div class="ui main text container">
    <h1 class="ui header">Order Form</h1>
    <p>Fill your orders here</p>
</div>
<div class="ui vertical masthead segment">
    <div class="ui container">
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
                    </div>
                    <div class="required field"  id="num-app-field">
                        <label>Number of Apples</label>
                        <input type="text" name="num-apples" placeholder="Number of Apples" onchange="calculateRes()"
                               required>
                    </div>
                    <div class="required field"  id="num-ban-field">
                        <label>Number of Bananas</label>
                        <input type="text" name="num-bananas" placeholder="Number of Bananas" onchange="calculateRes()"
                               required>
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
                    <button class="ui button" type="submit">Submit</button>
                </form>
            </div>
        </div>
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
            document.forms["myForm"]["price"].value = "Invalid Input!"
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
                org_valid = false
            }
            else if (num_or < 0) {
                org_valid = false
            }
        }
        if (str_ap !== "") {
            if (!(Number.isInteger(num_ap))) {
                app_valid = false
            }
            if (num_ap < 0) {
                app_valid = false
            }
        }
        if (str_ban !== "") {
            if (!(Number.isInteger(num_ban))) {
                ban_valid = false
            }
            if (num_ban < 0) {
                ban_valid = false
            }
        }
        if(org_valid){
            document.getElementById("num-org-field").className="required field";
        }
        else{
            document.getElementById("num-org-field").className="required error field";
        }
        if(app_valid){
            document.getElementById("num-app-field").className="required field";
        }
        else{
            document.getElementById("num-app-field").className="required error field";
        }
        if(ban_valid){
            document.getElementById("num-ban-field").className="required field";
        }
        else{
            document.getElementById("num-ban-field").className="required error field";
        }
        if(num_ap+num_ban+num_or<=0){
            cnt_valid = false;
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