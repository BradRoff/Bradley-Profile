//         Bootstrap JS and dependencies 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

      function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
/*
var MenuChoice ="";
function SwitchButtons(buttonId) {
    var hideBtn;   showBtn;
    
    if (buttonId == 'moonEBtn') {
        MenuChoice ="Norm"
      showBtn = 'sunBtn';
      hideBtn = 'moonEBtn';
      
      document.body.style.backgroundColor = "#A9A9A9";
      // Calling the jquery function with Javscript function
     
    } else if  (buttonId == 'sunBtn'){
        MenuChoice ="Bright"
      showBtn = 'moonFBtn';
      hideBtn = 'sunBtn';
      
      document.body.style.backgroundColor =  "#B3D9D9";
      
    }
    else if  (buttonId == 'moonFBtn'){
        MenuChoice ="Dark"
      showBtn = 'moonEBtn'; 
      hideBtn = 'moonFBtn';
      document.body.style.backgroundColor = "#25383C";

    }
    
    $.jQueryChange(MenuChoice);
    //I don't have your menus, so this is commented out.  just uncomment for your usage
    // document.getElementById(menuToggle).toggle(); //step 1: toggle menu
    document.getElementById(hideBtn).style.display = 'none'; //step 2 :additional feature hide button
    document.getElementById(showBtn).style.display = ''; //step 3:additional feature show button
   
  }
*/
$(document).ready(function() {
    $("#normal").click(function() {
        $(this).hide();
        $("#bright").show();
        document.body.style.backgroundColor = "#A9A9A9";
        
        var svg = $(".icon");
        var path = svg.find("path");
        path.attr("fill", "black");
        
        document.body.style.color = "black";
        $("span").css("color", "red"); // Change color of all span elements to black
    });
    
    $("#bright").click(function() {
        $(this).hide();
        $("#dark").show();
        document.body.style.backgroundColor = "#ADD8E6";
        
        // Reset span elements color to default or any other color
        $("span").css("color", ""); // Empty string resets to default or inherit
    });
    
    $("#dark").click(function() {
        $(this).hide();
        $("#normal").show();
        document.body.style.backgroundColor = "#161618";
        document.body.style.color = "red";
        
        $("span").css("color", "green"); // Change color of all span elements in dark mode to green
        
        var svg = $(".icon");
        var path = svg.find("path");
        path.attr("fill", "red");
    });
});
    
    $(document).ready(function() {
        // Get references to the HTML elements
        const textContainer = $("#text-container");
        const changeTextLinks = $(".change-text-link");
        const spanContainer = $("#span-container")
        // Add a click event listener to the links
        changeTextLinks.on("click", function(event) {
            event.preventDefault(); // Prevent the link from navigating
    
            // Get the new text from the data attribute of the clicked link
            const newHeaderText = $(this).data("new-text");
            const newSpanText= $(this).data("new-span");
            // Change the text in the container to the new text
            textContainer.text(newHeaderText);
            spanContainer.text(newSpanText);
        });
    });

// Define two sets of text links and their corresponding content IDs
const textlinks1 = document.querySelectorAll('.change-text-link-set1');
const textlinks2 = document.querySelectorAll('.change-text-link-set2');
let currentlyVisibleDivId1 = null;
let currentlyVisibleDivId2 = null;

// Function to handle click events for each set of text links
function handleTextLinks(links, currentDivIdVar) {
  // Loop through each text link and add click event listener
  links.forEach(function(link) {
    link.addEventListener('mouseover', function(event) {
      // Prevent default link behavior (e.g., jumping to top of page)
      event.preventDefault();
      
      // Get the target ID from the data-target attribute
      const targetId = this.getAttribute('data-target');
      
      // Get the corresponding div element by its ID
      const targetDiv = document.getElementById(targetId);
      
      // Check if hovered again
      if (targetId === currentDivIdVar) {
        // Hide the div
        targetDiv.style.display = 'none';
        currentDivIdVar = null;
      } else {
        // Hide the currently visible div, if any
        if (currentDivIdVar !== null) {
          const currentlyVisibleDiv = document.getElementById(currentDivIdVar);
          currentlyVisibleDiv.style.display = 'none';
        }
        
        // Show the hovered div
        targetDiv.style.display = 'block';
        currentDivIdVar = targetId;
      }
    });
  });
}

document.addEventListener("DOMContentLoaded", function() {
    // Wait for DOM content to be fully loaded before running JavaScript

    // Function to hide divs with class 'change-text-source2'
    function hideDivsWithClass(className) {
        var elements = document.getElementsByClassName(className);
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }

    // Add event listener to all elements with class 'hide-link'
    var links = document.getElementsByClassName('change-text-link-set1');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('mouseover', function() {
            hideDivsWithClass('change-text-source2');
        });
    }
});
// Call the function for each set of text links

handleTextLinks(textlinks2, currentlyVisibleDivId2);
handleTextLinks(textlinks1, currentlyVisibleDivId1);
