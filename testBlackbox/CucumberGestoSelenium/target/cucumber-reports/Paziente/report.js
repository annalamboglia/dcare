$(document).ready(function() {var formatter = new CucumberHTML.DOMFormatter($('.cucumber-report'));formatter.uri("file:src/test/resources/Features/Paziente/1_InserisciPaziente.feature");
formatter.feature({
  "name": "Inserisci il paziente",
  "description": "",
  "keyword": "Feature"
});
formatter.scenarioOutline({
  "name": "Inserimento paziente",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@InserisciPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.step({
  "name": "I open the \"http://localhost/\"",
  "keyword": "When "
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "click on Aggiungi Paziente",
  "keyword": "And "
});
formatter.step({
  "name": "insert \u003cnome\u003e,\u003ccognome\u003e,\u003cDatadiNascita\u003e, \u003cResidenza\u003e, \u003cProvincia\u003e,\u003cCAP\u003e,\u003cTelefono\u003e,\u003cCellulare\u003e,\u003cEmail\u003e,\u003cSesso\u003e,\u003cCitta\u003e,\u003cPrestazioniPer\u003e",
  "keyword": "And "
});
formatter.step({
  "name": "click CalcolaCodiceFiscale",
  "keyword": "And "
});
formatter.step({
  "name": "click Aggiungi Paziente",
  "keyword": "And "
});
formatter.step({
  "name": "you have add patient",
  "keyword": "Then "
});
formatter.examples({
  "name": "",
  "description": "",
  "keyword": "Examples",
  "rows": [
    {
      "cells": [
        "nome",
        "cognome",
        "DatadiNascita",
        "Residenza",
        "Provincia",
        "CAP",
        "Telefono",
        "Cellulare",
        "Email",
        "Sesso",
        "Citta",
        "PrestazioniPer"
      ]
    },
    {
      "cells": [
        "\"Mario\"",
        "\"Vitaglione\"",
        "\"12/12/1998\"",
        "\"Napoli\"",
        "\"Napoli\"",
        "\"80126\"",
        "\"000000\"",
        "\"0000000\"",
        "\"Anna@gmail.com\"",
        "\"Maschio\"",
        "\"Napoli\"",
        "\"Anna\""
      ]
    }
  ]
});
formatter.scenario({
  "name": "Inserimento paziente",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@InserisciPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.match({
  "location": "StepDef.StepDef.open_Browser()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I open the \"http://localhost/\"",
  "keyword": "When "
});
formatter.match({
  "location": "StepDef.StepDef.i_open_the(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.i_do_the_login()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Aggiungi Paziente",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Aggiungi_Paziente()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"Mario\",\"Vitaglione\",\"12/12/1998\", \"Napoli\", \"Napoli\",\"80126\",\"000000\",\"0000000\",\"Anna@gmail.com\",\"Maschio\",\"Napoli\",\"Anna\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert(java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String,java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click CalcolaCodiceFiscale",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_CalcolaCodiceFiscale()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click Aggiungi Paziente",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_Aggiungi_Paziente()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "you have add patient",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.you_have_add_patient()"
});
formatter.result({
  "status": "passed"
});
formatter.uri("file:src/test/resources/Features/Paziente/2_ModificaPaziente.feature");
formatter.feature({
  "name": "Modifica Paziente",
  "description": "",
  "keyword": "Feature"
});
formatter.scenarioOutline({
  "name": "Modifica paziente dati anagrafici",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@ModificaPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.step({
  "name": "I open the \u003clink\u003e",
  "keyword": "When "
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "click on Lista Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "insert \u003cname\u003e on Search Bar",
  "keyword": "And "
});
formatter.step({
  "name": "click on Paziente with \u003cname\u003e and \u003csurname\u003e",
  "keyword": "And "
});
formatter.step({
  "name": "click Modifica",
  "keyword": "And "
});
formatter.step({
  "name": "Modifica Dati anagrafici  \u003cemail\u003e",
  "keyword": "And "
});
formatter.step({
  "name": "click on Modifica",
  "keyword": "And "
});
formatter.step({
  "name": "hai modificato il paziente with \u003cemail\u003e",
  "keyword": "Then "
});
formatter.examples({
  "name": "",
  "description": "",
  "keyword": "Examples",
  "rows": [
    {
      "cells": [
        "link",
        "name",
        "surname",
        "email"
      ]
    },
    {
      "cells": [
        "\"http://localhost/\"",
        "\"Mario\"",
        "\"Vitaglione\"",
        "\"nuovamail1@gmail.com\""
      ]
    }
  ]
});
formatter.scenario({
  "name": "Modifica paziente dati anagrafici",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@ModificaPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.match({
  "location": "StepDef.StepDef.open_Browser()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I open the \"http://localhost/\"",
  "keyword": "When "
});
formatter.match({
  "location": "StepDef.StepDef.i_open_the(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.i_do_the_login()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Lista Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Lista_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"Mario\" on Search Bar",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert_on_Search_Bar(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Paziente with \"Mario\" and \"Vitaglione\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Paziente_with_and(java.lang.String,java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click Modifica",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_Modifica()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "Modifica Dati anagrafici  \"nuovamail1@gmail.com\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.modifica_Dati_anagrafici(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Modifica",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Modifica()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "hai modificato il paziente with \"nuovamail1@gmail.com\"",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.hai_modificato_il_paziente_with(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.uri("file:src/test/resources/Features/Paziente/3_RicercaPaziente.feature");
formatter.feature({
  "name": "Ricerca di un paziente",
  "description": "",
  "keyword": "Feature"
});
formatter.scenarioOutline({
  "name": "Ricerca di un paziente presente nella lista pazienti",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@RicercaPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.step({
  "name": "I open the \u003clink\u003e",
  "keyword": "When "
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "click on Lista Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "insert \u003cname\u003e on Search Bar",
  "keyword": "And "
});
formatter.step({
  "name": "you have the patients \u003cname\u003e",
  "keyword": "Then "
});
formatter.examples({
  "name": "",
  "description": "",
  "keyword": "Examples",
  "rows": [
    {
      "cells": [
        "link",
        "name"
      ]
    },
    {
      "cells": [
        "\"http://localhost/\"",
        "\"Mario\""
      ]
    }
  ]
});
formatter.scenario({
  "name": "Ricerca di un paziente presente nella lista pazienti",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@RicercaPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.match({
  "location": "StepDef.StepDef.open_Browser()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I open the \"http://localhost/\"",
  "keyword": "When "
});
formatter.match({
  "location": "StepDef.StepDef.i_open_the(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.i_do_the_login()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Lista Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Lista_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"Mario\" on Search Bar",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert_on_Search_Bar(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "you have the patients \"Mario\"",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.you_have_the_patients(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.uri("file:src/test/resources/Features/Paziente/4_EliminaPaziente.feature");
formatter.feature({
  "name": "Elimina Paziente",
  "description": "",
  "keyword": "Feature"
});
formatter.scenarioOutline({
  "name": "Elimina paziente dati anagrafici",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@EliminaPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.step({
  "name": "I open the \u003clink\u003e",
  "keyword": "When "
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "click on Lista Pazienti",
  "keyword": "And "
});
formatter.step({
  "name": "insert \u003cname\u003e on Search Bar",
  "keyword": "And "
});
formatter.step({
  "name": "click on Paziente with \u003cname\u003e and \u003csurname\u003e",
  "keyword": "And "
});
formatter.step({
  "name": "click on elimina paziente",
  "keyword": "And "
});
formatter.step({
  "name": "click on elimina",
  "keyword": "And "
});
formatter.step({
  "name": "hai eliminato il paziente",
  "keyword": "Then "
});
formatter.examples({
  "name": "",
  "description": "",
  "keyword": "Examples",
  "rows": [
    {
      "cells": [
        "link",
        "name",
        "surname"
      ]
    },
    {
      "cells": [
        "\"http://localhost/\"",
        "\"Mario\"",
        "\"Vitaglione\""
      ]
    }
  ]
});
formatter.scenario({
  "name": "Elimina paziente dati anagrafici",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@EliminaPaziente"
    }
  ]
});
formatter.step({
  "name": "Open Browser",
  "keyword": "Given "
});
formatter.match({
  "location": "StepDef.StepDef.open_Browser()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I open the \"http://localhost/\"",
  "keyword": "When "
});
formatter.match({
  "location": "StepDef.StepDef.i_open_the(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "I do the login",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.i_do_the_login()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Lista Pazienti",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Lista_Pazienti()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"Mario\" on Search Bar",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert_on_Search_Bar(java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on Paziente with \"Mario\" and \"Vitaglione\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Paziente_with_and(java.lang.String,java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on elimina paziente",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_elimina_paziente()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on elimina",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_elimina()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "hai eliminato il paziente",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.hai_eliminato_il_paziente()"
});
formatter.result({
  "status": "passed"
});
});