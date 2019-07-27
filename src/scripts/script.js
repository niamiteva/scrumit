//side nav
var acc = document.getElementsByClassName("accordion");
var i;

//block the pop up asking for form resubmission on refresh once the form is submitted
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

//board tab menu
function openTab(evt, tabName, btnid) {
  // Declare all variables
  var i, tabcontent, tablinks;
  var tabbtnid = document.getElementById(btnid);
  tablinks = document.getElementsByClassName("board-btn");
  // Get all elements with class="content" and hide them
  tabcontent = document.getElementsByClassName("content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.background = "#ccc";
  }

  // Get all elements with class="board-btn" and remove the class "active"
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    tablinks[i].style.background = "#ccc";
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
  tabbtnid.style.background = "#D93654";
}
document.getElementById("bl").click();

///drag and drop
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}

///forms
// Get the modal
// var addProject = document.getElementById('addProject');
// var addTask = document.getElementById('addTask');

// window.onclick = function(event) {
//     if (event.target == addProject) {
//         this.closeModal(addProject);
//     }
//     if (event.target == addTask) {
//       this.closeModal(addTask);
//     }
// }
function openModal(modal) {
    modal.style.display = "block";
}
function closeModal(modal) {
    modal.style.display = "none";
}

function submitThis(act, value){
  document.getElementById(act).value = value;
}

function editTask(){
  document.getElementById('act').value = "editTask";
  this.form.submit();
}