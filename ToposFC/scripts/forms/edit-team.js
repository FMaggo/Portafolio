document.addEventListener('DOMContentLoaded', function () {
    // Esta función se llama con el id del equipo correspondiente
    window.submitForm = function (teamId) {
        // Obtener el formulario correspondiente al equipo
        const form = document.querySelector('form[name="form' + teamId + '"]');
        const nameInput = form.querySelector('[name="name"]');

        if (validateInputs(nameInput)) {
            console.log("Inputs validados correctamente."); // Verificar validación
            form.submit();
        } else {
            console.log("Error en la validación de inputs."); // Verificar error de validación
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

    // Función para validar los inputs
    const validateInputs = (nameInput) => {
        let valid = true;
        const nameValue = nameInput.value.trim();

        // Validar name
        if (nameValue === '') {
            setError(nameInput, 'El nombre del equipo es obligatorio');
            valid = false;
        } else {
            setSuccess(nameInput);
        }

        return valid;
    }
});
