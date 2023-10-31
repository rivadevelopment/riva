<?php



class Apitours_model extends CI_Model {

		function __construct() {

		// Call the Model constructor

		}


//
// List all bookings on account my bookings page
    function get_my_toursbooking($invoice_id,$booking_id) {
    $this->db->select('tours_bookings.booking_id,tours_bookings.booking_user_id,tours_bookings.booking_ref_no');
    $this->db->where('booking_ref_no', $invoice_id);
    $this->db->where('booking_id', $booking_id);
    $query = $this->db->get('tours_bookings');
    $H_booking = $query->row();
    // return $H_booking->booking_id;
   // $this->$result = [];
    if (!empty($H_booking)) {
    $this->load->helper('invoice');
    $this->db->select('*');
    $this->db->where('tours_bookings.booking_id', $H_booking->booking_id);
    $this->db->where('tours_bookings.booking_ref_no', $invoice_id);
    $this->db->join('pt_accounts','tours_bookings.booking_user_id = pt_accounts.accounts_id','left');
    $this->db->order_by('tours_bookings.booking_id', 'desc');
        $query = $this->db->get('tours_bookings')->row();
	return $query;
}

}



}