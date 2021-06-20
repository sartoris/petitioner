        var phoneMask = "(___)___-____";
        var currentPhoneValue = phoneMask;
        var currentIndex = 1;
        var phoneMailInvalidMessage = "Either Phone or Email is required";

        function onLoadPhoneEmailFormatter() {
            var email = document.getElementById("email");
            email.addEventListener("input", updatePhoneMailValidity, false);
            onLoadPhoneFormatter();
        }

        function onLoadPhoneFormatter() {
            var phone = document.getElementById("phone");
            phone.addEventListener('keypress', phoneKeyPress, false);
            phone.addEventListener('keydown', phoneKeyDown, false);
            phone.addEventListener('focus', phoneOnfocus, false);
            phone.addEventListener('click', phoneClick, false);
            phone.addEventListener('paste', pastePhone, false);
            phone.addEventListener('blur', blurPhone, false);
            resetPhone(phone);
        }

        function setPhoneCursor(control) {
            control.setSelectionRange(currentIndex,currentIndex);
        }

        function resetPhone(control) {
            control.value = phoneMask;
            currentPhoneValue = phoneMask;
            currentIndex = 1;
            setPhoneCursor(control);
        }

        function updatePhone(event) {
            currentPhoneValue = currentPhoneValue.slice(0,currentIndex++) + event.key + currentPhoneValue.slice(currentIndex);
            if(currentIndex == 0 || currentIndex == 4 || currentIndex == 8)
                currentIndex++;
            event.target.value = currentPhoneValue;
            setPhoneCursor(event.target);
        }

        function overrideEvent(event) {
            setPhoneCursor(event.target);
            event.preventDefault();
            event.stopPropagation();
        }

        function phoneOnfocus(event) {
            setPhoneCursor(event.target);
        }

        function phoneKeyDown(event) {
            switch (event.key) {
                case "Home":
                    currentIndex = 1;
                    overrideEvent(event);
                    break;
                case "End":
                    currentIndex = 13;
                    //overrideEvent(event);
                    break;
                case "ArrowLeft":
                    if(currentIndex > 1) {
                        if(currentIndex == 5 || currentIndex == 9) {
                            currentIndex--;
                        }
                        currentIndex--;
                    }
                    overrideEvent(event);
                    break;
                case "ArrowRight":
                    if(currentIndex <= 13) {
                        if(currentIndex == 3 || currentIndex == 7) {
                            currentIndex++;
                        }
                        currentIndex++;
                        overrideEvent(event);
                    }
                    break;
                case "Backspace":
                    if(currentIndex > 1) {
                        if(currentIndex == 5 || currentIndex == 9) {
                            currentIndex--;
                        }
                        currentIndex--;
                        currentPhoneValue = currentPhoneValue.slice(0,currentIndex) + "_" + currentPhoneValue.slice(currentIndex+1);
                        event.target.value = currentPhoneValue;
                    }
                    overrideEvent(event);
                    break;
                case "Delete":
                    currentPhoneValue = currentPhoneValue.slice(0,currentIndex) + "_" + currentPhoneValue.slice(currentIndex+1);
                    event.target.value = currentPhoneValue;
                    overrideEvent(event);
                    break;
                }
        }

        function phoneKeyPress(event) {
            var keycode = event.which;
            if (keycode >= 48 && keycode <= 57 && currentIndex < 13) {
                updatePhone(event);
            }
            updatePhoneMailValidity(event);
            event.preventDefault();
            event.stopPropagation();
        }

        function phoneClick(event) {
            // TODO: find out which character was clicked on to reposition currentIndex
            overrideEvent(event);
        }

        function updatePhoneMailValidity(event) {
            var email = document.getElementById("email");
            var phone = document.getElementById("phone");
            if(email.value.length == 0 && phone.value == phoneMask) {
                phone.setCustomValidity(phoneMailInvalidMessage);
            } else {
                phone.setCustomValidity("");
            }
        }

        function pastePhone(event) {
            overrideEvent(event);
            event.target.value = formatPhone(event.clipboardData || window.clipboardData).getData('text');
        }

        function blurPhone(event) {
            overrideEvent(event);
            event.target.value = formatPhone(event.target.value);
        }

        function formatPhone(oldText) {
            var newText = "(";
            for(var i = 0; i < oldText.length; i++) {
            	if (newText.length >= 13) {
                    break;
                }
                if(i == 0 && oldText[i] == '(') {
                    continue;
                } else if(newText.length == 4) {
                    newText = newText.concat(")");
                } else if(newText.length == 8) {
                    newText = newText.concat("-");
                }
                if (!isNaN(oldText[i])) {
                    newText = newText.concat(oldText[i])
                }
            }
            return newText;
        }