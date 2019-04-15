import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;
import java.sql.*;
import javax.sql.*;

import javax.mail.*;
import javax.mail.internet.*;
import java.util.*;
import java.io.*;


public class EmailTester{
  public static void main(String[] args){

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

    System.out.println("Contacting database...");
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
            String sql = "SELECT * FROM emails";
                	stmt = connection.createStatement();
                	rs = stmt.executeQuery(sql);
                	while(rs.next()){
                		try {
						Statement stmt2 = connection.createStatement();
						String sql2 = "select * from items as s1 natural join (select * from sells where "+
							      "store = (select store from employs where employee='"+
							      rs.getString("employee")+"' limit 1) and on_hand<5) as s2";
						ResultSet rs2 = stmt2.executeQuery(sql2);
						String emailMsg = "The following items are low in stock and need to be "+
								  "replaced soon:\n";
						while(rs2.next()){
							String itemName = rs2.getString("name");
							String upc = rs2.getString("upc");
							String on_hand = rs2.getString("on_hand");
							emailMsg+=itemName + " UPC: " + upc + " ("+on_hand+" left.)\n";
						}
						Message message = new MimeMessage(session);
						message.setFrom(new InternetAddress("from-email@gmail.com"));
						message.setRecipients(Message.RecipientType.TO,
							InternetAddress.parse(rs.getString("email")));
						message.setSubject("Test");
						message.setText(emailMsg);
				
						Transport.send(message);
				
						System.out.println("Done");
				
					} catch (MessagingException e) {
						throw new RuntimeException(e);
					}
                	}
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
        // System.out.println("Testing email sender...");
   		
	
		
   }
 }
