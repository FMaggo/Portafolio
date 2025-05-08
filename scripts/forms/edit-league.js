document.addEventListener('DOMContentLoaded', function () {

    // Esta función se llama con el id de la liga correspondiente
    window.submitForm = function (leagueId) {
        // Obtener el ID de la liga y asignarlo al formulario
        const form = document.getElementsByName("form" + leagueId)[0];
        const league_name = form.querySelector('[name="league_name"]');
        const date = form.querySelector('[name="date"]');
        const date2 = form.querySelector('[name="date2"]');
        const type = form.querySelector('[name="type"]');

        if (validateInputs(league_name, date, date2, type)) {
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

    // Función para validar los inputs
    const validateInputs = (league_name, date, date2, type) => {
        let valid = true;
        const league_nameValue = league_name.value.trim();
        const dateValue = date.value.trim();
        const date2Value = date2.value.trim();
        const typeValue = type.value.trim();

        // Validar league_name
        if (league_nameValue === '') {
            setError(league_name, 'El nombre de la liga es obligatorio');
            valid = false;
        } else {
            setSuccess(league_name);
        }

        // Validar date
        if (dateValue === '') {
            setError(date, 'La fecha de inicio es obligatoria');
            valid = false;
        } else {
            setSuccess(date);
        }

        // Validar date2
        if (date2Value === '') {
            setError(date2, 'La fecha de finalización es obligatoria');
            valid = false;
        } else {
            setSuccess(date2);
        }

        // Comparar fechas
        if (dateValue !== '' && date2Value !== '') {
            const dateObj1 = new Date(dateValue);
            const dateObj2 = new Date(date2Value);

            if (dateObj2 <= dateObj1) {
                setError(date2, 'La fecha de finalización debe ser mayor a la fecha de inicio');
                valid = false;
            } else {
                setSuccess(date2);
            }
        }
        if (typeValue === '') {
            setError(type, 'El tipo de la liga es requerida');
            valid = false;
        } else {
            setSuccess(date2);
        }
 
        return valid;
    }
});
