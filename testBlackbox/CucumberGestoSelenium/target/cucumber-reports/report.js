$(document).ready(function() {var formatter = new CucumberHTML.DOMFormatter($('.cucumber-report'));formatter.uri("file:src/test/resources/Features/Prestazione/AggiungiPrestazione.feature");
formatter.feature({
  "name": "Aggiungi una prestazione",
  "description": "",
  "keyword": "Feature"
});
formatter.scenarioOutline({
  "name": "Aggiungi una prestazione non valida",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@AggiungiPrestazione"
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
  "name": "click on Prestazione",
  "keyword": "And "
});
formatter.step({
  "name": "click on AggiungiPrestazione",
  "keyword": "And "
});
formatter.step({
  "name": "insert \u003ccode\u003e and the \u003cdescription\u003e and \u003cOrtodonzia\u003e and \u003cOdontoiatria\u003e",
  "keyword": "And "
});
formatter.step({
  "name": "click on aggiungibutton",
  "keyword": "And "
});
formatter.step({
  "name": "you do not added \u003ccode\u003e and \u003cdescription\u003e",
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
        "code",
        "description",
        "Ortodonzia",
        "Odontoiatria"
      ]
    },
    {
      "cells": [
        "\"http://localhost/\"",
        "\"PROVA Se\"",
        "\"PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI\"",
        "\"True\"",
        "\"False\""
      ]
    },
    {
      "cells": [
        "\"http://localhost/\"",
        "\"PROVA TROPPI CARATTERIi\"",
        "\"PROVA\"",
        "\"True\"",
        "\"True\""
      ]
    },
    {
      "cells": [
        "\"http://localhost/\"",
        "\"prestaz �\"",
        "\"PROVA\"",
        "\"False\"",
        "\"False\""
      ]
    }
  ]
});
formatter.scenario({
  "name": "Aggiungi una prestazione non valida",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@AggiungiPrestazione"
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
  "name": "click on Prestazione",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Prestazione()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on AggiungiPrestazione",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_AggiungiPrestazione()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"PROVA Se\" and the \"PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI\" and \"True\" and \"False\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert_and_the_and_and(java.lang.String,java.lang.String,java.lang.String,java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on aggiungibutton",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_aggiungibutton()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "you do not added \"PROVA Se\" and \"PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI\"",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.you_do_not_added_and(java.lang.String,java.lang.String)"
});
formatter.result({
  "error_message": "java.lang.StringIndexOutOfBoundsException: begin 0, end 10, length 8\r\n\tat java.base/java.lang.String.checkBoundsBeginEnd(String.java:3720)\r\n\tat java.base/java.lang.String.substring(String.java:1909)\r\n\tat StepDef.StepDef.you_do_not_added_and(StepDef.java:705)\r\n\tat ✽.you do not added \"PROVA Se\" and \"PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI\"(file:///C:/Users/annal/eclipse-workspaceDcare/CucumberDcareSelenium/src/test/resources/Features/Prestazione/AggiungiPrestazione.feature:16)\r\n",
  "status": "failed"
});
formatter.scenario({
  "name": "Aggiungi una prestazione non valida",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@AggiungiPrestazione"
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
  "name": "click on Prestazione",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Prestazione()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on AggiungiPrestazione",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_AggiungiPrestazione()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"PROVA TROPPI CARATTERIi\" and the \"PROVA\" and \"True\" and \"True\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert_and_the_and_and(java.lang.String,java.lang.String,java.lang.String,java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on aggiungibutton",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_aggiungibutton()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "you do not added \"PROVA TROPPI CARATTERIi\" and \"PROVA\"",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.you_do_not_added_and(java.lang.String,java.lang.String)"
});
formatter.result({
  "error_message": "java.lang.StringIndexOutOfBoundsException: begin 0, end 50, length 5\r\n\tat java.base/java.lang.String.checkBoundsBeginEnd(String.java:3720)\r\n\tat java.base/java.lang.String.substring(String.java:1909)\r\n\tat StepDef.StepDef.you_do_not_added_and(StepDef.java:706)\r\n\tat ✽.you do not added \"PROVA TROPPI CARATTERIi\" and \"PROVA\"(file:///C:/Users/annal/eclipse-workspaceDcare/CucumberDcareSelenium/src/test/resources/Features/Prestazione/AggiungiPrestazione.feature:16)\r\n",
  "status": "failed"
});
formatter.scenario({
  "name": "Aggiungi una prestazione non valida",
  "description": "",
  "keyword": "Scenario Outline",
  "tags": [
    {
      "name": "@AggiungiPrestazione"
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
  "name": "click on Prestazione",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_Prestazione()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on AggiungiPrestazione",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_AggiungiPrestazione()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "insert \"prestaz �\" and the \"PROVA\" and \"False\" and \"False\"",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.insert_and_the_and_and(java.lang.String,java.lang.String,java.lang.String,java.lang.String)"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "click on aggiungibutton",
  "keyword": "And "
});
formatter.match({
  "location": "StepDef.StepDef.click_on_aggiungibutton()"
});
formatter.result({
  "status": "passed"
});
formatter.step({
  "name": "you do not added \"prestaz �\" and \"PROVA\"",
  "keyword": "Then "
});
formatter.match({
  "location": "StepDef.StepDef.you_do_not_added_and(java.lang.String,java.lang.String)"
});
formatter.result({
  "error_message": "java.lang.StringIndexOutOfBoundsException: begin 0, end 10, length 9\r\n\tat java.base/java.lang.String.checkBoundsBeginEnd(String.java:3720)\r\n\tat java.base/java.lang.String.substring(String.java:1909)\r\n\tat StepDef.StepDef.you_do_not_added_and(StepDef.java:705)\r\n\tat ✽.you do not added \"prestaz �\" and \"PROVA\"(file:///C:/Users/annal/eclipse-workspaceDcare/CucumberDcareSelenium/src/test/resources/Features/Prestazione/AggiungiPrestazione.feature:16)\r\n",
  "status": "failed"
});
});