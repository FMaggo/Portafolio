document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementsByName("form")[0];

    const league_name = document.getElementsByName("league_name")[0];
    const date = document.getElementsByName("date")[0];
    const date2 = document.getElementsByName("date2")[0];
    const type = document.getElementsByName("type")[0];

    window.submitForm = function () {
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

    const validateInputs = () => {
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
            setSuccess(type);
        }

        return valid;
    }
});
