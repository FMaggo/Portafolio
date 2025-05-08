document.addEventListener('DOMContentLoaded', function () {
    // Función que valida el formulario de edición de miembro
    window.submitForm2 = function(memberId) {
        const form = document.getElementsByName("form" + memberId)[0];
        const full_name = form.querySelector('[name="full_name"]');
        const email = form.querySelector('[name="email"]');
        const age = form.querySelector('[name="age"]');
        const cologne = form.querySelector('[name="cologne"]');
        const phone = form.querySelector('[name="phone"]');

        if (validateInputs(full_name, email, age, cologne, phone)) {
            form.submit();
        }
    }

    // Función para establecer errores
    const setError = (element, message) => {
        const inputControl = element.closest('.input-control');
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    }

    // Función para establecer éxito
    const setSuccess = element => {
        const inputControl = element.closest('.input-control');
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    }

    // Función para validar correos electrónicos
    const isValidEmail = (emailValue) => {
        const re = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
        return re.test(String(emailValue).toLowerCase());
    }

    // Función para validar los inputs
    const validateInputs = (full_name, email, age, cologne, phone) => {
        let valid = true;

        const full_nameValue = full_name.value.trim();
        const emailValue = email.value.trim();
        const ageValue = age.value.trim();
        const cologneValue = cologne.value.trim();
        const phoneValue = phone.value.trim();

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

        return valid;
    }
});