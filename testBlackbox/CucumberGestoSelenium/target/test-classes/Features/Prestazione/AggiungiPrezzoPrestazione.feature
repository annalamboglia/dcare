
Feature: Aggiungi il prezzo di una prestazione

	@AggiungiPrezzoPrestazione
  Scenario Outline: Aggiungi il prezzo di una prestazione
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Prestazione
    And click on Aggiungi prezzo
    And insert the <code> and the <price> of prestazione
    And click on aggiungi button
    Then you added the <code> and <price>

    Examples: 
      | link  						 | code 		| 	price		 | 
      | "http://localhost/"| "ANA" 			|  "30"		 | 

      
      
      