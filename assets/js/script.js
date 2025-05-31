document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("gift_message");
  const count = document.getElementById("char-count");

  if (input && count) {
    input.addEventListener("input", function () {
      const remaining = 150 - input.value.length;
      count.textContent = `${remaining} characters remaining`;
    });
  }
});
