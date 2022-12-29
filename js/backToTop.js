function initializeBackToTop() {
  let backToTop = document.getElementById('back-to-top');
  backToTop.addEventListener('click', () => {
    window.scroll({
      top: 0,
      left: 0,
      behavior: 'smooth'
    });
    backToTop.animate([{ transform: 'scale(1.2)' }, { transform: 'scale(1)' }], { duration: 500, iterations: 1})
  });
}

function backToTop() {
  initializeBackToTop();
}
