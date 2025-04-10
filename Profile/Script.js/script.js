function toggleSidebar() {
  const sidebar = document.getElementById("basketSidebar");
  sidebar.classList.toggle("active");
  if (sidebar.classList.contains("active")) {
    sidebar.style.right = "0";
  } else {
    sidebar.style.right = "-396px";
  }
}

function deleteItem(basketId) {
  if (confirm("Ви впевнені, що хочете видалити цей товар?")) {
    fetch(`?delete_id=${basketId}`)
      .then(response => response.json())
      .then(data => {
        if (data.success) {

          const item = document.getElementById(`basket-item-${basketId}`);
          if (item) {
            item.remove();
          }
        } else {
          alert("Не вдалося видалити товар: " + data.message);
        }
      })
      .catch(error => {
        console.error("Помилка:", error);
        alert("Сталася помилка при видаленні товару.");
      });
  }
}