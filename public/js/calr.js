function calCR(NC, TR) {
    var total = 0;
    for (let i = 1; i <= (TR*2); i+=2) {
        if(document.getElementById(NC+i).checked == true){
            total = total + parseInt(document.getElementById(NC+i).value);
        }else if(document.getElementById(NC+(i+1)).checked){
            total = total + parseInt(document.getElementById(NC+(i+1)).value);
        }
    }
    return total;
}

function cal() {

    document.getElementById('SM').value = calCR('SM', 5);
    document.getElementById('SF').value = calCR('SF', 4);
    document.getElementById('PP').value = calCR('PP', 3);
    document.getElementById('DSEC').value = calCR('DSEC', 6);

    document.getElementById('PRO').value = calCR('PRO', 12);
    document.getElementById('PRT').value = calCR('PRT', 5);
    document.getElementById('PRA').value = calCR('PRA', 4);

    document.getElementById('DE').value = calCR('DE', 5);
    document.getElementById('VI').value = calCR('VI', 5);
    document.getElementById('RIIC').value = calCR('RIIC', 9);
    
    document.getElementById('CSA').value = calCR('CSA', 3);
    document.getElementById('CST').value = calCR('CST', 3);
    document.getElementById('CSO').value = calCR('CSO', 3);

    document.getElementById('PAP').value = calCR('PAP', 8);

}