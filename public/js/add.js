
function addGroup() {
    var a = document.getElementById('ng').value;
    var a = parseInt(a);

    var div = document.createElement('div');
    div.setAttribute('class','row');
    div.setAttribute('style', 'margin-top:1% ;margin-left:1%;');

    div.innerHTML ='\
    <div class="col card" id="g'+a+'" style="padding-left:5%">\
        <div class="row">\
            <div class="col-md-12">\
                <div class="row">\
                    <div class=""></div>\
                    <div class="col-md-2">\
                        <div style="padding-top:6%">Grupo #'+(a+1)+'</div>\
                    </div>\
                    <div class="col-md-3" style="padding-top:5px; padding-bottom:5px">\
                        <label for="gr1">Grado: </label>\
                        <input type="number" style="width: 40%" id="gr'+a+'" name="gr'+a+'" placeholder="Ej. 1-9" min="0" required>\
                    </div>\
                    <div class="col-md-3" style="padding-top:5px; padding-bottom:5px"> \
                        <label for="gu1">Grupo: </label>\
                        <input type="text" style="width: 40%" id="gu'+a+'" name="gu'+a+'" placeholder="Ej. A-Z" maxlength="1" required>\
                        \
                    </div>\
                    <div class="col-md-3" style="padding-top:5px; padding-bottom:5px">\
                        <label for="ta1">Alumnos: </label>\
                        <input type="number" style="width: 40%" id="ta'+a+'" name="ta'+a+'" placeholder="Ej. 30" min="0" required>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';

    document.getElementById('grupos').appendChild(div);
    document.getElementById('ngtotal').innerHTML = (a+1);
    document.getElementById('ng').value = parseInt(a+1);
    return div
}

function delGroup(id) {
    const element = document.getElementById('grupos').lastChild;
    document.getElementById('grupos').removeChild(element);
    
    if((document.getElementById('ng').value - 1)==-1){
        document.getElementById('ngtotal').innerHTML = 0;
        document.getElementById('ng').value = 0;
    }else{
        document.getElementById('ngtotal').innerHTML = document.getElementById('ng').value - 1;
        document.getElementById('ng').value = document.getElementById('ng').value - 1;
    }
}

function valGroup(){
    if(document.getElementById('ng').value == 0){
        alert('Favor de agregar almenos un grupo');
        return false;
    }else{
        /*
        var ng = document.getElementById('ng').value;
        var ng = parseInt(ng)
        var grupos = [];
        let x = 0;
        
        while (x != ng) {
            var grupo = [];
            grupo.push(document.getElementById('gr'+x).value);
            grupo.push(document.getElementById('gu'+x).value);
            grupo.push(document.getElementById('ta'+x).value);
            grupos.push(grupo);
            x++;
        }
        document.getElementById('grupostotal').value = grupos;
        console.log(document.getElementById('grupostotal').value)
        */
    }
}
