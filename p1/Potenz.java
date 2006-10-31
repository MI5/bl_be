package p1;

public class Potenz extends Quadrat
{

  /**
   * Berechnet a^x.
   * @param a Basis
   * @param x Exponent
   * @return Ergebnis
   */
  public int potenz(int a, int x)
  {
	int ergebnis = 1;
	for (int i = 0; i < x; i++) {
	  ergebnis *= a;
	}
	return ergebnis;
  }

  public static void main(String[] args)
  {
	Potenz pot = new Potenz();
	System.out.println(pot.potenz(4, 3));

  }

}
