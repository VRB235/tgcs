/**
 * Verifica que al rechazar una propuesta
 * los campos de nro de registro, fecha de registro y term code no sean requeridas
 */
function verifyRejectButtom() {

    document.getElementById("IDRegister").required = false;
    document.getElementById("deliverDate").required = false;
    document.getElementById("termcode").required = false;

}
