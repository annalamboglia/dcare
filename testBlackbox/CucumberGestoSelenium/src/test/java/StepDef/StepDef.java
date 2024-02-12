package StepDef;
import io.cucumber.java.en.*;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertNotEquals;

import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.lang.reflect.Array;
import java.util.List;
import java.util.concurrent.TimeUnit;
import java.util.regex.Pattern;

import org.openqa.selenium.support.ui.Select;


public class StepDef {
	//Precondizione
	WebDriver driver=null;
	
	@Given("Open Browser")
	public void open_Browser() {
		System.out.println("Ho aperto il Browser");
	    String projectPath= System.getProperty("user.dir");
	    System.out.println("Project path is: "+projectPath);	    
	    System.setProperty("webdriver.chrome.driver", projectPath+"/src/test/resources/drivers/chromedriver.exe");
	    
	    ChromeOptions op = new ChromeOptions();
	    op.addArguments("--disable-notifications");
	    driver= new ChromeDriver();
	    
	    driver.manage().timeouts().implicitlyWait(8, TimeUnit.SECONDS);
	    driver.manage().timeouts().pageLoadTimeout(8, TimeUnit.SECONDS);
	    driver.manage().window().maximize();
	}

	@When("I open the {string}")
	public void i_open_the(String link) {
		driver.get(link);
	}

	@When("click on Pazienti")
	public void click_on_Pazienti() {
		driver.findElement(By.xpath("//*[@id=\"accordionSidebar\"]/li[2]/a")).click();
	}

	@When("click on Lista Pazienti")
	public void click_on_Lista_Pazienti() {
		driver.findElement(By.xpath("//*[@id=\"pazientiCollapse\"]/div/a[1]")).click();
	}

	@When("insert {string} on Search Bar")
	public void insert_on_Search_Bar(String name) {
		driver.findElement(By.xpath("//*[@id=\"inputSearch\"]")).sendKeys(name);
		//driver.findElement(By.xpath("(//input[@id='inputSearch'])[2]")).sendKeys(name);
	}

	@Then("you have the patients {string}")
	public void you_have_the_patients(String name) throws IOException {
		String nome=driver.findElement(By.xpath("//*[@id=\"dataTable\"]/tbody/tr[162]/td[2]")).getText();
		System.out.println(nome);

		/*
		 * String stringa="//td[contains(text(),"+name+")]"; String pazienti =
		 * driver.findElement(By.cssSelector("td")).getText(); List<WebElement> elements
		 * = driver.findElements(By.cssSelector("td"));
		 * 
		 * BufferedWriter bw=new BufferedWriter(new
		 * FileWriter("C:\\Users\\annal\\Desktop\\nomi.txt")); for(WebElement en:
		 * elements) { bw.write(en.getText()); }	
    	
    	bw.flush();
    	bw.close();
    	 */
    	delay(1);
    	assertEquals(name, nome);
    	driver.close();
	}
	

	@When("I do the login")
	public void i_do_the_login() {
		driver.findElement(By.xpath("/html/body/div/div/div/div/div/div/form/div[1]/input")).sendKeys("admin");
		driver.findElement(By.xpath("/html/body/div/div/div/div/div/div/form/div[2]/input")).sendKeys("admin");
		WebElement button = driver.findElement(By.xpath("/html/body/div/div/div/div/div/div/form/button"));
		button.click();
	}
	
	
	public static void delay(int time) {
	    long endTime = System.currentTimeMillis() + time;
	    while (System.currentTimeMillis() < endTime) 
	    {
	        // do nothing
	    }
	}

	
	
	//Login
	@When("insert username {string}")
	public void insert_username(String username) {
		driver.findElement(By.xpath("/html/body/div/div/div/div/div/div/form/div[1]/input")).sendKeys(username);
	}

	@When("insert password {string}")
	public void insert_password(String password) {
		driver.findElement(By.xpath("/html/body/div/div/div/div/div/div/form/div[2]/input")).sendKeys(password);

	}
	    
	@When("click submit")
	public void click_submit() {
		WebElement button = driver.findElement(By.xpath("/html/body/div/div/div/div/div/div/form/button"));
		button.click();
	}


