import com.mycompany.tour.Tour;
import java.util.Date;

public class Booking {
    private String bookingId;
    private String touristName;
    private Tour tour;
    private Date bookingDate;
	public booking m_booking;
	public Tourist m_Tourist;
    public Booking(String bookingId, String touristName, Tour tour, Date bookingDate) {
        this.bookingId = bookingId;
        this.touristName = touristName;
        this.tour = tour;
        this.bookingDate = bookingDate;
    }
    public String getBookingId() {
        return bookingId;
    }
    public void setBookingId(String bookingId) {
        this.bookingId = bookingId;
    }
    public String getTouristName() {
        return touristName;
    }
    public void setTouristName(String touristName) {
        this.touristName = touristName;
    }
    public Tour getTour() {
        return tour;
    }

    public void setTour(Tour tour) {
        this.tour = tour;
    }

    public Date getBookingDate() {
        return bookingDate;
    }

    public void setBookingDate(Date bookingDate) {
        this.bookingDate = bookingDate;
    }
}

/**
 * @author ETHIO-AMA-MELE
 * @version 1.0
 * @updated 19-May-2024 11:10:34 AM
 */
public class booking {

	private date bookingdate;
	private string bookingid;
	private paymentstatus paymentstatus;
	private tour tour;

	public booking(){

	}

	public void finalize() throws Throwable {

	}
}//end booking
