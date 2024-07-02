
/* SIDEBAR JS */    

window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".bx-search")

    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    searchBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
        }
    }
}
/* VIEW PROFILE MODAL JS */

const modalBtns = document.getElementsByClassName('myBtn');
const modals = document.getElementsByClassName('modal');
const closeBtns = document.querySelectorAll('.close');

for (let i = 0; i < modalBtns.length; i++) {
  modalBtns[i].addEventListener("click", function() {
    openModal(i);
  });
  closeBtns[i].addEventListener("click", function() {
    closeModal(i);
  });
}

function openModal(index) {
  modals[index].style.display = "block";
}

function closeModal(index) {
  modals[index].style.display = "none";
}


/* ADD FLOAT FORM JS */
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
/* ALERT MESSAGE MODAL JS */
function openAlert() {
  document.getElementById("add-container").style.display = "block";
  document.getElementById("myForm").style.display = "none";
}

