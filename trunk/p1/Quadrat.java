package p1;

public class Quadrat {

    /*
     * Diese Funktion berechnet das Quadrat zu einer gegebenen Zahl Sie wurde
     * unter harter Zusammenarbeit von Matthias und Christian erstellt.
     */
    static int quadrat(int n) {
        return n * n;
    }

    /**
     * Main-Methode. Startet das Programm.
     * 
     * @param args Eingabeparameter
     */
    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) 
            System.out.println("Ergebnis: " + quadrat(i));
    }
}
