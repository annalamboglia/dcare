
Feature: Inserisci Scheda Odontoiatrica
@InserisciOdontoiatriche

  Scenario Outline: Inserisco una prestazione all interno di una scheda odontoiatrica di un determinato paziente
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on Scheda Odontoiatriche +
    And Insert the <Tipoprestazione>
    And Click on crea 
    Then hai Creato la Scheda Odontoiatrica

    Examples: 
      | link  						 | name 		| 	surname		 | Tipoprestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Pulizia denti" |




