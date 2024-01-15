import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.querySelector("[data-select_skills]");

    selectElement.addEventListener("change", () => {
        skillsAjax(element.value, element.dataset.url);
    });
});

function skillsAjax(value, baseUrl) {
    const queryString = new URLSearchParams({ value }).toString();

    const requestOptions = {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
        // credentials: 'include', // За необхідності додайте опції для роботи з кукі або іншими автентифікаційними даними
    };

    fetch(`${baseUrl}?${queryString}`, requestOptions)
        .then((response) => response.text())
        .then((data) => {
            const container = document.getElementById("skills");
            container.innerHTML = JSON.parse(data).reduce((html, skill) => {
                return (
                    html +
                    `
                <div class="btn row">
                  <label class='form-check-label'>
                    <input 
                      value="${skill.id}" 
                      type="checkbox" 
                      class="form-check-input block" 
                      name="skills[]" 
                    >
                    ${skill.name}
                  </label>
                </div>
              `
                );
            }, "");
        })
        .catch((error) => {
            console.error("Fetch Error:", error);
        });
}
