import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.querySelector("[data-select_skills]");
    const fileInput = document.getElementById("fileInput");

    if (selectElement) {
        selectElement.addEventListener("change", skillsAjax);
    }
    if (fileInput) {
    }
    fileInput.addEventListener("change", customUpLoader);
});

function customUpLoader(e) {
    const url = e.target.dataset.url;

    const inputImage = document.getElementById("input-image");
    const fileInputshow = document.getElementById("fileInputshow");
    const errorElem = document.getElementById("image-error");

    e.target.classList.remove("is-invalid");
    errorElem.innerHTML = "";

    if (this.files.length > 0) {
        var formData = new FormData();

        if (this.files[0].size < 2000000) {
            formData.append("file", this.files[0]);
        } else {
            this.value = "";
            formData.append("size", 2000000);
        }

        axios
            .post(url, formData)
            .then(function (response) {
                inputImage.value = response.data.url;
                fileInputshow.innerHTML = `<img loading="lazy" src="/storage/temp/${response.data.url}" height="320" width="479"></img> `;
            })
            .catch(function (error) {
                e.target.classList.add("is-invalid");
                errorElem.innerHTML = `<div id=image-error class="alert alert-danger">${error.response.data.message}</div>`;
            });
    }
}

function skillsAjax(e) {
    const baseUrl = e.target.dataset.url;
    const params = new URLSearchParams({
        value: e.target.dataset.value,
    }).toString();

    axios
        .get(`${baseUrl}?${params}`, {
            headers: {
                "Content-Type": "application/json",
            },
            // withCredentials: true, // Розкоментуйте, якщо потрібно включити обробку кукі або інших автентифікаційних даних
        })
        .then((response) => {
            const container = document.getElementById("skills");
            container.innerHTML = response.data.reduce((html, skill) => {
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
            console.error("Axios Error:", error);
        });
}
