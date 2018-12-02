import java.sql.*;
import java.util.Scanner;



public class laptopSearch {

    public static void main(String[] args){
        Scanner scanner = new Scanner(System.in);
        System.out.print("Minimum Speed: ");
        Double speed = scanner.nextDouble();
        System.out.print("Minimum RAM: ");
        Double ram = scanner.nextDouble();
        System.out.print("Minimum HD size: ");
        Double hd = scanner.nextDouble();
        System.out.print("Minimum Screen size: ");
        Double screen = scanner.nextDouble();

        Connection con = null;
        PreparedStatement statement = null;
        ResultSet rs = null;

        try {
            con = DriverManager.getConnection("jdbc:mysql://localhost/3306/store" + "user=root&password=password");
            statement = con.prepareStatement("SELECT * FROM laptop, product WHERE speed >= ? AND ram >= ? AND hd >= ? AND screen >= ? AND laptop.model=product.model");
            statement.setDouble(1,speed);
            statement.setDouble(2,ram);
            statement.setDouble(3,hd);
            statement.setDouble(4,screen);
            rs = statement.executeQuery();
            ResultSetMetaData rsmd = rs.getMetaData();
            int columns = rsmd.getColumnCount();
            while (rs.next()){
                for (int i = 1; i < columns; i++){
                    System.out.println(rs.getString(i) + "\t");
                }
                System.out.println();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }


    }
}
