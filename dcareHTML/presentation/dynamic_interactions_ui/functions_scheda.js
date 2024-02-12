/* Script per modificare il modal di modifica pagamento */
function setModalModificaPagamento(tr_tag, id_scheda, tipo_scheda) {

    /* Inserimento Fade */
    modalModifica = document.getElementById("modalModificaPagamento");
    modalModifica.classList.add("fade");

    /* Elementi della row: data, id_pagamento, importo, nota */
    tds = tr_tag.getElementsByTagName("td");

    let data = tds[0].innerHTML.split("-").reverse().join('-');
    let id_pagamento = tds[1].innerHTML;
    let importo = tds[2].innerHTML.replace('€', '');
    let nota = tds[3].innerHTML;

    document.getElementById("modalDataPagamento").value = data;
    document.getElementById("modalImportoPagamento").value = importo;
    document.getElementById("modalNotaPagamento").value = nota;

    let form = document.getElementById("modalModificaPagamentoForm")
    let action = "/business_logic/contabilita.php?id_scheda=:id_scheda&id_pagamento=:id_pagamento&tipo_scheda=:tipo_scheda";
    action = action.replace(":id_scheda", id_scheda);
    action = action.replace(":id_pagamento", id_pagamento);
    action = action.replace(":tipo_scheda", tipo_scheda)
    form.setAttribute("action", action);

    setModalEliminaPagamento(id_pagamento, id_scheda, tipo_scheda);
}

/* Script per modificare il modal elimina pagamento */
function setModalEliminaPagamento(id_pagamento, id_scheda, tipo_scheda) {

    let text = "Sei sicuro di voler rimuovere l'pagamento <b>:id_pagamento</b>?<br>Una volta rimosso, non sarà più possibile recuperarlo.";
    let body = document.getElementById("modalEliminaPagamentoBody");
    text = text.replace(":id_pagamento", id_pagamento)
    body.innerHTML = text;
    
    let eliminaButton = document.getElementById("modalEliminaPagamentoButton")
    let href = "/business_logic/contabilita.php?id_scheda=:id_scheda&id_pagamento=:id_pagamento&tipo_scheda=:tipo_scheda&action=eliminaPagamento";
    href = href.replace(":id_pagamento", id_pagamento)
    href = href.replace(":id_scheda", id_scheda)
    href = href.replace(":tipo_scheda", tipo_scheda)
    eliminaButton.setAttribute("href", href);
}


/* Script per la rimozione del fade dell'elimina pagamento */
function removeFadeModalModificaPagamento() {
    modal = document.getElementById("modalModificaPagamento");
    modal.classList.remove("fade");
}

/* Script per il calcolo della contabilità (modifca href btn) */
function setCalcolaHref(btn, data_id) {

    data = document.getElementById(data_id).value;
    btn.href = btn.href.replace(":data", data);
}