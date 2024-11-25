console.log("hello world");

const contributionsInsertForm = document.querySelector("#contributions_upload");
const contributionsTable = document.querySelector('#listings_table');

if (contributionsInsertForm) {
  contributionsInsertForm.addEventListener("submit", async (event) => {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    try {
      const response = await fetch("/api/create-listing.php", {
        method: "post",
        body: formData,
      });
      const result = await response.json();

      if (!response.ok) {
        throw new Error(
          `Form data was not uploaded successfully: ${result.msg}`
        );
      } else {
        alert(result.msg);
        form.reset();
      }
    } catch (err) {
      alert(err.message);
    }
  });
}

