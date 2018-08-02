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