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


//schedule and rulesscript
document.addEventListener("DOMContentLoaded",function(){
    const schedule = document.getElementById("schedTbl");
    const addSched = document.getElementById("addSchedBtn");
    const editSched = document.getElementById("editSchedBtn");
    const modalSched = document.getElementById("addSchedModal");
    const closeSched = document.querySelector(".closeS");
    const insertSched = document.getElementById("insertSched");

    var scheduleData = [
        ["7:00am - 7:10am", "Arrival Time"],
        ["7:10am - 7:20am", "Meeting Time 1"],
        ["7:20am - 8:05am", "Work Period 1"],
        ["8:05am - 8:15am", "Meeting Time 2"],
        ["8:15am - 8:30am", "Recess"],
        ["8:30am - 8:40am", "Quiet Time"],
        ["8:40am - 8:55am", "Stories / Rhymes / Poem / Song"],
        ["8:55am - 9:35am", "Work Period 2"],
        ["9:35am - 9:55am", "Indoor / Outdoor Activity"],
        ["9:55am - 10:00am", "Meeting Time 3 / Dismissal Time"]
    ];
    
    function loadSchedule(){
        for (var i = 0; i < scheduleData.length; i++) {
                var row = schedule.insertRow(-1);
    
                for (var j = 0; j < scheduleData[i].length; j++) {
                    var cell = row.insertCell(j);
                    cell.innerHTML = scheduleData[i][j];
                }
            };
    };

    addSched.addEventListener("click", function(){
        openSchModal();
    });
    // Function to open the modal
    function openSchModal() {
        modalSched.style.display = "block";
    }
    // Function to close the modal
    closeSched.onclick = function () {
        modalSched.style.display = "none";
    };

    // Function to insert a new row into the schedule table
    insertSched.addEventListener("click",function(){
        var newTime = document.getElementById("newTime");
        var newBlock = document.getElementById("newBlock");
        var newSched = [newTime.value,newBlock.value];
        
        scheduleData.push(newSched);
        
        while(schedule.rows.length>1){
            schedule.deleteRow(1);
        }
        loadSchedule();
        modalSched.style.display = "none";
        newTime.value = "";
        newBlock.value = "";
    })
    loadSchedule();
});