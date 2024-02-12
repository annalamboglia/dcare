
Feature: Modifica Scheda Ortodontica
@ModificaOrtodontica

  Scenario Outline: Modifica una prestazione all interno di una scheda Ortodontica di un determinato paziente
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on Scheda ortodontica
    And write <prestazione>
    And Click on registra prestazione
    Then updated the <prestazione>

    Examples: 
      | link  						 | name 		| 	surname		 | prestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Carie" |

      
      
      
      
      