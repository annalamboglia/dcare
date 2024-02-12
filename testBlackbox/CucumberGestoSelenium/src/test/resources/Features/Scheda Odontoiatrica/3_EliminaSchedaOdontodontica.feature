
Feature: Elimina Scheda Odontoiatrica
@EliminaOdontoiatriche

  Scenario Outline: Elimino una prestazione all interno di una scheda odontoiatrica di un determinato paziente
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on Scheda Odontoiatrica
    And click on Elimina Scheda Odontoiatrica
    And click on Elimina
    Then you deleted Scheda Odontoiatrica

    Examples: 
      | link  						 | name 		| 	surname		 | Tipoprestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Pulizia denti" |



