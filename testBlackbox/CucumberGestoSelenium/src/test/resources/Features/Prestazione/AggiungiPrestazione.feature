
Feature: Aggiungi una prestazione
@AggiungiPrestazione	

 Scenario Outline: Aggiungi una prestazione valida
    Given Open Browser
    When I open the <link>
    And I do the login
    And click on Prestazione
    And click on AggiungiPrestazione
    And insert <code> and the <description> and <Ortodonzia> and <Odontoiatria>
    And click on aggiungibutton
    Then you added <code> and <description>

    Examples: 
      | link  						 | code 							| 	description		 | Ortodonzia | Odontoiatria |
      | "http://localhost/"| "PRESAZ" 						|  "PROVA"		 | "True"			|  "True"			 |
      | "http://localhost/"| "13223" 			|  "PROVA"		 | "True"			|  "True"			 |
			| "http://localhost/"| "PROVA12" 			|  "PROVA"		 | "True"			|  "False"			 |

			
	Scenario Outline: Aggiungi una prestazione non valida
	    Given Open Browser
	    When I open the <link>
	    And I do the login
	    And click on Prestazione
	    And click on AggiungiPrestazione
	    And insert <code> and the <description> and <Ortodonzia> and <Odontoiatria>
	    And click on aggiungibutton
	    Then you do not added <code> and <description>
	
	    Examples: 
	      | link  						 | code 							| 	description		 | Ortodonzia | Odontoiatria |
	      | "http://localhost/"| "PROVA Se" 	|  "PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI PROVA SBAGLIATA TROPPI CARATTERI"		 | "True"			|  "False"|
	      | "http://localhost/"| "PROVA TROPPI CARATTERIi" 			|  "PROVA"		 | "True"			|  "True"			 |
				| "http://localhost/"| "prestaz ò" 			|  "PROVA"		 | "False"			|  "False"			 |
	      
	      
	      
	      