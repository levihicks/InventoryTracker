import com.twilio.Twilio;
import com.twilio.rest.api.v2010.account.Message;
import javax.mail.*;
import javax.mail.internet.*;
import java.util.*;
import java.io.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;
import java.sql.*;
import javax.sql.*;


public class Tester{

  public static void main(String[] args){
    System.out.println("Testing database...");
    // variables
        Connection connection = null;
        Statement stmt = null;
        ResultSet rs = null;
 
        // Step 1: Loading or 
        // registering MySQL JDBC driver class
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch(ClassNotFoundException cnfex) {
            System.out.println("Problem in"
                    + " loading MySQL JDBC driver");
            cnfex.printStackTrace();
        }
        
        // Step 2: Opening database connection
        try {
            // Step 2.A: Create and 
            // get connection using DriverManager class
            connection = DriverManager.getConnection(
                    "jdbc:mysql://3.16.210.106:3306/Inventory",
                    "akstraw", 
                    "abcde"); 
            // Step 2.B: Creating JDBC Statement 
            stmt = connection.createStatement();
 
            // Step 2.C: Executing SQL and 
            // retrieve data into ResultSet
            String sql = "SELECT * FROM employees WHERE name = 'Bob Walton'";
                	stmt = connection.createStatement();
                	rs = stmt.executeQuery(sql);
                	rs.next();
                	System.out.println(rs.getString("name"));
        }
        catch(SQLException sqlex){
            sqlex.printStackTrace();
        }
        finally {
            // Step 3: Closing database connection
            try {
                if(null != connection) {
                    // cleanup resources, once after processing
                    rs.close();
                    stmt.close();
 
                    // and then finally close connection
                    connection.close();
                }
            }
            catch (SQLException sqlex) {
                sqlex.printStackTrace();
            }
        }
    System.out.println("Testing email sender...");
    final String username = "inventorytracker2019@gmail.com";
		final String password = "javadev1";
	
		Properties props = new Properties();
		props.put("mail.smtp.auth", "true");
		props.put("mail.smtp.starttls.enable", "true");
		props.put("mail.smtp.host", "smtp.gmail.com");
		props.put("mail.smtp.port", "587");
	
		Session session = Session.getInstance(props,
		  new javax.mail.Authenticator() {
			protected PasswordAuthentication getPasswordAuthentication() {
				return new PasswordAuthentication(username, password);
			}
		  });
	
		try {
	
			Message message = new MimeMessage(session);
			message.setFrom(new InternetAddress("from-email@gmail.com"));
			message.setRecipients(Message.RecipientType.TO,
				InternetAddress.parse("lv.hicks@gmail.com"));
			message.setSubject("Test");
			message.setText("test");
	
			Transport.send(message);
	
			System.out.println("Done");
	
		} catch (MessagingException e) {
			throw new RuntimeException(e);
		}
    System.out.println("Testing text sender...");  
     final String ACCOUNT_SID = "AC92a4a20ddcbc2176e86788b3cb2e802a";
     final String AUTH_TOKEN = "635b55d84bf1105275aed5ea636e918b";
     Twilio.init(ACCOUNT_SID, AUTH_TOKEN);
     Message message = Message.creator(
             new com.twilio.type.PhoneNumber("+18702192721"),
             new com.twilio.type.PhoneNumber("+14064126021"),
             "Test Message")
         .create();

     System.out.println(message.getSid());
  }
}