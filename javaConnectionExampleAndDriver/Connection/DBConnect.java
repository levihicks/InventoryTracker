package Connection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;

public class DBConnect{
	
	public static void main(String[] args){
		String host = "jdbc:postgresql://3.16.210.106:5432/inventory";
		String user = "akstraw";
		String pass = "abcde";
		try{
			//connection
			Connection conn = DriverManager.getConnection(host, user, pass);
			//example query
	                String sql = "SELECT * FROM employees WHERE name = 'Bob Walton'";
        	        Statement stmt = conn.createStatement();
       		        ResultSet rs = stmt.executeQuery(sql);
			rs.next();
               		System.out.println(rs.getString("name"));

		}
		catch (SQLException err){
			System.out.println( err.getMessage() );
		}	
	}


}
