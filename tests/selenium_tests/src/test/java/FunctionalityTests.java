import org.apache.commons.lang3.builder.ToStringExclude;
import org.junit.After;
import org.junit.Before;
import org.junit.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.Select;

import java.nio.file.Path;
import java.time.LocalDate;
import java.util.concurrent.TimeUnit;

import static junit.framework.TestCase.assertTrue;

public class FunctionalityTests {
	static WebDriver driver;
	String baseUrl = "http://localhost/";
	//String baseUrl = "http://mangumaailm.000webhostapp.com/";

	// Testimise kasutaja, peaks süsteemis varasemalt olemas olema
	String mainEmail = "test@example.com";
	String mainPassword = "testimine";

	@Before
	public void setUp() {
		// Ei lisanud geckodriver-it PATH-i, tehakse siin jooksutades, vaja muuta vastavalt masinale
		System.setProperty("webdriver.gecko.driver", "C:\\Users\\Ergo\\School\\Veebirakendused\\peobronn\\tests\\selenium_tests\\geckodriver.exe");
		driver = new FirefoxDriver();
		driver.get(baseUrl);
		driver.manage().timeouts().implicitlyWait(3, TimeUnit.SECONDS); // perhaps increase for non-localhost testing
	}

	@After
	public void tearDown(){
		driver.close();
	}

	private boolean isElementPresent(By by) {
		try {
			driver.findElement(by);
			return true;
		}
		catch (NoSuchElementException e) {
			return false;
		}
	}

	private void login(String email, String password) {
		driver.findElement(By.xpath("//input[@value='SISENE']")).click();
		driver.findElement(By.id("email")).sendKeys(email);
		driver.findElement(By.id("salasõna")).sendKeys(password);
		driver.findElement(By.xpath("//input[@value='Sisene']")).click();
	}

	private void logout() {
		driver.findElement(By.xpath("//input[@value='VÄLJU']")).click();
	}

	@Test
	public void navigationTest() {
		driver.findElement(By.linkText("KKK")).click();
		assertTrue(isElementPresent(By.xpath("//dt[text()='Kui pikalt võib virtuaalreaalsuses viibida?']")));
		driver.findElement(By.linkText("MÄNGUD & ELAMUSED")).click();
		assertTrue(isElementPresent(By.xpath("//p[@class='game-title text-center' and text()='Superhot']")));
		driver.findElement(By.linkText("Kontakt")).click();
		assertTrue(isElementPresent(By.xpath("//p[text()='Aadress: Kaarli pst. 8, Tallinn']")));
	}

	@Test
	public void changeLanguageTest() {
		assertTrue(isElementPresent(By.xpath("//h2[text()='Tutvustus']")));
		driver.findElement(By.id("eng-flag")).click();
		assertTrue(isElementPresent(By.xpath("//h2[text()='Introduction']")));
		driver.findElement(By.linkText("FAQ")).click();
		assertTrue(isElementPresent(By.xpath("//dt[text()='Is there a danger to hurt yourself?']")));
		driver.findElement(By.id("est-flag")).click();
		assertTrue(isElementPresent(By.xpath("//dt[text()='Kas on oht ennast vigastada?']")));
	}

	@Test
	public void loginAndLogoutTest() {
		assertTrue(isElementPresent(By.xpath("//input[@value='SISENE']")));
		login(mainEmail, mainPassword);
		assertTrue(isElementPresent(By.xpath("//input[@value='VÄLJU']")));
		logout();
		assertTrue(isElementPresent(By.xpath("//input[@value='REGISTREERU']")));
	}

