// Función que valida los aspectos del formulario del archivo "team-register"

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementsByName('form')[0];
    const full_name = document.getElementsByName('full_name')[0];
    const email = document.getElementsByName('email')[0];
    const age = document.getElementsByName('age')[0];
    const cologne = document.getElementsByName('cologne')[0];
    const phone = document.getElementsByName('phone')[0];
    const team_name = document.getElementsByName('team_name')[0];
    const additional = document.getElementsByName('additional')[0];

    window.submitForm = function() {
        if (validateInputs()) {
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

    const isValidEmail = (emailValue) => {
        // Expresión regular para validar correo electrónicos
        const re = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
        return re.test(String(emailValue).toLowerCase());
    }

    const validateInputs = () => {
        let valid = true;

        const team_nameValue = team_name.value.trim();
        const full_nameValue = full_name.value.trim();
        const emailValue = email.value.trim();
        const ageValue = age.value.trim();
        const cologneValue = cologne.value.trim();
        const phoneValue = phone.value.trim();
        const additionalValue = additional.value.trim();

        if (team_nameValue === '') {
            setError(team_name, 'El nombre del equipo es requerido');
            valid = false;
        } else {
            setSuccess(team_name);
        }
        if (full_nameValue === '') {
            setError(full_name, 'Su nombre completo es requerido');
            valid = false;
        } else {
            setSuccess(full_name);
        }

        if (emailValue === '') {
            setError(email, 'Por favor, proporcione una dirección de correo electrónico');
            valid = false;
        } else if (!isValidEmail(emailValue)) {
            setError(email, 'Ingrese una dirección de correo electrónico válida');
            valid = false;
        } else {
            setSuccess(email);
        }

        if (ageValue === '' || ageValue < 0) {
            setError(age, 'Por favor, ingrese una edad válida (sin signo negativo)');
            valid = false;
        } else {
            setSuccess(age);
        }

        if (cologneValue === '') {
            setError(cologne, 'Por favor, ingrese una colonia');
            valid = false;
        } else {
            setSuccess(cologne);
        }

        if (phoneValue === '') {
            setError(phone, 'Por favor, ingrese un teléfono de contacto');
            valid = false;
        } else if (phoneValue.length < 10 || phoneValue.length > 10) {
            setError(phone, 'El número telefónico debe ser de 10 dígitos');
            valid = false;
        } else {
            setSuccess(phone);
        }

        if (additionalValue === '') {
            setError(additional, 'Por favor, seleccione una opción');
            valid = false;
        } else {
            setSuccess(additional);
        }

        return valid;
    }
}); 