
Feature: Elimina Scheda Ortodontica
@EliminaSchedaOrtodontica

  Scenario Outline: Elimino la scheda ortodontica di un determinato paziente
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on Scheda
    And click on Elimina Scheda Ortodontica
    And click on Elimina
    Then hai eliminato la Scheda Ortodontica

    Examples: 
      | link  						 | name | surname|
      | "http://localhost/"| "Mario" |  "Vitaglione"|




