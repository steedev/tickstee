$(document).ready(() => {
  const divTab = document.getElementById('target').textContent.trim()
  const tabek = divTab.split(/ +/g)

  if (tabek[0] !== '') {
    for (const key of tabek) {
      $(`#${key}`).removeClass('btnFree')
      $(`#${key}`).addClass('btnReserved')
    }
  }

  let clickedTab = []
  $('.btnFree').click(function () {
    let currentNode = $(this).val()

    $(`#${currentNode}`).addClass('btnClicked')
    $(`#${currentNode}`).removeClass('btnFree')

    if (clickedTab.includes(currentNode)) {
      $(`#${currentNode}`).removeClass('btnClicked')
      $(`#${currentNode}`).addClass('btnFree')
      const copyClickedTab = []
      clickedTab.forEach((element) => {
        if (element !== currentNode) copyClickedTab.push(element)
      })
      clickedTab = copyClickedTab
    } else {
      clickedTab.push(currentNode)
    }
    console.log(clickedTab)
    $.post(
      'sugg.php',
      {
        sugg: clickedTab,
      },
      function (data, status) {
        $('#hiddenInp').val(data)
      }
    )
  })
})
