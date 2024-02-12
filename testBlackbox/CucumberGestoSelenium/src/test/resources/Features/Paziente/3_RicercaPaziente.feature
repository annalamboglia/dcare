
Feature: Ricerca di un paziente
	@RicercaPaziente

  Scenario Outline: Ricerca di un paziente presente nella lista pazienti
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    Then you have the patients <name>

    Examples: 
      | link  						 | name | 
      | "http://localhost/"| "Mario" |  
   #   | "http://localhost/"| "Octavia" |  



