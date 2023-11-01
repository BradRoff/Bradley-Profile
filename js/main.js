/* script.js */
function openNav() {
    document.querySelector(".sidenav").style.width = "220px";
}

function closeNav() {
    document.querySelector(".sidenav").style.width = "0";
}

function SwitchButtons(buttonId) {
    var hideBtn, showBtn;
    
    if (buttonId == 'moonEBtn') {
      menuToggle = 'moonEBtn';
      showBtn = 'sunBtn';
      hideBtn = 'moonEBtn';
      document.body.style.backgroundColor = "#A9A9A9";
    } else if  (buttonId == 'sunBtn'){
      menuToggle = 'sunBtn';
      showBtn = 'moonFBtn';
      hideBtn = 'sunBtn';
      document.body.style.backgroundColor =  "#B3D9D9";
      
    }
    else if  (buttonId == 'moonFBtn'){
      menuToggle = 'moonFBtn';
      showBtn = 'moonEBtn'; 
      hideBtn = 'moonFBtn';
      document.body.style.backgroundColor = "#25383C";

    }
    
    
    //I don't have your menus, so this is commented out.  just uncomment for your usage
    // document.getElementById(menuToggle).toggle(); //step 1: toggle menu
    document.getElementById(hideBtn).style.display = 'none'; //step 2 :additional feature hide button
    document.getElementById(showBtn).style.display = ''; //step 3:additional feature show button
   
  }
 