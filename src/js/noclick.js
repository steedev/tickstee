$(document).ready(() => {
  const divTab = document.getElementById('target').textContent.trim()
  const tabek = divTab.split(/ +/g)

  if (tabek[0] !== '') {
    for (const key of tabek) {
      $(`#${key}`).removeClass('btnFree')
      $(`#${key}`).addClass('btnPurchased')
    }
  }
})
