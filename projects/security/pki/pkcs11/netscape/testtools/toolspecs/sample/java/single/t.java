package TestTools.Replacer;

class Test {
  /* below lies the injected datatables */

  public static int testId = 0;

public static int[] ROW = {
	0,
	1,
	2,
	3,
	4
};

public static int[] COL = {
	0,
	1,
	2,
	3,
	4
};

public static String[] STRING = {
	"Dave Barry",
	"Robert Fulghum"
};




    
  /* following array is part of 
     template */

public static int myMatrix[][] = {
  { 0, 0, 0, 0, 0 },
  { 1, 0, 0, 0, 0 },
  { 1, 2, 0, 0, 0 },
  { 1, 2, 3, 0, 0 },
  { 51, 2, 3, 4, 0 } };
  

public static void main(String argv[]) {
    
  Test.testId = Integer.parseInt(argv[0]);;
  
  System.out.println("User is " + Test.STRING[Test.testId/5/5%2]);
  System.out.print("is now accessing Matrix element Row: ");
  System.out.print(Test.ROW[Test.testId%5]);
  System.out.print(" Col: ");
  System.out.println(Test.COL[Test.testId/5%5]);
  
  int exitValue = myMatrix[ Test.ROW[Test.testId%5] ][ Test.COL[Test.testId/5%5] ];
  System.out.println("The exit value is: " + exitValue);	
  System.exit( exitValue );



}

}
