import java.math.BigDecimal;
import java.math.RoundingMode;
import java.util.ArrayList;
import java.util.Random;
import java.util.concurrent.ThreadLocalRandom;

/*
    @author Ricky Singh
    Purpose: prepare array lists for txt file creation
    Group 6, CS 157A, Fall 2018, San Jose State University
 */
public class dataArrayLists {

    public static ArrayList<String> stores;
    public static ArrayList<Double> popularity;
    public static ArrayList<String> customers;
    public static ArrayList<Integer> customerIDs;
    public static ArrayList<String> address;
    public static ArrayList<String> emails;
    public static ArrayList<Long> cardsNo;
    public static ArrayList<Double> transPrices;
    public static ArrayList<Integer> transactions;
    public static ArrayList<Integer> productIDs;
    public static ArrayList<String> brands;
    public static ArrayList<String> colors;
    public static ArrayList<Double> productPrices;
    public static ArrayList<String> topSizes;
    public static ArrayList<Integer> shoeSize;
    public static ArrayList<Integer> lengthSizes;
    public static ArrayList<Integer> waistSizes;
    public static ArrayList<Integer> hoodPocketZipper;
    public static ArrayList<String> clothingName;
    public static ArrayList<String> type;

    private static double round(double value, int places) {
        if (places < 0) throw new IllegalArgumentException();

        BigDecimal bd = new BigDecimal(value);
        bd = bd.setScale(places, RoundingMode.HALF_UP);
        return bd.doubleValue();
    }

    private static String getSaltString() {
        String SALTCHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        StringBuilder salt = new StringBuilder();
        Random rnd = new Random();
        while (salt.length() < 10) { // length of the random string.
            int index = (int) (rnd.nextFloat() * SALTCHARS.length());
            salt.append(SALTCHARS.charAt(index));
        }
        String saltStr = salt.toString();
        return saltStr;

    }

    public static ArrayList<String> getStores() {
        stores = new ArrayList<String>();
        stores.add("Kohl's");
        stores.add("Macy's");
        stores.add("H&M");
        stores.add("Forever 21");
        stores.add("Spencer's");
        stores.add("Express");
        stores.add("Urban Outfitters");
        stores.add("Uniqlo");
        stores.add("Old Navy");
        stores.add("JC Penny");
        return stores;
    }

