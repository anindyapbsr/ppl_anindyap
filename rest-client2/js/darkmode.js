function toggleDarkMode() {
  document.body.classList.toggle("dark-mode");
  const isDarkMode = document.body.classList.contains("dark-mode");
  localStorage.setItem("darkMode", isDarkMode);

  // Update button text
  const darkModeBtn = document.getElementById("darkModeBtn");
  darkModeBtn.innerHTML = isDarkMode
    ? '<i class="fas fa-sun"></i> Light Mode'
    : '<i class="fas fa-moon"></i> Dark Mode';
}

// Check for saved dark mode preference
document.addEventListener("DOMContentLoaded", () => {
  const darkModeBtn = document.getElementById("darkModeBtn");
  const isDarkMode = localStorage.getItem("darkMode") === "true";

  if (isDarkMode) {
    document.body.classList.add("dark-mode");
    darkModeBtn.innerHTML = '<i class="fas fa-sun"></i> Light Mode';
  }
});
