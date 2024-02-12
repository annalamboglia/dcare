  
Feature: Svuoto il Cestino
@SvuotaCestino

  Scenario Outline: Elimino tutti i pazienti dal vestino
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Cestino
    And click on Svuota Cestino
    And click on Svuota
    Then hai Svuotato il cestino
    Examples: 
      | link  						 | 
      | "http://localhost/"|

      
      