    public static ArrayList<Double> getPopularity() {
        popularity = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            double k = round(ThreadLocalRandom.current().nextDouble(1,5), 2);
            popularity.add(k);
        }
        return popularity;
    }

    public static ArrayList<String> getCustomers() {
        customers = new ArrayList<String>();
        customers.add("John R");
        customers.add("James S");
        customers.add("Mary K");
        customers.add("Ricky S");
        customers.add("Alex N");
        customers.add("Minh A");
        customers.add("Sarah O");
        customers.add("Peter T");
        customers.add("Sam R");
        customers.add("Kate Y");
        return customers;
    }

    public static ArrayList<Integer> getCustomerIDs() {
        customerIDs = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            int k = ThreadLocalRandom.current().nextInt(100000,999999);
            customerIDs.add(k);
        }
        return customerIDs;
    }

    public static ArrayList<String> getAddress() {
        address = new ArrayList<String>();
        address.add("132 Ranch St");
        address.add("156 New Dr");
        address.add("44 Old Ave");
        address.add("234 11 St");
        address.add("56 3rd St");
        address.add("789 Bird Ave");
        address.add("45 Oak St");
        address.add("747 Wind Rd");
        address.add("786 Ezie St");
        address.add("4464 Ayers Rd");
        return address;
    }

    public static ArrayList<String> getEmails() {
        emails = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            emails.add(getSaltString()+"@gmail.com");
        }
        return emails;
    }

    public static ArrayList<Long> getCardsNo() {
        cardsNo = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            long jr = (long) (Math.random() * 10000000000000000L + 1);
            cardsNo.add(jr);
        }
        return cardsNo;
    }

    public static ArrayList<Double> getTransactionPrices() {
        transPrices = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            double priceTest = round(ThreadLocalRandom.current().nextDouble(100,10000), 2);
            transPrices.add(priceTest);
        }
        return transPrices;
    }

    public static ArrayList<Integer> getTransactions() {
        transactions = new ArrayList<>();
        for (int i = 0; i <10; i++){
            int transID = ThreadLocalRandom.current().nextInt(100000,999999);
            transactions.add(transID);
        }
        return transactions;
    }

    public static ArrayList<Integer> getProductIDs() {
        productIDs = new ArrayList<>();
        for (int i = 0; i < 30; i++){
            int id = ThreadLocalRandom.current().nextInt(100000,999999);
            productIDs.add(id);
        }
        return productIDs;
    }

    public static ArrayList<String> getBrands() {
        brands = new ArrayList<>();
        brands.add("Nike");
        brands.add("Adidas");
        brands.add("Gucci");
        brands.add("Givenchy");
        brands.add("Balenciaga");
        brands.add("Fendi");
        brands.add("Ralph Lauren");
        brands.add("Louis Vuitton");
        brands.add("Off White");
        brands.add("YSL");
        return brands;
    }

    public static ArrayList<String> getColors() {
        colors = new ArrayList<>();
        colors.add("white");
        colors.add("black");
        colors.add("red");
        colors.add("blue");
        colors.add("green");
        colors.add("orange");
        colors.add("yellow");
        colors.add("pink");
        colors.add("grey");
        colors.add("brown");
        return colors;
    }

    public static ArrayList<Double> getProductPrices() {
        productPrices = new ArrayList<>();
        for (int i = 0; i < 40; i++){
            double priceTest = round(ThreadLocalRandom.current().nextDouble(50,500), 2);
            productPrices.add(priceTest);
        }
        return productPrices;
    }

    public static ArrayList<String> getTopSizes() {
        topSizes = new ArrayList<>();
        topSizes.add("XS");
        topSizes.add("S");
        topSizes.add("M");
        topSizes.add("L");
        topSizes.add("XL");
        topSizes.add("XXL");
        topSizes.add("XXXL");
        return topSizes;
    }

    public static ArrayList<Integer> getShoeSize() {
        shoeSize = new ArrayList<>();
        for (int i = 6; i < 16; i++){
            shoeSize.add(i);
        }
        return shoeSize;
    }

    public static ArrayList<Integer> getLengthSizes() {
        lengthSizes = new ArrayList<>();
        for (int i = 28; i < 41; i++){
            lengthSizes.add(i);
        }
        return lengthSizes;
    }

    public static ArrayList<Integer> getWaistSizes() {
        waistSizes = new ArrayList<>();
        for (int i = 28; i < 46; i++){
            waistSizes.add(i);
        }
        return waistSizes;
    }

    public static ArrayList<Integer> getHoodPocketZipper() {
        hoodPocketZipper = new ArrayList<>();
        for (int i = 0; i <10; i++){
            int k = ThreadLocalRandom.current().nextInt(0,2);
            hoodPocketZipper.add(k);
        }
        return hoodPocketZipper;
    }

    public static ArrayList<String> getClothingName() {
        clothingName = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            clothingName.add("top" + Integer.toString(i+1));
        }
        for (int i = 0; i < 10; i++){
            clothingName.add("bottom" + Integer.toString(i+1));
        }
        for (int i = 0; i < 10; i++){
            clothingName.add("shoe" + Integer.toString(i+1));
        }
        return clothingName;
    }

    public static ArrayList<String> getType() {
        type = new ArrayList<>();
        for (int i = 0; i < 10; i++){
            type.add("top");
        }
        for (int i = 0; i < 10; i++){
            type.add("bottom");
        }
        for (int i = 0; i < 10; i++){
            type.add("shoe");
        }
        return type;
    }
}
