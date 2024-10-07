const marksAssign = document.querySelector(".marksAssign");
const SelectCourse = document.querySelector("#SelectCourse");
const SelectTerm = document.querySelector("#SelectTerm");
const SubmitBtn = document.querySelector(".SubmitBtn");
const COS = document.querySelectorAll(".COS");
const btnCheck = document.querySelectorAll(".btn-check");
const inputElem = document.querySelectorAll(".inputElem");
SubmitBtn.addEventListener("click", () => {
    if (SelectCourse.value !== "NAN" && SelectTerm.value !== "NAN") {
        // If the condition is true, show the marksAssign element
        marksAssign.classList.remove("d-none")
    }
});

  // Get all checkboxes and input fields
  const checkboxes = document.querySelectorAll('.btn-check');
  const inputFields = document.querySelectorAll('.inputElem');

  // Add event listener to each checkbox
  checkboxes.forEach((checkbox, index) => {
      checkbox.addEventListener('change', () => {
          // Enable/disable the corresponding input field based on the checkbox state
          inputFields[index].disabled = !checkbox.checked;
      });
  });