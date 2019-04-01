<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="semantic/semantic.min.js"></script>
<div class="ui grid">
    <div class="column">
        <form class="ui form" name="myForm" method="POST" onsubmit="mySubmit();">
            <div class="field">
                <label>Costumer Name</label>
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="field">
                <label>Number of Oranges</label>
                <input type="text" name="num-oranges" placeholder="Number of Oranges" onchange="calculateRes()"
                       required>
            </div>
            <div class="field">
                <label>Number of Apples</label>
                <input type="text" name="num-apples" placeholder="Number of Apples" onchange="calculateRes()" required>
            </div>
            <div class="field">
                <label>Number of Bananas</label>
                <input type="text" name="num-bananas" placeholder="Number of Bananas" onchange="calculateRes()"
                       required>
            </div>
            <div class="field">
                <label>Total Price(in cents)</label>
                <input type="text" name="price" placeholder="Total Price" readonly onfocus="blurtotal()">
            </div>

            <div class="inline fields">
                <label>Payment methods:</label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="card" tabindex="0" value="Visa" required>
                        <label>Visa</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="card" tabindex="0" value="Mastercard" required>
                        <label>Mastercard</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="card" tabindex="0" value="Discover" required>
                        <label>Discover</label>
                    </div>
                </div>
            </div>
            <button class="ui button" type="submit">Submit</button>
        </form>
    </div>
</div>
<script>
    function blurtotal() {
        let total = document.querySelector('input[name="price"]').blur()
    }

    function calculateRes() {
        var str_or = document.forms["myForm"]["num-oranges"].value;
        var num_or = Number(str_or)
        var str_ap = document.forms["myForm"]["num-apples"].value;
        var num_ap = Number(str_ap)
        var str_ban = document.forms["myForm"]["num-bananas"].value;
        var num_ban = Number(str_ban)
        if (str_or != "") {
            if (!(Number.isInteger(num_or))) {
                alert("number of oranges field must be an integer!")
                return
            }
            if (num_or < 0) {
                alert("number of oranges field must be larger than 0!")
            }

        }
        if (str_ap != "") {
            if (!(Number.isInteger(num_ap))) {
                alert("number of apples field must be an integer!")
                return
            }
            if (num_ap < 0) {
                alert("number of apples field must be larger than 0!")
            }
        }

        if (str_ban != "") {
            if (!(Number.isInteger(num_ban))) {
                alert("number of bananas field must be an integer!")
                return
            }
            if (num_ban < 0) {
                alert("number of bananas field must be larger than 0!")
            }
        }
        document.forms["myForm"]["price"].value = num_or * 59 + num_ap * 69 + num_ban * 39

    }

    function validateForm() {
        var str_or = document.forms["myForm"]["num-oranges"].value;
        var num_or = Number(str_or)
        var str_ap = document.forms["myForm"]["num-apples"].value;
        var num_ap = Number(str_ap)
        var str_ban = document.forms["myForm"]["num-bananas"].value;
        var num_ban = Number(str_ban)
        if (str_or != "") {
            if (!(Number.isInteger(num_or))) {
                return false
            }
            if (num_or < 0) {
                return false
            }

        }
        if (str_ap != "") {
            if (!(Number.isInteger(num_ap))) {
                return false
            }
            if (num_ap < 0) {
                return false
            }
        }

        if (str_ban != "") {
            if (!(Number.isInteger(num_ban))) {
                return false
            }
            if (num_ban < 0) {
                return false
            }
        }
        return true
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