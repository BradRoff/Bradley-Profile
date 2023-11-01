/* script.js */

function openNav() {
    document.querySelector(".sidenav").style.width = "220px";
}

function closeNav() {
    document.querySelector(".sidenav").style.width = "0";
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
            // Code to run when the image is clicked
            $(this).hide();
            $("#bright").show();
            document.body.style.backgroundColor = "#A9A9A9";
            
            var svg = $(".icon");
            var path = svg.find("path");
            path.attr("fill", "black");
            document.body.style.color="black";
        });
        $("#bright").click(function() {
            // Code to run when the image is clicked
            $(this).hide();
            $("#dark").show();
            document.body.style.backgroundColor =  "#ADD8E6"
          
        });
        $("#dark").click(function() {
            // Code to run when the image is clicked
            $(this).hide();
            $("#normal").show();
            document.body.style.backgroundColor = "#161618";
            document.body.style.color="red";
            var svg = $(".icon");
            var path = svg.find("path");
            path.attr("fill", "red");
        });
    });
    
