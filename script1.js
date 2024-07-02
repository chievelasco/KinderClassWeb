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


const calcmodal = document.getElementsByClassName('calcmodal');
const calcmodalBtn = document.getElementsByClassName('calcBtn');
const calccloseBtn = document.querySelectorAll('.close-calc');


for (let i = 0; i < calcmodalBtn.length; i++) {
  calcmodalBtn[i].addEventListener("click", function() {
    openGrad(i);
  });
  calccloseBtn[i].addEventListener("click", function() {
    closeGrad(i);
  });
}
function openGrad(index) {
  calcmodal[index].style.display = "block";
}

function closeGrad(index) {
  calcmodal[index].style.display = "none";
}

/* PROGRESS BAR JS */   
const progressButtons = document.querySelectorAll(".progress-btn");
const inputScores = document.querySelectorAll(".inputScore");
const inputItems = document.querySelectorAll(".inputItem");
const progressRates = document.querySelectorAll(".progress-rate");

function updateProgress(index) {
  const scores = parseInt(inputScores[index].value, 10);
  const items = parseInt(inputItems[index].value, 10);

  if (isNaN(scores) || isNaN(items) || items === 0) {
      progressRates[index].style.width = '0%';
      progressRates[index].innerText = '0%';
  } else {
      const widthPercentage = (scores / items) * 100;
      progressRates[index].style.width = widthPercentage + '%';
      progressRates[index].innerText = Math.ceil(widthPercentage) + '%';
  }
}
// Attach click event handlers to the "Calculate" buttons
progressButtons.forEach((btn, index) => {
  btn.addEventListener("click", function () {
      updateProgress(index);
  });
});
