
Feature: Inserisci Scheda Ortodontica
@InserisciSchedaOrtodontica

  Scenario Outline: Inserisco una prestazione all interno di una scheda ortodontica di un determinato paziente
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on Scheda Ortodontica +
    And Insert <Tipoprestazione>
    And click on Crea
    Then hai Creato la Scheda Ortodontica

    Examples: 
      | link  						 | name 		| 	surname		 | Tipoprestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Pulizia denti" |




