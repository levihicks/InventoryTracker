import javax.mail.*;
import javax.mail.internet.*;
import java.util.*;
import java.io.*;

public class EmailConfirmSend{
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
		String emailMsg = "You will now receive daily inventory reports from Inventory Tracker via e-mail.";
		try{
		 Message message = new MimeMessage(session);
			message.setFrom(new InternetAddress("from-email@gmail.com"));
			message.setRecipients(Message.RecipientType.TO,
				InternetAddress.parse(args[0]));
			message.setSubject("Confirmation");
			message.setText(emailMsg);

			Transport.send(message);

			System.out.println("Done");

		} catch (MessagingException e) {
			throw new RuntimeException(e);
		}
	}
}