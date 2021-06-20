
    <div id="message" style="width=40%; float:left;">
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        <p id="special" class="invalid">At least one of the following characters: !@$#%^&_+=|</b></p>
    </div>

    <script>
        var pwd = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var special = document.getElementById("special");
        var length = document.getElementById("length");

        function validatePassword() {
            var valid = true;
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(pwd.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
                valid = false;
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(pwd.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
                valid = false;
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(pwd.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
                valid = false;
            }

            // Validate special
            var specialchars = /[!@$#%^&_+=|]/g;
            if(pwd.value.match(specialchars)) {
                special.classList.remove("invalid");
                special.classList.add("valid");
            } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
                valid = false;
            }

            // Validate length
            if(pwd.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
                valid = false;
            }
            return valid;
        }

        pwd.onkeyup = validatePassword();

        pwd.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        pwd.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

    </script>

