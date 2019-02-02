window.addEventListener('load', function() {
  var tabs = document.querySelectorAll('ul.nav-tabs > li');

  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener('click', switchTab);
  }

  function switchTab(e) {
    e.preventDefault();
    document.querySelector('ul.nav-tabs > li.active').classList.remove('active');
    document.querySelector('.tab-pane.active').classList.remove('active');

    var clickedTab = e.currentTarget;
    var anchor = e.target;
    var activePaneID = anchor.getAttribute('href');
    clickedTab.classList.add('active');
    document.querySelector(activePaneID).classList.add('active');
  }
});
