
Feature: Modifica Paziente
@ModificaPaziente

  Scenario Outline: Modifica paziente dati anagrafici
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click Modifica
    And Modifica Dati anagrafici  <email>
    And click on Modifica
    Then hai modificato il paziente with <email>

    Examples: 
      | link  						 | name | 		surname 				| email |
      | "http://localhost/"| "Mario" | "Vitaglione"	|  "nuovamail1@gmail.com" |
   #   | "http://localhost/"| "Mario" | "Vitaglione" | "supercalifragiliespiralidososupercalifragiliespiralidososupercalifragiliespiralidoso@gmail.com" |

      
      
   