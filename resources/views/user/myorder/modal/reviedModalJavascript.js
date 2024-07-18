const dropzone = document.getElementById("dropzone");
const fileInput = document.getElementById("fileInput");

dropzone.addEventListener("click", () => fileInput.click());

dropzone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropzone.classList.add("border-blue-500");
});

dropzone.addEventListener("dragleave", () => {
    dropzone.classList.remove("border-blue-500");
});

dropzone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropzone.classList.remove("border-blue-500");
    const files = e.dataTransfer.files;
    fileInput.files = files;
    handleFiles(files);
});

fileInput.addEventListener("change", (e) => {
    handleFiles(e.target.files);
});

function handleFiles(files) {
    for (let i = 0; i < files.length; i++) {
        console.log("File:", files[i].name);
    }
}