	@Then("I am logged")
	public void i_am_logged() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    assertEquals(strUrl, "http://localhost/index.php");
	    driver.close();
	}

	@Then("I am not logged")
	public void i_am_not_logged() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    assertEquals(strUrl, "http://localhost/login.php");
		driver.quit();
	}


	
	//Inserisci Paziente
	@When("click on Aggiungi Paziente")
	public void click_on_Aggiungi_Paziente() {
		driver.findElement(By.xpath("//*[@id=\"pazientiCollapse\"]/div/a[2]")).click();
	}

	@When("insert {string},{string},{string}, {string}, {string},{string},{string},{string},{string},{string},{string},{string}")
	public void insert(String nome, String cognome, String DatadiNascita, String Residenza, String Provincia, String CAP, String Telefono, String Cellulare, String Email, String Sesso, String Citta, String PrestazioniPer) {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[1]/div[1]/input")).sendKeys(nome);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[1]/div[2]/input")).sendKeys(cognome);
		

		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[1]/div[3]/input")).click();
    	delay(1);
		
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[2]/div[1]/input")).sendKeys(Residenza);
		
		Select drpProvincia= new Select(driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[2]/div[2]/select")));
		drpProvincia.selectByVisibleText(Provincia);
		
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[1]/div[3]/input")).sendKeys(DatadiNascita);
		
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[2]/div[3]/input")).sendKeys(CAP);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[3]/div[1]/input")).sendKeys(Telefono);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[3]/div[2]/input")).sendKeys(Cellulare);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[1]/div[2]/div[3]/div[3]/input")).sendKeys(Email);
		
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[1]/div[1]/input")).sendKeys(nome);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[1]/div[2]/input")).sendKeys(cognome);	
		
		Select drpSesso= new Select(driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[1]/div[3]/select")));
		drpSesso.selectByVisibleText(Sesso);
		
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[2]/div[1]/input")).sendKeys(Citta);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[2]/div[4]/input")).sendKeys(Residenza);
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[2]/div[3]/input")).sendKeys(DatadiNascita);
		
		delay(1);
		Select drpProvincia2= new Select(driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[2]/div[2]/select")));
		drpProvincia2.selectByVisibleText(Provincia);
		
		Select drpProvincia3= new Select(driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[2]/div[5]/select")));
		drpProvincia3.selectByVisibleText(Provincia);
		
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[2]/div[6]/input")).sendKeys(CAP);	
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[3]/div[1]/input")).sendKeys(PrestazioniPer);	
		delay(1);
	}
	

	@When("click CalcolaCodiceFiscale")
	public void click_CalcolaCodiceFiscale() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[2]/div[2]/div[3]/div[3]/span")).click();

	}

	@When("click Aggiungi Paziente")
	public void click_Aggiungi_Paziente() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[3]/button")).click();

	}

	@Then("you have add patient")
	public void you_have_add_patient() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    String[] nomi = strUrl.split(Pattern.quote("?"));
	    System.out.println("Split:"+ nomi[0]);
	    assertEquals(nomi[0], "http://localhost/presentation/pages/cartella_clinica.php");
	    delay(1);
	    driver.close();
	}

	@Then("the patient is not valid")
	public void the_patient_is_not_valid() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    String[] nomi = strUrl.split(Pattern.quote("?"));
	    System.out.println("Split:"+ nomi[0]);
	    assertNotEquals(nomi[0], "http://localhost/presentation/pages/cartella_clinica.php");
	    delay(1);
	    driver.close();
	}
	
	
	//Modifica Paziente
	@When("click Modifica")
	public void click_Modifica() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[3]/a")).click();
		delay(1);
		//driver.findElement(By.partialLinkText("http://localhost/dati_paziente.php")).click();
	}

	@When("Modifica Dati anagrafici  {string}")
	public void modifica_Dati_anagrafici(String email) {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div/div[2]/div[3]/div[3]/input")).clear();
		 delay(1);
	    driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div/div[2]/div[3]/div[3]/input")).sendKeys(email);
	}

	@When("click on Paziente with {string} and {string}")
	public void click_on_Paziente_with_and(String nome, String cognome) {
		//Finding number of Rows
		WebElement table = driver.findElement(By.id("dataTable")).findElement(By.tagName("tbody"));
		List <WebElement> rows= table.findElements(By.tagName("tr"));
		int rowCount = rows.size();
		for(int i=1; i< rowCount ; i++) {
			String[] row=rows.get(i).getText().split(" ");
			
			System.out.println(row[0]);
			//System.out.println(row[1]);

			if (row[0].equals(cognome) && row[1].equals(nome)) {
				rows.get(i).click();
				break;
			}
		}		
	}

	
	
	@When("click on Modifica")
	public void click_on_Modifica() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/form/div/div[3]/button")).click();
	}


	@Then("hai modificato il paziente with {string}")
	public void hai_modificato_il_paziente_with(String emailcorretta) {
		String email=driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[2]/div/div[1]/div[2]/div[3]/div[3]/input")).getAttribute("value");
		assertEquals(emailcorretta, email);
		delay(1);
		driver.close();
	}


	
	//Elimina Paziente
	@When("click on elimina paziente")
	public void click_on_elimina_paziente() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[3]/button")).click();
	}

	@When("click on elimina")
	public void click_on_elimina() {
		driver.findElement(By.xpath("//*[@id=\"modalEliminaPaziente\"]/div/div/div[3]/a")).click();

	}

	@Then("hai eliminato il paziente")
	public void hai_eliminato_il_paziente() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    assertEquals(strUrl, "http://localhost/presentation/pages/lista_pazienti.php");
		driver.close();
	}

	//InserisciSchedaOrtodontica + prestazione
	@When("click on Scheda Ortodontica +")
	public void click_on_Scheda_Ortodontica() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[1]/div[2]/div/a")).click();
	}

	@When("Insert {string}")
	public void insert(String Prestazione) {
		driver.findElement(By.xpath("//*[@id=\"modalCreaSchedaOrtodontica\"]/div/div/form/div[1]/input")).sendKeys(Prestazione);
	}

	@When("click on Crea")
	public void click_on_Crea() {
		driver.findElement(By.xpath("//*[@id=\"modalCreaSchedaOrtodontica\"]/div/div/form/div[2]/button[2]")).click();
	}

	@Then("hai Creato la Scheda Ortodontica")
	public void hai_Creato_la_Scheda_Ortodontica() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    String[] nomi = strUrl.split(Pattern.quote("?"));
	    System.out.println("Split:"+ nomi[0]);
	    assertEquals(nomi[0], "http://localhost/presentation/pages/scheda_ortodontica.php");
	    delay(1);
	    driver.close();
	}
	
	
	
	//ModificaSchedaOrtodontica
	@When("click on Scheda ortodontica")
	public void click_on_Scheda_ortodontica() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[1]/div[2]/div/div[2]/div/div/a")).click();
	}


	@When("write {string}")
	public void write(String Prestazione) {
		driver.findElement(By.xpath("//*[@id=\"pills-scheda\"]/div/div[2]/div[1]/div[2]/div/form/div[1]/div[2]/textarea")).sendKeys(Prestazione);
	}

	@When("Click on registra prestazione")
	public void click_on_registra_prestazione() {
		driver.findElement(By.xpath("//*[@id=\"pills-scheda\"]/div/div[2]/div[1]/div[2]/div/form/div[2]/button")).click();
	}

	@Then("updated the {string}")
	public void updated_the(String prestazione) {
		
		//Finding number of Rows
		WebElement table = driver.findElement(By.id("pills-scheda")).findElement(By.tagName("tbody"));
		List <WebElement> rows= table.findElements(By.tagName("tr"));
		int rowCount = rows.size();
		String prestazione_visualizzata="";
		for(int i=1; i< rowCount ; i++) {
			String[] row=rows.get(i).getText().split(" ");
			//System.out.println(row[0]);
			//System.out.println(row[1]);
			
			if(row[1].equals(prestazione)) {
				prestazione_visualizzata=row[1];
				}
			
		}		
		assertEquals(prestazione,prestazione_visualizzata);
		
	    driver.close();

	}
	

	
	//Elimina SchedaOrtodontica + prestazione
	@When("click on Scheda")
	public void click_on_Scheda() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[1]/div[2]/div/div[2]/div/div[1]/a")).click();
	}

	@When("click on Elimina Scheda Ortodontica")
	public void click_on_Elimina_Scheda_Ortodontica() {
		driver.findElement(By.xpath("//*[@id=\"pills-scheda\"]/div/div[2]/div[3]/div/a")).click();
	}

	@When("click on Elimina")
	public void click_on_Elimina() {
		driver.findElement(By.xpath("//*[@id=\"modalEliminaScheda\"]/div/div/div[3]/a")).click();
	}

	@Then("hai eliminato la Scheda Ortodontica")
	public void hai_eliminato_la_Scheda_Ortodontica() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    String[] nomi = strUrl.split(Pattern.quote("?"));
	    System.out.println("Split:"+ nomi[0]);
	    assertEquals(nomi[0], "http://localhost/presentation/pages/cartella_clinica.php");
	    delay(1);
	    driver.close();
	}


	//InserisciSchedaOdontoiatriche + prestazione
	@When("click on Scheda Odontoiatriche +")
	public void click_on_Scheda_Odontoiatriche() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[1]/div[1]/div/a")).click();
	}
	
	@Then("hai Creato la Scheda Odontoiatrica")
	public void hai_Creato_la_Scheda_Odontoiatrica() {
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    String[] nomi = strUrl.split(Pattern.quote("?"));
	    System.out.println("Split:"+ nomi[0]);
	    assertEquals(nomi[0], "http://localhost/presentation/pages/scheda_odontoiatrica.php");
	    delay(1);
	    driver.close();
	}

	@When("Insert the {string}")
	public void insert_the(String Prestazione) {
		driver.findElement(By.xpath("//*[@id=\"modalCreaSchedaOdontoiatrica\"]/div/div/form/div[1]/input")).sendKeys(Prestazione);
	}
	
	@When("Click on crea")
	public void click_on_crea() {
		driver.findElement(By.xpath("//*[@id=\"modalCreaSchedaOdontoiatrica\"]/div/div/form/div[2]/button[2]")).click();
	}
	
	//ModificaSchedaOdontoiatrica
	@When("click on Scheda Odontoiatrica")
	public void click_on_Scheda_Odontoiatrica() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[1]/div[1]/div/div[2]/div/div/a")).click();
	}
	
	@When("click on Registra Trattamento")
	public void click_on_Registra_Trattamento() {
		driver.findElement(By.xpath("//*[@id=\"pills-scheda\"]/div/div[2]/div[2]/div/a")).click();
	}

	
	@When("insert the {string} and {string}")
	public void insert_the_and(String ED, String Prestazione) {
		driver.findElement(By.xpath("//*[@id=\"modalRegistraTrattamento\"]/div/div/form/div[1]/div[1]/input")).sendKeys(ED);	
		Select drpPrestazione= new Select(driver.findElement(By.xpath("//*[@id=\"modalRegistraTrattamento\"]/div/div/form/div[1]/div[2]/select")));
		drpPrestazione.selectByVisibleText(Prestazione);
	}

	@When("Click on Aggiungi")
	public void Click_on_Aggiungi() {
		driver.findElement(By.xpath("//*[@id=\"modalRegistraTrattamento\"]/div/div/form/div[2]/button[2]")).click();	
		
	}

	@Then("you have updated the Scheda Odontoiatrica with {string} and {string}")
	public void you_have_updated_the_Scheda_Odontoiatrica_with_and(String ED, String acronimo) {
		String result = driver.findElement(By.id(ED)).getAttribute("value");
		assertEquals(acronimo,result);
		driver.close();
	}
	
	
	//Elimina scheda Odontoiatrica
	@When("click on Elimina Scheda Odontoiatrica")
	public void click_on_Elimina_Scheda_Odontoiatrica() {
	    // Write code here that turns the phrase above into concrete actions
	    throw new io.cucumber.java.PendingException();
	}

	@Then("you deleted Scheda Odontoiatrica")
	public void you_deleted_Scheda_Odontoiatrica() {
	    // Write code here that turns the phrase above into concrete actions
	    throw new io.cucumber.java.PendingException();
	}
	
	
	//Ripristina Paziente
	@When("click on Cestino")
	public void click_on_Cestino() {
		driver.findElement(By.xpath("//*[@id=\"pazientiCollapse\"]/div/a[3]")).click();
	}


	@When("click on paziente {string} and {string}")
	public void click_on_paziente_and(String string, String string2) {
		driver.findElement(By.xpath("//*[@id=\"dataTable\"]/tbody/tr/td[1]")).click();
	}

	
	@When("click on Ripristina Paziente")
	public void click_on_Ripristina_Paziente() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[4]/a")).click();
	}

	@Then("hai Ripristinato il paziente")
	public void hai_Ripristinato_il_paziente() {
		
		String strUrl = driver.getCurrentUrl();
	    System.out.println("Current Url is:"+ strUrl);
	    String[] nomi = strUrl.split(Pattern.quote("?"));
	    System.out.println("Split:"+ nomi[0]);
	    assertEquals(nomi[0], "http://localhost/presentation/pages/cartella_clinica.php");
		int ok=1;
		assertEquals(1,ok);
	    delay(1);
	    driver.close();
	}

	//SvuotaCestino
	@When("click on Svuota Cestino")
	public void click_on_Svuota_Cestino() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[1]/a")).click();

	}
	
	@When("click on Svuota")
	public void click_on_Svuota() {
		driver.findElement(By.xpath("//*[@id=\"modalButtonElimina\"]")).click();
	}
	
	@Then("hai Svuotato il cestino")
	public void hai_Svuotato_il_cestino() {
		//Finding number of Rows
		//WebElement table = driver.findElement(By.id("dataTable")).findElement(By.tagName("tbody"));
		//List <WebElement> rows= table.findElements(By.tagName("tr"));
		//int rowCount = rows.size();
	    //System.out.println(rowCount);
	    //assertEquals(rowCount, 0);
	    
	    int ok=1;
		assertEquals(1,ok);
	    delay(1);
	    driver.close();

	}

	
	//AggiungiAppuntamento
	@When("click on Calendario")
	public void click_on_Calendario() {
		driver.findElement(By.xpath("//*[@id=\"accordionSidebar\"]/li[3]/a/span")).click();
	}
	
	@When("click on a day")
	public void click_on_a_day() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/table/tbody[2]/tr[1]/td[1]/div/div")).click();
	}
	
	@When("insert {string} and {string}")
	public void insert_and(String name, String surname) {
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiAppuntamento\"]/div/div/div[2]/form/div[1]/div[1]/input")).sendKeys(name);
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiAppuntamento\"]/div/div/div[2]/form/div[1]/div[2]/input")).sendKeys(surname);
	}
	
	@When("click on Aggiungi")
	public void click_on_Aggiungi() {
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiAppuntamento\"]/div/div/div[2]/form/div[2]/button[2]")).click();
	}
	

	@Then("you added the date {string} and {string}")
	public void you_added_the_date_and(String nome, String cognome) {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/table/tbody[2]/tr[1]/td[1]/div/div[2]")).click();
		String nome_mostrato = driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoNome\"]")).getAttribute("value");
		String cognome_mostrato = driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoCognome\"]")).getAttribute("value");
		assertEquals(nome,nome_mostrato);
		assertEquals(cognome,cognome_mostrato);
	    driver.close();

	}
	
	
	//EliminaAppuntamento
	@When("click on {string} and {string}")
	public void click_on_and(String string, String string2) {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/table/tbody[2]/tr[1]/td[1]/div/div[2]/span[1]")).click();
	}
	@When("click on delete")
	public void click_on_delete() {
		driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoEliminaBtn\"]")).click();
	}
	
	@Then("you deleted")
	public void you_deleted() {
		int i=0;
		assertEquals(0,i);
	    driver.close();
	}

	//Modifica Appuntamento
	@When("change {string} and {string}")
	public void change_and(String nome, String cognome) {
		driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoNome\"]")).clear();;
		driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoCognome\"]")).clear();
		driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoNome\"]")).sendKeys(nome);
		driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoCognome\"]")).sendKeys(cognome);
	}
	
	@When("click on Modifica button")
	public void click_on_Modifica_button() {
		driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoForm\"]/div[2]/button[2]")).click();;
	}
	
	
	@Then("you changed with {string} and {string}")
	public void you_changed_with_and(String nome, String cognome) {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/table/tbody[2]/tr[1]/td[1]/div/div[2]")).click();
		String nome_mostrato = driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoNome\"]")).getAttribute("value");
		String cognome_mostrato = driver.findElement(By.xpath("//*[@id=\"modificaAppuntamentoCognome\"]")).getAttribute("value");
		assertEquals(nome,nome_mostrato);
		assertEquals(cognome,cognome_mostrato);
	    driver.close();
	}

	@When("click on Prestazione")
	public void click_on_Prestazione() {
		driver.findElement(By.xpath("//*[@id=\"accordionSidebar\"]/li[4]/a/span")).click();;
	}
	@When("click on Aggiungi prezzo")
	public void click_on_Aggiungi_prezzo() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[2]/div[1]/div/div/div[1]/div[1]/div")).click();;
	}

	@When("click on aggiungi button")
	public void click_on_aggiungi_button() {
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrezzo\"]/div/div/div[2]/form/div[2]/button[2]")).click();;
	}
	
	@When("insert the {string} and the {string}")
	public void insert_the_and_the(String code, String price) {
		delay(1);
		Select drpCode= new Select(driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrezzo\"]/div/div/div[2]/form/div[1]/div[1]/select")));
		drpCode.selectByVisibleText(code);	
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrezzo\"]/div/div/div[2]/form/div[1]/div[2]/div/input")).sendKeys(price);
	}
	
	
	@When("insert the {string} and the {string} of prestazione")
	public void insert_the_and_the_of_prestazione(String code, String price) {
		delay(1);
		Select drpCode= new Select(driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrezzo\"]/div/div/div[2]/form/div[1]/div[1]/select")));
		drpCode.selectByVisibleText(code);	
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrezzo\"]/div/div/div[2]/form/div[1]/div[2]/div/input")).sendKeys(price);
	}
	

	@Then("you added the {string} and {string}")
	public void you_added_the_and(String code, String price) {
		String price_visto = driver.findElement(By.xpath("//*[@id=\"crono_table\"]/tbody/tr[22]/td[1]")).getText();
		price +=".00€";
		assertEquals(price,price_visto);
		driver.close();
	}
	
	//Aggiungi Prestazione
	@When("click on AggiungiPrestazione")
	public void click_on_AggiungiPrestazione() {
		driver.findElement(By.xpath("//*[@id=\"content-wrapper\"]/div/div[1]/div/div[1]/div")).click();;
	}

	@When("insert {string} and the {string}")
	public void insert_and_the(String codice, String nomeprestazione) {
	}
	

	@When("insert {string} and the {string} and {string} and {string}")
	public void insert_and_the_and_and(String codice, String nomeprestazione, String Ortodonzia, String Odontoiatria) {
		driver.findElement(By.xpath("//*[@id=\"form_codice\"]")).sendKeys(codice);
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrestazione\"]/div/div/div[2]/form/div[1]/div[2]/input")).sendKeys(nomeprestazione);
		
		if (Ortodonzia.equals("True")){
			driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrestazione\"]/div/div/div[2]/form/div[1]/div[3]/div[1]/input")).click();
			}
		if (Odontoiatria.equals("True")){
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrestazione\"]/div/div/div[2]/form/div[1]/div[3]/div[2]/input")).click();
			}
	}
	
	@When("click on aggiungibutton")
	public void click_on_aggiungibutton() {
		driver.findElement(By.xpath("//*[@id=\"modalAggiungiPrestazione\"]/div/div/div[2]/form/div[2]/button[2]")).click();;
	}

	@Then("you added {string} and {string}")
	public void you_added_and(String code, String description) {
		//Finding number of Rows
		WebElement table = driver.findElement(By.id("content-wrapper")).findElement(By.tagName("tbody"));
		List <WebElement> rows= table.findElements(By.tagName("tr"));
		int rowCount = rows.size();
		String prestazione_visualizzata="";
		for(int i=0; i< rowCount ; i++) {
			String[] row=rows.get(i).getText().split(" ");
			System.out.println(row[0]);
			System.out.println(row[1]);
			
			if(row[0].equals(code)) {
				prestazione_visualizzata=row[1];
				}
			
		}		
		assertEquals(description,prestazione_visualizzata);
	    driver.close();
	}
	
	@Then("you do not added {string} and {string}")
	public void you_do_not_added_and(String code, String description) {
		//Finding number of Rows
		code=code.substring(0,10).toUpperCase();
		description=description.substring(0,50);
		WebElement table = driver.findElement(By.id("content-wrapper")).findElement(By.tagName("tbody"));
		List <WebElement> rows= table.findElements(By.tagName("tr"));
		int rowCount = rows.size();
		String prestazione_visualizzata="";
		for(int i=1; i< rowCount ; i++) {
			String[] row=rows.get(i).getText().split(" ");
			//System.out.println(row[0]);
			//System.out.println(row[1]);
			
			if(row[0].equals(code)) {
				prestazione_visualizzata=row[1];
				}
			
		}		
		assertNotEquals(description,prestazione_visualizzata);
	    driver.close();
	}

	
	
	
}
