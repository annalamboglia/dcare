package StepDef;

import org.junit.runner.RunWith;

import io.cucumber.junit.Cucumber;
import io.cucumber.junit.CucumberOptions;

@RunWith(Cucumber.class)
@CucumberOptions(features="src/test/resources/Features/Prestazione",
	glue= {"StepDef"},
	monochrome=true,
	plugin = { "pretty", "html:target/cucumber-reports/" },
	tags="@AggiungiPrestazione"
	)
	



public class TestRunner {

}


//plugin= {"pretty", "html:target/reports","json:target/reports/cucumber.json"},
		//	"junit:target/reports/cucumber.xml"},
	//plugin = { "pretty", "html:target/cucumber-reports" },

//plugin= {"pretty", "html:target/reports"},
//plugin= {"pretty", "json:target/reports/cucumber.json"},
//plugin= {"pretty", "junit:target/reports/cucumber.xml"},
//tags= {"@AggiungiPrestazione"}

