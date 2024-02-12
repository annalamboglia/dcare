
Feature: Aggiungo un appuntamento nel calendario
@AggiungiAppuntamento


  Scenario Outline: Aggiungo un appuntamento con un determinato paziente nel calendario
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Calendario
    And click on a day
    And insert <name> and <surname>
    And click on Aggiungi 
    Then you added the date <name> and <surname>

    Examples: 
      | link  						 | name 		| 	surname		 | Tipoprestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Pulizia denti" |


