function up(x1, x2, x3, monto) {
    
    var t1 = document.getElementById(x1);
    var t2 = document.getElementById(x2);
    var t3 = document.getElementById(x3);
    var t4 = document.getElementById('cTot');
    if (t1.value < 5) {
        
        t1.value++;
        t2.value++;
        t3.value = (t1.value * monto).toFixed(2);
    }
    calculaTotal();
}

function dw(x1, x2, x3, monto) {
    
    var t1 = document.getElementById(x1);
    var t2 = document.getElementById(x2);
    var t3 = document.getElementById(x3);
    var t4 = document.getElementById('cTot');
    if (t1.value > 0) {
        
        t1.value--;
        t2.value--;
        t3.value = (t1.value * monto).toFixed(2);
    }
    calculaTotal();
}

function calculaTotal() {
    
    var tot1 = parseFloat(document.getElementById('c13').value);
    var tot2 = parseFloat(document.getElementById('c23').value);
    var tot3 = parseFloat(document.getElementById('c33').value);
    var tot = document.getElementById('cTot');
    tot.value = 'US$ ' + ((tot1 + tot2 + tot3).toFixed(2));
}