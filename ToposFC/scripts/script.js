let table = new DataTable('#tablaequipo',{
    layout:{
        bottomStart: 'info',
        bottomEnd: null,
        topStart:{
            pageLength:{
                menu: [5, 10, 20]
            }

        },
        topEnd:{
            search:{
                placeholder: 'Busca aquí'
            }

        },
    },

    language:{
        lengthMenu: "Mostrar _MENU_ Cantidad de equipos",
        entries: {
            _: 'Equipos',
            1: 'Equipo'
        },
        info: "Mostrando _START_ a _END_ de _TOTAL_ Equipos",
        search: "Buscar:",
    }

});
