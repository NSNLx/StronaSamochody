document.addEventListener("DOMContentLoaded", function() {
    let toggleButton = document.getElementById("toggle-theme");
    const body = document.body;

    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
        toggleButton.textContent = "☀️ Tryb Jasny";
    }

    toggleButton.addEventListener("click", function() {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("theme", "dark");
            toggleButton.textContent = "☀️ Tryb Jasny";
        } 
        else{
            localStorage.setItem("theme", "light");
            toggleButton.textContent = "🌙 Tryb Ciemny";
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const rokSliderMin = document.getElementById("rok-slider-min");
    const rokSliderMax = document.getElementById("rok-slider-max");
    const rokMin = document.getElementById("rok-min");
    const rokMax = document.getElementById("rok-max");

    rokSliderMin.addEventListener("input", function() {
        rokMin.textContent = this.value;
    });
    rokSliderMax.addEventListener("input", function() {
        rokMax.textContent = this.value;
    });
});