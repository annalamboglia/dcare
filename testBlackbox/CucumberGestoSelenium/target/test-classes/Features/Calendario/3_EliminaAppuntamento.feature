Feature: Elimina un appuntamento nel calendario
	@EliminaAppuntamento
  Scenario Outline: Elimina un appuntamento con un determinato paziente nel calendario
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Calendario
    And click on <name> and <surname>
    And click on delete 
    Then you deleted

    Examples: 
      | link  						 | name 		| 	surname		 | Tipoprestazione |
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "Pulizia denti" |
  #    | "http://localhost/"| "Octavia" |  
  #    | "http://localhost/"| "Pippo" |  