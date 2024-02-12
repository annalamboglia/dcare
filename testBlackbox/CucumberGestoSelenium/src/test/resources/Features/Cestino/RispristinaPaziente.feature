
Feature: Rispristina Paziente da cestino
@RipristinaPaziente

  Scenario Outline: Cerco un paziente nel cestino e lo rispristino
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Cestino
    And insert <name> on Search Bar
    And click on paziente <name> and <surname>
    And click on Ripristina Paziente
    Then hai Ripristinato il paziente
    Examples: 
      | link  						 | name 		| 	surname		 | Tipoprestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Pulizia denti" |



