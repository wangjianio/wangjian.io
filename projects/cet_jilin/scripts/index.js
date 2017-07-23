function hideAlert() {
    document.getElementById('alert0').style.display = 'none';
    document.getElementById('alert1').style.display = 'none';
    document.getElementById('alert2').style.display = 'none';
}

function showAlert(id) {
    document.getElementById(id).style.display = 'block';
}

function autoAlert(id) {
    hideAlert();
    showAlert(id);
}

function checkInput(form) {
    var value = form.id.value;

    switch (value.length) {
        case 0:
            autoAlert('alert0');
            form.id.focus();
            return false;
            break;

        case 15:
        case 18:
            var pattern = /(^\d{17}(\d|X|x)$)|(^\d{15}$)/;

            if (pattern.test(value)) {
                hideAlert();
                return true;
            } else {
                autoAlert('alert1');
                form.id.focus();
                return false;
            }
            break;

        default:
            autoAlert('alert1');
            form.id.focus();
            return false;
            break;
    }
}

