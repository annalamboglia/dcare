
Feature: Elimina Paziente
@EliminaPaziente

  Scenario Outline: Elimina paziente dati anagrafici
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on elimina paziente
    And click on elimina 
    Then hai eliminato il paziente 

    Examples: 
    | link  						 | name | surname |
      | "http://localhost/"| "Mario" | "Vitaglione"|

      
      
      