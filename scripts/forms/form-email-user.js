// Función que valida el aspecto del formulario de correo electrónico del archivo 'team-member-user', que es una ventana emergente

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementsByName('form')[0];
    const email = document.getElementsByName('email')[0];

    window.submitForm = function() {
        if (validateInput()) {
            form.submit();
        }
    }

    const setError = (element, message) => {
        const inputControl = element.closest('.input-control');
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    }

    const setSuccess = element => {
        const inputControl = element.closest('.input-control');
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    }

    const isValidEmail = emailValue => {
        const re = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
        return re.test(String(emailValue).toLowerCase());
    } 

    const validateInput = () => {
        let valid = true;

        const emailValue = email.value.trim();

        if (emailValue === '') {
            setError(email, 'La dirección de correo electrónico es requerido');
            valid = false;
        }
        else if (!isValidEmail(emailValue)) {
            setError(email, 'Ingrese una dirección de correo válida');
            valid = false;
        }
        else {
            setSuccess(email)
        }

        return valid;
    } 
});