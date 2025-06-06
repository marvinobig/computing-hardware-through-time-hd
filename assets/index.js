console.log("CHTT Loaded");

const contributionsInsertForm = document.querySelector("#contributions_upload");
const contributionsTable = document.querySelector("#contributions_table");
const contributionsTableBody = document.querySelector(
  "#contributions_table tbody"
);
const historyTableBody = document.querySelector(
  "#history_table tbody"
);
const contributionsModal = document.querySelector("#create_modal");
const contributionsModalOpenBtn = document.querySelector(
  "#create_modal_open_btn"
);
const contributionsModalCloseBtn = document.querySelector(
  "#create_modal_close_btn"
);
const filtersModal = document.querySelector("#filters_form");
const filtersModalOpenBtn = document.querySelector(
  "#filters_form_open_btn"
);
const filtersModalCloseBtn = document.querySelector(
  "#filters_form_close_btn"
);

async function reloadContributionsTable(tableBody) {
  try {
    const response = await fetch("/api/read-listings.php");
    const result = await response.json();

    tableBody.innerHTML = "";

    if (result.listings.length > 0) {
      result.listings.forEach((listing) => {
        const createdDate = new Date(listing.created_at);

        const row = `
        <tr>
          <td>
            <a href="/contribution.php?id=${listing.id}" class="underline">
              ${listing.name}
            </a>
          </td>
          <td>${listing.views}</td>
          <td>${createdDate.toLocaleDateString()} at ${createdDate.toLocaleTimeString()}</td>
          <td>
            <a href="/admin/update-listing.php?id=${listing.id}" class="btn">
              Edit
            </a>
            <button id="${listing.id}" type="button" class="btn">Delete</button>
          </td>
        </tr>
      `;

        tableBody.insertAdjacentHTML("beforeend", row);
      });
    } else {
      const row = `
        <tr>
          <td class="empty_table_msg" colspan="4">Nothing to display</td>
        </tr>
      `;

      tableBody.insertAdjacentHTML("beforeend", row);
    }
  } catch (err) {
    console.error(`Error loading contributions: ${err}`);
  }
}

async function reloadHistoryTable(tableBody) {
  try {
    const response = await fetch("/api/read-history.php");
    const result = await response.json();

    tableBody.innerHTML = "";

    if (result.history.length > 0) {
      result.history.forEach((activity) => {
        const createdDate = new Date(activity.happened_at);

        const row = `
        <tr>
          <td>
            ${activity.admin_username}
          </td>
          <td>${activity.action_type}</td>
          <td>
            ${activity.hardware_name}
          </td>
          <td>${createdDate.toLocaleDateString()} at ${createdDate.toLocaleTimeString()}</td>
        </tr>
      `;

        tableBody.insertAdjacentHTML("beforeend", row);
      });
    } else {
      const row = `
        <tr>
          <td class="empty_table_msg" colspan="4">Nothing to display</td>
        </tr>
      `;

      tableBody.insertAdjacentHTML("beforeend", row);
    }
  } catch (err) {
    console.error(`Error loading contributions: ${err}`);
  }
}

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
        throw new Error(`Form data was not uploaded successfully`);
      } else {
        alert(result.msg);
        form.reset();
        reloadContributionsTable(contributionsTableBody);
        reloadHistoryTable(historyTableBody);
        contributionsModal.close();
      }
    } catch (err) {
      alert(err.message);
    }
  });
}

if (contributionsTable) {
  contributionsTable.addEventListener("click", async (event) => {
    if (event.target.type === "button") {
      const confirmation = prompt(
        "Type 'delete' to confirm deletion of listing"
      );

      if (confirmation === "delete") {
        const listingId = event.target.id;
        const responseMsg = "Listing has been deleted";

        try {
          const response = await fetch(
            `/api/delete-listing.php?id=${listingId}`
          );

          if (!response.ok) {
            throw new Error(responseMsg);
          } else {
            alert(responseMsg);
            reloadContributionsTable(contributionsTableBody);
            reloadHistoryTable(historyTableBody);
          }
        } catch (err) {
          alert(err.message);
        }
      }
    }
  });
}

if (contributionsModal) {
  contributionsModalOpenBtn.addEventListener("click", () => {
    contributionsModal.showModal();
  });

  contributionsModalCloseBtn.addEventListener("click", () => {
    contributionsModal.close();
  });
}

if (filtersModal) {
  filtersModalOpenBtn.addEventListener("click", () => {
    filtersModal.showModal();
  });

  filtersModalCloseBtn.addEventListener("click", () => {
    filtersModal.close();
  });
}
