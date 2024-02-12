
Feature: Modifica un appuntamento nel calendario
@ModificaAppuntamento

  Scenario Outline: Modifica un appuntamento con un determinato paziente nel calendario
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Calendario
    And click on <name> and <surname>
    And change <name2> and <surname2>
    And click on Modifica button
    Then you changed with <name2> and <surname2>

    Examples: 
      | link  						 | name 		| 	surname		 | name2 			| surname2 |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Agostino" | "Swift"  |


