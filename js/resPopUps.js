document.addEventListener("DOMContentLoaded", initDocumentSelection);

async function initDocumentSelection() {
  const button249 = document.querySelectorAll(" .btn-2, .btn-4, .btn-9");
  const buttons3 = document.querySelectorAll(".btn-3");
  const buttons1 = document.querySelectorAll(".btn-1");
  const buttons5 = document.querySelectorAll(".btn-5");
  const buttons6 = document.querySelectorAll(".btn-6");
  const buttons7 = document.querySelectorAll(".btn-7");
  const buttons8 = document.querySelectorAll(".btn-8");
  const purposeMap = {
    1: "Employment",
    2: "Students Scholarship",
    3: "Person With Disability Assistance",
    4: "Senior Citizen Assistance",
    5: "Other",
  };

  button249.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value } = await Swal.fire({
        title: "Select Purpose for requesting document",
        html: "<p>Para sa pag kuha ug Barangay Certificate, kinahanglan namong mahibalo kung para asa gamitun ang documento nga Barangay certificate.</p>",
        input: "select",
        inputOptions: purposeMap,
        inputPlaceholder: "Select purpose",
        showCancelButton: true,
        inputValidator: (value) => {
          return new Promise((resolve) => {
            if (value === "5") {
              Swal.fire({
                title: "Purpose",
                input: "textarea",
                inputLabel: "For other purpose please fill up.",
                inputPlaceholder: "Type your purpose here...",
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

  //button for barangay clearance
  buttons1.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Purpose",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Barangay Clearance.",
        inputPlaceholder: "Type your purpose here...",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
      });

      if (purpose) {
        const { value: file } = await Swal.fire({
          title: "Upload Image Requirement",
          input: "file",
          inputAttributes: {
            accept: "image/*",
            "aria-label": "Upload your requirement Picture",
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
              formData.append("docTypeId", buttonValue);
              formData.append("file", file);

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
          Swal.fire({
            icon: "error",
            title: "File Upload Error",
            text: "You need to upload a file to proceed.",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Purpose Error",
          text: "You need to provide a purpose to proceed.",
        });
      }
    });
  });

  //button cedula 
  buttons3.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Purpose",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Cedula.",
        inputPlaceholder: "Type your purpose here...",
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
              formData.append("docTypeId", buttonValue);
              formData.append("file", file);

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
          Swal.fire({
            icon: "error",
            title: "File Upload Error",
            text: "You need to upload a file to proceed.",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Purpose Error",
          text: "You need to provide a purpose to proceed.",
        });
      }
    });
  });

  //button for electrical permit
  buttons5.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Location",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Electrical Permit.",
        inputPlaceholder: "Type your purpose here...",
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
              formData.append("docTypeId", buttonValue);
              formData.append("file", file);

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
          Swal.fire({
            icon: "error",
            title: "File Upload Error",
            text: "You need to upload a file to proceed.",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Purpose Error",
          text: "You need to provide a purpose to proceed.",
        });
      }
    });
  });

  //button for construction permit
  buttons6.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Location",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Construction Permit.",
        inputPlaceholder: "Type your purpose here...",
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
              formData.append("docTypeId", buttonValue);
              formData.append("file", file);

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
          Swal.fire({
            icon: "error",
            title: "File Upload Error",
            text: "You need to upload a file to proceed.",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Purpose Error",
          text: "You need to provide a purpose to proceed.",
        });
      }
    });
  });

  //button for fencing permit
  buttons7.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Location",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Fencing Permit.",
        inputPlaceholder: "Type your purpose here...",
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
              formData.append("docTypeId", buttonValue);
              formData.append("file", file);

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
          Swal.fire({
            icon: "error",
            title: "File Upload Error",
            text: "You need to upload a file to proceed.",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Purpose Error",
          text: "You need to provide a purpose to proceed.",
        });
      }
    });
  });

    //button for Bussiness Clearance
  buttons8.forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      const buttonValue = event.currentTarget.dataset.value;

      const { value: purpose } = await Swal.fire({
        title: "Business' Name",
        input: "textarea",
        inputLabel: "Please enter the purpose for requesting Business Clearance.",
        inputPlaceholder: "Type your purpose here...",
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
              formData.append("docTypeId", buttonValue);
              formData.append("file", file);

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
          Swal.fire({
            icon: "error",
            title: "File Upload Error",
            text: "You need to upload a file to proceed.",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Purpose Error",
          text: "You need to provide a purpose to proceed.",
        });
      }
    });
  });
}
