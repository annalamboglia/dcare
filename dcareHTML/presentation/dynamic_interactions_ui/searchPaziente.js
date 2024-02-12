function searchPaziente() {

    this.visible_elements = [];
    
    var input = document.getElementById("inputSearch").value.toLowerCase();
    var rows = document.getElementById("dataTable").rows;


    for (i = 1; i < rows.length; i++) {
        var tds = rows[i].getElementsByTagName("td");
        var cognome = tds[0].innerHTML.toLowerCase().replace(" ", "");
        var nome = tds[1].innerHTML.toLowerCase().replace(" ", "")
        var cn = cognome + " " + nome;
        var nc = nome + " " + cognome;

        if (input != cn.substr(0, input.length) && input != nc.substr(0, input.length)) {
            rows[i].style.display = "none";
        }
        else {
            rows[i].style.display = "";
            this.visible_elements.push(rows[i]);
        }

    }
}
