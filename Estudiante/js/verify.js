/**
 * Verifica si la escolaridad fue finalizada, en cuyo caso el campo de año de finalizacion sera requerido
 */
function verifyScholarship() {
    var studentOne = document.getElementById("student_one_scholarship");
    var studentTwo = document.getElementById("student_two_scholarship");
    var strUserOne = studentOne.options[studentOne.selectedIndex].value;
    var strUserTwo = studentTwo.options[studentTwo.selectedIndex].value;
    // Si se selecciono escolaridad finalizada para el estudiante uno
    if(strUserOne == "scholarship_ended")
    {
        document.getElementById("student_one_year_ended").required = true;
    }
    else{
        document.getElementById("student_one_year_ended").required = false;
    }
    // Si se selecciono escolaridad finalizada para el estudiante dos
    if(strUserTwo == "scholarship_ended")
    {
        document.getElementById("student_two_year_ended").required = true;
    }
    else{
        document.getElementById("student_two_year_ended").required = false;
    }
}

/**
 * Funcion para hacer los campos del 2do estudiante como obligatorios
 */
function verify2ndStudentAAnual() {
    try {
        document.getElementById("student_two_name").required = true;
        document.getElementById("student_two_id").required = true;
        document.getElementById("student_two_hab_phone").required = true;
        document.getElementById("student_two_cel_phone").required = true;
        document.getElementById("student_two_ucab_email").required = true;
        document.getElementById("student_two_personal_email").required = true;
        document.getElementById("student_two_seminar_title").required = true;
        document.getElementById("student_two_professor").required = true;
        document.getElementById("student_two_approval_year").required = true;
    }
    catch (e) {
        console.log("No existe uno de los campos");
    }

}

/**
 * Verifica que los campos para el 2ndo estudiante en caso de que no existan no sean requeridos
 */
function verify2ndStudentForLastTimeAAnual() {
    try {
        if(document.getElementById("student_two_name").value === "" && document.getElementById("student_two_id").value === ""
            && document.getElementById("student_two_hab_phone").value === "" && document.getElementById("student_two_cel_phone").value === ""
            && document.getElementById("student_two_ucab_email").value === "" && document.getElementById("student_two_personal_email").value === ""
            && document.getElementById("student_two_seminar_title").value === "" && document.getElementById("student_two_professor").value === ""
            && document.getElementById("student_two_approval_date").value === ""){
            document.getElementById("student_two_name").required = false;
            document.getElementById("student_two_id").required = false;
            document.getElementById("student_two_hab_phone").required = false;
            document.getElementById("student_two_cel_phone").required = false;
            document.getElementById("student_two_ucab_email").required = false;
            document.getElementById("student_two_personal_email").required = false;
            document.getElementById("student_two_seminar_title").required = false;
            document.getElementById("student_two_professor").required = false;
            document.getElementById("student_two_approval_date").required = false;
        }
    }
    catch (e) {
        console.log(e.toString());
        console.log("No existe uno de los campos");
    }

}

/**
 * Verifica la especialidad del alumno
 * Si es Relaciones Industriales puede tener mencion
 * Si es Sociologia no tiene mencion
 */
function verifySpecialty(elemenSpecialty,elementMention) {
    try {
        if(document.getElementById(elemenSpecialty).value === "RR.II"){
            document.getElementById(elementMention).disabled = false;
        }
        if(document.getElementById(elemenSpecialty).value === "Soc."){
            document.getElementById(elementMention).value = "Sin O";
            document.getElementById(elementMention).disabled = true;
        }
    }
    catch (e) {
        console.log(e.toString());
    }

}

/**
 * Verifica que solo existan letras en el campo
 * @param element
 */
function onlyText(element) {
    var regex = /^[a-zA-Z_ @]+$/;

    if (regex.test(document.getElementById(element).value) !== true) {
        document.getElementById(element).value = document.getElementById(element).value.replace(/[^a-zA-Z_ @]+/, '');
    }

}