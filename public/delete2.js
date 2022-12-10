var alma = document.getElementById('table');

if (alma) {
  alma.addEventListener('click', e => {
    if (e.target.className === '.btn btn-primary') {
      if (confirm('Biztos benne, hogy törli a felhasználót?')) {
        const id = e.target.getAttribute('data-id')
        fetch('./user-test-datas/${id}', {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}