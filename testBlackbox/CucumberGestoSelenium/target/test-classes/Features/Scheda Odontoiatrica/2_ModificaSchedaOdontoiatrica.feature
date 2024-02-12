
Feature: Modifico Scheda Odontoiatrica
@ModificaOdontoiatriche

  Scenario Outline: Modifico una prestazione all interno di una scheda Odontoiatrica di un determinato paziente
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Pazienti
    And click on Lista Pazienti
    And insert <name> on Search Bar
    And click on Paziente with <name> and <surname>
    And click on Scheda Odontoiatrica
    And click on Registra Trattamento
    And insert the <ED> and <Prestazione>
    And Click on Aggiungi
    Then you have updated the Scheda Ortodontica with <ED> and <acronimo>

    Examples: 
      | link  						 | name 		| 	surname		 | ED 	|		Prestazione 		 | 	acronimo	|
      | "http://localhost/"| "Mario" 	|  "Vitaglione"| "35"	|		"Pulizia arcata" |	"PA"			|

      
      
      