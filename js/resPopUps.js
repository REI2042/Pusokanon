document.addEventListener("DOMContentLoaded", initDocumentSelection);

async function initDocumentSelection() {
  const buttons124 = document.querySelectorAll(".btn-1, .btn-2, .btn-4");
  const buttons3 = document.querySelectorAll(".btn-3");

  const purposeMap = {
    1: "Employment",
    2: "Students Scholarship",
    3: "Person With Disability Assistance",
    4: "Senior Citizen Assistance",
    5: "Other",
  };

  buttons124.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value } = await Swal.fire({
        title: "Select Purpose for requesting document",
        html: "<p>Para sa pag kuha ug Barangay Certificate, kinahanglan namong mahibalo kung para asa gamitun ang documento nga Barangay certificate.</p>",
        input: "select",
        inputOptions: {
          1: "Employment",
          2: "Students Scholarship",
          3: "Person With Disability Assistance",
          4: "Senior Citizen Assistance",
          5: "Other",
        },
        inputPlaceholder: "Select purpose",
        showCancelButton: true,
        inputValidator: (value) => {
          return new Promise((resolve) => {
            if (value === "5") {
              Swal.fire({
                title: "Purpose",
                input: "textarea",
                inputLabel: "For other purpose please fill Up.",
                inputPlaceholder: "Type your purpose here...",
                inputAttributes: {
                  "aria-label": "Type your purpose here",
                },
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
              }).then(({ value: otherPurpose }) => {
                if (otherPurpose) {
                  Swal.fire({
                    title: "Success!",
                    html: `Your Document Request for the Purpose of <strong>${otherPurpose}</strong> is in Process.`,
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then((result) => {
                    if (result.isConfirmed) {
                      const formData = new FormData();
                      formData.append("purposeId", 5);
                      formData.append("purposeName", otherPurpose);
                      formData.append("docTypeId", buttonValue);

                      fetch("db/insert_request.php", {
                        method: "POST",
                        body: formData,
                      })
                        .then((response) => response.text())
                        .then((data) => {
                          window.location.href = "db/generateQR.php";
                        });
                    }
                  });
                } else {
                  resolve("You need to write your purpose :)");
                }
              });
            } else {
              resolve();
            }
          });
        },
      });

      if (value && value !== "5") {
        Swal.fire({
          title: "Success!",
          html: `Your Document Request for the Purpose of <strong>${purposeMap[value]}</strong> is in Process.`,
          icon: "success",
          confirmButtonText: "OK",
        }).then((result) => {
          if (result.isConfirmed) {
            const formData = new FormData();
            formData.append("purposeId", value);
            formData.append("purposeName", purposeMap[value]);
            formData.append("docTypeId", buttonValue);

            fetch("db/insert_request.php", {
              method: "POST",
              body: formData,
            })
              .then((response) => response.text())
              .then((data) => {
                window.location.href = "db/generateQR.php";
              });
          }
        });
      }
    });
  });

  // Add event listener for btn-3 (Cedula)
  buttons3.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Purpose",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Cedula.",
        inputPlaceholder: "Type your purpose here...",
        inputAttributes: {
          "aria-label": "Type your purpose here",
        },
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
      });

      if (purpose) {
        const { value: file } = await Swal.fire({
          title: "Upload Requirement",
          input: "file",
          inputAttributes: {
            accept: "image/*",
            "aria-label": "Upload your requirement",
          },
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
        });

        if (file) {
          Swal.fire({
            title: "Success!",
            html: `Your Document Request for the Purpose of <strong>${purpose}</strong> with the uploaded file is in Process.`,
            icon: "success",
            confirmButtonText: "OK",
          }).then((result) => {
            if (result.isConfirmed) {
              const formData = new FormData();
              formData.append("purpose", purpose);
              formData.append("file", file);
              formData.append("docTypeId", buttonValue);

              fetch("db/insert_request.php", {
                method: "POST",
                body: formData,
              })
                .then((response) => response.text())
                .then((data) => {
                  window.location.href = "db/generateQR.php";
                });
            }
          });
        } else {
          Swal.fire("Error", "You need to upload an image file", "error");
        }
      }
    });
  });
}
  