function myFunction() {
    
    var x = document.getElementById("myTopnav");
    
    if (x.className === "topnav") {
      x.className += " responsive";
      
    } else {
      x.className = "topnav";
    }
  } 

 

  $(document).ready(function(){ 
    console.log('hello'); 
   var one=document.getElementById('one'); 
   var two=document.getElementById('two'); 
   var three=document.getElementById('three'); 
   var reg = document.getElementById('reg');
   var upl = document.getElementById('upl');
   var warn = document.getElementById('warn');
   document.getElementById('reg').onclick= function(){ 
     console.log('reg clicked'); 
     two.classList.remove('instructions_active'); 
     three.classList.remove('instructions_active'); 
     one.classList.add('instructions_active'); 
     reg.classList.add('instructions_nav_active'); 
     upl.classList.remove('instructions_nav_active'); 
     warn.classList.remove('instructions_nav_active'); 
   } 

   document.getElementById('upl').onclick= function(){ 
    one.classList.remove('instructions_active'); 
    three.classList.remove('instructions_active'); 
    two.classList.add('instructions_active'); 
    upl.classList.add('instructions_nav_active'); 
    reg.classList.remove('instructions_nav_active'); 
    warn.classList.remove('instructions_nav_active'); 
    console.log('upl clicked');
  } 

  document.getElementById('warn').onclick= function(){ 
    one.classList.remove('instructions_active'); 
    two.classList.remove('instructions_active'); 
    three.classList.add('instructions_active'); 
    warn.classList.add('instructions_nav_active'); 
    reg.classList.remove('instructions_nav_active'); 
    upl.classList.remove('instructions_nav_active'); 
    console.log('upl clicked');
  } 
      

  })