/**
 * Crea la tabla de datos de las paginas
 * El lenguaje predetemrminado es ingles, por lo que se configuro a español
 */
$(document).ready( function () {
    $('#table_id').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
} );