	@Test
	public void registerAndDeleteAccountTest() {
		String testEmail = "qazwsxedc@example.com";
		String testPassword = "TKJHBNGU";
		driver.findElement(By.xpath("//input[@value='REGISTREERU']")).click();
		driver.findElement(By.id("eesnimi")).sendKeys("Kalle");
		driver.findElement(By.id("perenimi")).sendKeys("Malle");
		driver.findElement(By.id("email")).sendKeys(testEmail);
		driver.findElement(By.id("salasõna")).sendKeys(testPassword);
		driver.findElement(By.id("korda-salasõna")).sendKeys(testPassword);
		driver.findElement(By.xpath("//input[@value='Registreeru']")).click();
		assertTrue(isElementPresent(By.xpath("//div[contains(text(), 'Registreerumine õnnestus.')]")));
		login(testEmail, testPassword);
		assertTrue(isElementPresent(By.xpath("//input[@value='VÄLJU']")));
		driver.findElement(By.linkText("Kustuta kasutaja")).click();
		driver.findElement(By.id("salasõna")).sendKeys(testPassword);
		driver.findElement(By.xpath("//input[@value='Kustuta konto']")).click();
		assertTrue(isElementPresent(By.xpath("//div[text()='Kasutaja edukalt kustutatud.']")));
		login(testEmail, testPassword);
		assertTrue(isElementPresent(By.xpath("//input[@value='SISENE']")));
	}

	@Test
	public void reservAndCancelTest() {
		login(mainEmail, mainPassword);
		driver.findElement(By.linkText("BRONEERIMINE")).click();
		LocalDate currentDate = LocalDate.now();
		String currentDateStr = currentDate.getYear() + "-";
		if (currentDate.getMonthValue() < 10) {
			currentDateStr += "0";
		}
		currentDateStr += currentDate.getMonthValue() + "-";
		if (currentDate.getDayOfMonth() < 10) {
			currentDateStr += "0";
		}
		currentDateStr += currentDate.getDayOfMonth();
		String time = "12:00 - 13:00";
		driver.findElement(By.xpath("//table[@class='ui-datepicker-calendar']/tbody/tr/td/a[text()='" + currentDate.getDayOfMonth() + "']")).click();
		Select timeDropdown = new Select(driver.findElement(By.id("kellaaeg")));
		timeDropdown.selectByVisibleText(time);
		Select packageDropdown = new Select(driver.findElement(By.id("pakett")));
		packageDropdown.selectByVisibleText("2");
		driver.findElement(By.xpath("//button[text()='Broneeri']")).click();
		assertTrue(isElementPresent(By.xpath("//div[contains(text(), 'Broneering kinnitatud')]")));
		driver.findElement(By.xpath("//input[@value='PROFIIL']")).click();
		driver.findElement(By.xpath("//td[text()='" + currentDateStr + "']/following-sibling::td[text()='" + time + "']/following-sibling::td/form/input[@value='Tühista']")).click();
		assertTrue(isElementPresent(By.xpath("//div[contains(text(), 'Broneering tühistatud')]")));
		logout();
	}

	// negative tests

	@Test
	public void wrongLoginTest() {
		login(mainEmail, "111111111111111111");
		assertTrue(isElementPresent(By.xpath("//div[contains(text(), 'Vale salasõna')]")));
	}

	@Test
	public void incorrectRegisterTest() {
		driver.findElement(By.xpath("//input[@value='REGISTREERU']")).click();
		driver.findElement(By.id("eesnimi")).sendKeys("Kusti");
		driver.findElement(By.id("perenimi")).sendKeys("Musti");
		driver.findElement(By.id("email")).sendKeys("test2@example.com");
		driver.findElement(By.id("salasõna")).sendKeys("12345678");
		driver.findElement(By.id("korda-salasõna")).sendKeys("87654321");
		driver.findElement(By.xpath("//input[@value='Registreeru']")).click();
		assertTrue(isElementPresent(By.xpath("//div/p[contains(text(), 'Salasõnad ei kattu')]")));
	}

	@Test
	public void incompleteReservTest() {
		login(mainEmail, mainPassword);
		driver.findElement(By.linkText("BRONEERIMINE")).click();
		driver.findElement(By.xpath("//table[@class='ui-datepicker-calendar']/tbody/tr/td/a[text()='" + LocalDate.now().getDayOfMonth() + "']")).click();
		Select timeDropdown = new Select(driver.findElement(By.id("kellaaeg")));
		timeDropdown.selectByVisibleText("15:00 - 16:00");
		driver.findElement(By.xpath("//button[text()='Broneeri']")).click();
		assertTrue(isElementPresent(By.xpath("//div/p[contains(text(), 'Valige sobiv pakett')]")));
		logout();
	}

}
