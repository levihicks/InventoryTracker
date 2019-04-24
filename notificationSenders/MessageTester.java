import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;
import java.sql.*;
import javax.sql.*;

import com.twilio.Twilio;
import com.twilio.rest.api.v2010.account.Message;

public class MessageTester{

  public static void main(String[] args){
    final String ACCOUNT_SID = "AC92a4a20ddcbc2176e86788b3cb2e802a";
     final String AUTH_TOKEN = "635b55d84bf1105275aed5ea636e918b";
     Twilio.init(ACCOUNT_SID, AUTH_TOKEN);
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
            String sql = "SELECT * FROM phoneNumbers";
                	stmt = connection.createStatement();
                	rs = stmt.executeQuery(sql);
                	while(rs.next()){
                        try {
                        Statement stmt2 = connection.createStatement();
                        String sql2 = " select sum(quantity) as total from sales where store = (select store from employs where employee='"+rs.getString("employee")+
                                        "' limit 1) and date(time_of_sale)=(date(now()) - interval 1 day);";
                        ResultSet rs2 = stmt2.executeQuery(sql2);
                        rs2.next();
                        String textMsg = "\nTotal Items Sold (Past 24 hours): "+((rs2.getString("total")!=null)?rs2.getString("total"):"0")+"\n";
                       

                         Statement stmt4 = connection.createStatement();
                        String sql4 = " select sum(quantity) as total from sales where store = (select store from employs where employee='"+rs.getString("employee")+
                                        "' limit 1) and date(time_of_sale)>(date(now()) - interval 7 day);";
                        ResultSet rs4 = stmt2.executeQuery(sql4);
                        rs4.next();
                        textMsg += "Total Items Sold (Past Week): "+((rs4.getString("total")!=null)?rs4.getString("total"):"0")+"\n";

                        Statement stmt5 = connection.createStatement();
                        String sql5 = " select sum(quantity) as total from sales where store = (select store from employs where employee='"+rs.getString("employee")+
                                        "' limit 1) and date(time_of_sale)>(date(now()) - interval 31 day);";
                        ResultSet rs5 = stmt2.executeQuery(sql5);
                        rs5.next();
                        textMsg += "Total Items Sold (Past Month): "+((rs5.getString("total")!=null)?rs5.getString("total"):"0")+"\n";

                        Statement stmt3 = connection.createStatement();
                        String sql3 = "select * from items as s1 natural join (select * from sells where "+
                                  "store = (select store from employs where employee='"+
                                  rs.getString("employee")+"' limit 1) and (on_hand/((select sum(quantity) from sales where "+
                                  "item=upc and time_of_sale>date(now()) - interval 7 day and store = (select store from "+
                                  "employs where employee='"+rs.getString("employee")+"'))/168)<168)) as s2";


                        ResultSet rs3 = stmt3.executeQuery(sql3);
                        textMsg += "The following items are estimated to run out of stock this week and may need to be "+
                                  "replaced soon:\n";
                        int i = 1;
                        while(rs3.next()){
                            String itemName = rs3.getString("name");
                            String upc = rs3.getString("upc");
                            String on_hand = rs3.getString("on_hand");
                            textMsg+=i+". "+itemName + " UPC: " + upc + " ("+on_hand+" left.)\n";
                            i+=1;
                        }
                        if(i==1){
                            textMsg+="None.";
                        }


				Message message = Message.creator(
		            new com.twilio.type.PhoneNumber(rs.getString("phoneNumber")),
             		new com.twilio.type.PhoneNumber("+14064126021"),
             	    textMsg).create();


			}catch(SQLException sqlex){
            sqlex.printStackTrace();
        }


       	 }
        }catch(SQLException sqlex){
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
        System.out.println("Testing text sender...");  

     }
}
