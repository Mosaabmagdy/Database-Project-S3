// Form Validation for Car Booking
document.addEventListener("DOMContentLoaded", () => {
    const bookingForms = document.querySelectorAll(".car-card form");
  
    bookingForms.forEach((form) => {
      form.addEventListener("submit", (event) => {
        event.preventDefault();
  
        const nameInput = form.querySelector('input[name="name"]');
        const emailInput = form.querySelector('input[name="email"]');
  
        if (!nameInput.value.trim() || !emailInput.value.trim()) {
          alert("Please fill in all fields.");
          return;
        }
  
        if (!validateEmail(emailInput.value)) {
          alert("Please enter a valid email address.");
          return;
        }
  
        alert(`Thank you, ${nameInput.value}! Your booking request has been submitted.`);
        form.reset();
      });
    });
  
    // Date Filtering in the Admin Dashboard
    const filterForm = document.querySelector("#filter-form");
    const reservationTable = document.querySelector("#reservation-table tbody");
  
    if (filterForm) {
      filterForm.addEventListener("submit", (event) => {
        event.preventDefault();
  
        const startDate = new Date(filterForm.querySelector('input[name="rent-start-date"]').value);
        const endDate = new Date(filterForm.querySelector('input[name="rent-end-date"]').value);
  
        const rows = reservationTable.querySelectorAll("tr");
  
        rows.forEach((row) => {
          const reservationDate = new Date(row.dataset.date);
  
          if (reservationDate >= startDate && reservationDate <= endDate) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        });
      });
    }
  });
  
  // Email Validation Helper
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  // Delete Reservation Confirmation
  document.querySelectorAll(".delete-btn").forEach((button) => {
    button.addEventListener("click", (event) => {
      const confirmation = confirm("Are you sure you want to delete this reservation?");
      if (!confirmation) {
        event.preventDefault();
      }
    });
  });
  