
Feature: Inserisci il paziente

	@InserisciPaziente
   Scenario Outline: Inserimento paziente Valido
    Given Open Browser
    When I open the "http://localhost/"
    And I do the login
    And click on Pazienti
    And click on Aggiungi Paziente
    And insert <nome>,<cognome>,<DatadiNascita>, <Residenza>, <Provincia>,<CAP>,<Telefono>,<Cellulare>,<Email>,<Sesso>,<Citta>,<PrestazioniPer>
    And click CalcolaCodiceFiscale
    And click Aggiungi Paziente
    Then you have add patient
    Examples: 
      | nome  	| cognome 		 | 	DatadiNascita	| Residenza | Provincia | CAP			| Telefono |	Cellulare | Email 					 | Sesso 			 | Citta 		| PrestazioniPer |
      | "Mario"	| "Vitaglione"  |  "12/12/1998"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Anna@gmail.com" | "Maschio" 	 | "Napoli" | "Anna"				 |
      | "Giosuè"	| "D'Antonio"  |  "12/12/1992"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Anna@gmail.com" | "Maschio" 	 | "Napoli" | "Anna"				 |
    

	
	Scenario Outline: Inserimento paziente non Valido
    Given Open Browser
    When I open the "http://localhost/"
    And I do the login
    And click on Pazienti
    And click on Aggiungi Paziente
    And insert <nome>,<cognome>,<DatadiNascita>, <Residenza>, <Provincia>,<CAP>,<Telefono>,<Cellulare>,<Email>,<Sesso>,<Citta>,<PrestazioniPer>
    And click CalcolaCodiceFiscale
    And click Aggiungi Paziente
    Then the patient is not valid
    Examples: 
      | nome  	| cognome 		 | 	DatadiNascita	| Residenza | Provincia | CAP			| Telefono |	Cellulare | Email 					 | Sesso 			 | Citta 		| PrestazioniPer |
      | "Mario"	| "Vitaglione"  |  "12/12/1998"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Mario@gmail.com" | "Maschio" 	 | "Napoli" | "Anna"				 |
      | "Caterina"	| "SupercalifragilisticexpialidociousSupercalifragilisticexpialidociousSupercalifragilisticexpialidocious"  |  "12/12/1998"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Anna@gmail.com" | "Femmina" 	 | "Napoli" | "Anna"|
      | "12345"	| "3413"  |  "12/12/1998"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Anna@gmail.com" | "Maschio" 	 | "Napoli" | "Anna"				 | 
      | "Giuseppe"	| "Rossi"  |  "25 maggio 2011"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Anna@gmail.com" | "Maschio" 	 | "Napoli" | "Mattia"|
      | "Mario"	| "Vitaglione"  |  "12/12/1998"	| "Napoli"	| "Napoli"  | "80126"	| "000000" |	"0000000" | "Mariochiocchiolagmail.com" | "Maschio" 	 | "Napoli" | "Anna"				 |
      | "Antonio"	| "D'amico"  |  "12/12/1998"	| "Napoli"	| "Napoli"  | "80126"	| "telefono" |	"cellulare" | "Mario@gmail.com" | "Maschio" 	 | "Napoli" | "Anna"				 |


	