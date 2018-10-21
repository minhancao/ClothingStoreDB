import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.io.UnsupportedEncodingException;
import java.util.concurrent.ThreadLocalRandom;

/*
    @author Ricky Singh
    Purpose: create text files to populate database with sample data
    Group 6, CS 157A, Fall 2018, San Jose State University
 */
public class createTxtFiles {

    public void storeInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("storeInput.txt", "UTF-8");
        for (int i = 0; i < dataArrayLists.getStores().size(); i++){
            writer.print(dataArrayLists.getStores().get(i) + "\t" + dataArrayLists.getPopularity().get(i));
            writer.println();
        }
        writer.close();

    }

    public void customerInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("customerInput.txt", "UTF-8");
        for (int i = 0; i < dataArrayLists.getCustomers().size(); i++) {
            writer.print(dataArrayLists.getCustomerIDs().get(i) + "\t" + dataArrayLists.getCustomers().get(i) + '\t' + dataArrayLists.getAddress().get(i)
                    + '\t' + dataArrayLists.getEmails().get(i) + '\t' + dataArrayLists.getCardsNo().get(i) + '\t' + "");
            writer.println();
        }
        writer.close();

    }

    public void transactionInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("transactionInput.txt", "UTF-8");
        for (int i = 0; i < dataArrayLists.getTransactions().size(); i++){
            writer.print(dataArrayLists.getTransactions().get(i) + "\t" + dataArrayLists.getTransactionPrices().get(i) + "\t"
                    + '\t' + '\t' + dataArrayLists.getProductIDs().get(i));
            writer.println();
        }
        writer.close();
    }

    public void productInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("productInput.txt", "UTF-8");
        for (int i = 0; i < dataArrayLists.getProductIDs().size(); i++) {
            writer.print(dataArrayLists.getProductIDs().get(i) + "\t" +
                    dataArrayLists.getColors().get(ThreadLocalRandom.current().nextInt(0, 9)) + "\t" + dataArrayLists.getProductPrices().get(i) + '\t'
                    + dataArrayLists.getBrands().get(ThreadLocalRandom.current().nextInt(0, 9)) + '\t'
                    + dataArrayLists.getClothingName().get(i) + '\t' + dataArrayLists.getType().get(i));
            writer.println();
        }
        writer.close();

    }

    public void topInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("topInput.txt", "UTF-8");
        for (int i = 0; i < 10; i++) {
            writer.print(dataArrayLists.getHoodPocketZipper().get(i) + "\t" +
                    dataArrayLists.getTopSizes().get(ThreadLocalRandom.current().nextInt(0, 6)) + '\t' +
                    dataArrayLists.getHoodPocketZipper().get(i) + '\t' + dataArrayLists.getHoodPocketZipper().get(i));
            writer.println();
        }
        writer.close();

    }

    public void bottomInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("bottomInput.txt", "UTF-8");
        for (int i = 0; i < 10; i++) {
            writer.print(dataArrayLists.getWaistSizes().get(ThreadLocalRandom.current().nextInt(0, 18))
                    + "\t" + dataArrayLists.getLengthSizes().get(ThreadLocalRandom.current().nextInt(0, 13)));
            writer.println();
        }
        writer.close();
    }

    public void shoeInput() throws FileNotFoundException, UnsupportedEncodingException {
        PrintWriter writer = new PrintWriter("shoeInput.txt", "UTF-8");
        for (int i = 0; i < 20; i++){
            writer.print(dataArrayLists.getShoeSize().get(i));
            writer.println();
        }
        writer.close();
    }
    

    public static void main(String args[]) throws FileNotFoundException, UnsupportedEncodingException {
        createTxtFiles run = new createTxtFiles();
        run.storeInput();
        run.customerInput();
        run.transactionInput();
        run.productInput();
        run.topInput();
        run.bottomInput();
        run.shoeInput();
    }
}

