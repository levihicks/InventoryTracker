import com.twilio.Twilio;
import com.twilio.rest.api.v2010.account.Message;

public class MessageConfirmSend{
  public static void main(String[] args){
 	 final String ACCOUNT_SID = "AC92a4a20ddcbc2176e86788b3cb2e802a";
     final String AUTH_TOKEN = "635b55d84bf1105275aed5ea636e918b";
     Twilio.init(ACCOUNT_SID, AUTH_TOKEN); 	
     String textMsg = "You will now receive daily inventory reports from Inventory Tracker via text message.";
  	 Message message = Message.creator(
    	new com.twilio.type.PhoneNumber(args[0]),
		new com.twilio.type.PhoneNumber("+14064126021"),
	    textMsg).create();
  	}
}