let menu=document.querySelector('.hamMenu');
let hiddenContent=document.querySelector('.offScreenMenu');

//humberger menu function 
function displayMenu(){
if(hiddenContent.style.display=='block'){
    hiddenContent.style.display='none';
}else{
    hiddenContent.style.display='block';
}
}
//humburger menu event listener
menu.addEventListener('click',displayMenu);