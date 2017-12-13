function dropDownProfile() {
    document.getElementById("dropProfile").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.drop')) {

    var dropdowns = document.getElementsByClassName("dropdownProfile-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function dropDownAdd() {
    document.getElementById("dropAdd").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropAdd')) {

    var dropdowns = document.getElementsByClassName("dropdown-contentAdd");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function dropDownSearch() {
    document.getElementById("dropSearch").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropSearch')) {

    var dropdowns = document.getElementsByClassName("dropdown-contentSearch");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function dropDownSearcmjyuh() {
    document.getElementById("dropSearchgmg").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropSearchjhjh')) {

    var dropdowns = document.getElementsByClassName("dropdown-contentSearchytyt");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}