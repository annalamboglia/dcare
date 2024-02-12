
Feature: Login
@Login

  Scenario Outline: Login corretto
    Given Open Browser
    When I open the "http://localhost/"
    And insert username <admin>
    And insert password <password>
    And click submit
    Then I am logged

    Examples: 
      | admin  						 	| password | 
      | "admin"	 	| "admin" |  

  Scenario Outline: Login Sbagliato
    Given Open Browser
    When I open the "http://localhost/"
    And insert username <admin>
    And insert password <password>
    And click submit
    Then I am not logged

    Examples: 
      | admin  						 	| password | 
			| "sbagliato@gmail.com"| "pss" |  
			
			
			
			