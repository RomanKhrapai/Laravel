import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.querySelector("[data-select_skills]");
    const fileInput = document.getElementById("fileInput");
    const inputImage = document.getElementById("input-image");
    const removeImage = document.getElementById("remove-image");

    if (removeImage) {
        removeImage.addEventListener("click", deleteImageData);
    }

    if (inputImage) {
        const fileInputshow = document.getElementById("fileInputshow");
        if (inputImage.value) {
            fileInputshow.innerHTML = `<img loading="lazy" src="/storage/${inputImage.value}" height="320" width="479"></img> `;
        }
    }

    if (selectElement) {
        selectElement.addEventListener("change", skillsAjax);
    }
    if (fileInput) {
        fileInput.addEventListener("change", customUpLoader);
    }
});

function deleteImageData(e) {
    e.preventDefault();
    const inputImage = document.getElementById("input-image");
    const fileInputshow = document.getElementById("fileInputshow");
    const errorElem = document.getElementById("image-error");

    errorElem.innerHTML = "";
    fileInputshow.innerHTML = `<img loading="lazy" src="" height="320" width="479"></img> `;
    inputImage.value = "";
}

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
            .post(url, formData, {})
            .then(function (response) {
                console.log(response.data.url);
                inputImage.value = response.data.url;
                fileInputshow.innerHTML = `<img loading="lazy" src="/storage/${response.data.url}" height="320" width="479"></img> `;
            })
            .catch(function (error) {
                e.target.classList.add("is-invalid");
                fileInputshow.innerHTML = `<img loading="lazy" src="" height="320" width="479"></img> `;
                errorElem.innerHTML = `<div id=image-error class="alert alert-danger">${error.response.data.message}</div>`;
            });
    }
}

function skillsAjax(e) {
    const baseUrl = e.target.dataset.url;
    const params = new URLSearchParams({
        id: e.target.value,
    }).toString();

    axios
        .get(`${baseUrl}?${params}`, {
            headers: {
                Accept: "application/json",
            },
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
