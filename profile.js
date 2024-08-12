//Javascript file for profile

//code for alowing the user on reclick of an text change link, remove text 
// Get all elements with class "change-text-link"
const textlinks = document.querySelectorAll('.change-text-link');
let currentlyVisibleDivId = null;

// Loop through each text link and add click event listener
textlinks.forEach(function(link) {
  link.addEventListener('click', function(event) {
    // Prevent default link behavior (e.g., jumping to top of page)
    event.preventDefault();
    
    // Get the target ID from the data-target attribute
    const targetId = this.getAttribute('data-target');
    
    // Get the corresponding div element by its ID
    const targetDiv = document.getElementById(targetId);
    
    // Check if the same link is clicked again
    if (targetId === currentlyVisibleDivId) {
      // Hide the div
      targetDiv.style.display = 'none';
      currentlyVisibleDivId = null;
    } else {
      // Hide the currently visible div, if any
      if (currentlyVisibleDivId !== null) {
        const currentlyVisibleDiv = document.getElementById(currentlyVisibleDivId);
        currentlyVisibleDiv.style.display = 'none';
      }
      
      // Show the clicked div
      targetDiv.style.display = 'block';
      currentlyVisibleDivId = targetId;
    }
  });
});