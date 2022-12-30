var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

function showCheckboxResult() {
    var checkboxes = document.getElementById("checkboxResult");
    if (!expanded) {
      checkboxes.style.display = "block";
      expanded = true;
    } else {
      checkboxes.style.display = "none";
      expanded = false;
    }
}

// function showCheckboxModel() {
//   var checkboxes = document.getElementById("checkboxModel");
//   if (!expanded) {
//     checkboxes.style.display = "block";
//     expanded = true;
//   } else {
//     checkboxes.style.display = "none";
//     expanded = false;
//   }
// }

